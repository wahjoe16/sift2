<?php

namespace App\Http\Controllers;

use App\Charts\DosenPieChart;
use App\Charts\MahasiswaPieChart;
use App\Charts\TrenLulusanChart;
use App\Exports\RekapLulusanExport;
use App\Models\Archive;
use App\Models\CategorySkkft;
use App\Models\DaftarSeminar;
use App\Models\DaftarSidang;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function indexSidang(MahasiswaPieChart $mahasiswaPieChart, DosenPieChart $dosenPieChart, TrenLulusanChart $trenLulusanChart)
    {
        Session::put('page', 'dashboardSidang');
        $dosen = User::where('level', 2)->count();
        $mhs = User::where('level', 3)->count();
        $admin = User::where('level', 1)->count();
        $arsip = Archive::count();
        return view('sidang', [
            'mahasiswaPieChart' => $mahasiswaPieChart->build(),
            'dosenPieChart' => $dosenPieChart->build(),
            'trenLulusanChart' => $trenLulusanChart->build(),
            'dosen' => $dosen,
            'mhs' => $mhs,
            'admin' => $admin,
            'arsip' => $arsip
        ]);
    }

    public function indexData(MahasiswaPieChart $mahasiswaPieChart, DosenPieChart $dosenPieChart)
    {
        return view('data', [
            'mahasiswaPieChart' => $mahasiswaPieChart->build(),
            'dosenPieChart' => $dosenPieChart->build()
        ]);
    }

    public function dataMahasiswa()
    {
        $data = User::where('level', 3)->orderBy('nik', 'ASC')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('foto', function ($data) {
                $path = asset("$data->foto");
                return '<img src=' . $path . ' class="img-circle img-bordered-sm" width="40"/>';
            })
            ->addColumn('aksi', function ($data) {
                return '
                <div class="btn-group">
                    <a href="' . route('dashboardMahasiswa.show', $data->id) . '"><i class="fa fa-search"></i></a>
                </div>
        ';
            })
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function showMahasiswa($id)
    {
        $data = User::find($id);
        $sidang = DaftarSidang::where('mahasiswa_id', $id)->first();
        $kegiatan = Kegiatan::where('user_id', $id)->get();

        $poinPerKategori = "
                            select category_skkft.id, category_skkft.category_name, sum(kegiatan.point) as poin from kegiatan
                            left join category_skkft on category_skkft.id = kegiatan.category_id
                            where kegiatan.user_id =? and kegiatan.status_skkft = 1
                            group by category_skkft.category_name, category_skkft.id
                            order by category_skkft.id
                        ";

        $category = CategorySkkft::get();
        $dataPoin = DB::select($poinPerKategori, [$id]);
        // dd($dataPoin);
        $poinMhs = [];
        $totalPoin = 0;

        foreach ($dataPoin as $dp) {
            $poinMhs[$dp->category_name] = $dp->poin;
            $totalPoin += $dp->poin;
        }

        $poinKategori = [];
        foreach ($category as $c) {
            if (array_key_exists($c->category_name, $poinMhs)) {
                $poinnya = $poinMhs[$c->category_name];
                $persennya = ($poinnya/150)*100;
            }else {
                $poinnya = 0;
                $persennya = 0;
            }

            $poinKategori[$c->id] = [
                'id' => $c->id,
                'category' => $c->category_name,
                'poin'=> $poinnya,
                'persennya' => $persennya,
                'lolos' => $persennya >= $c->bobot,
                'bobotnya' => $c->bobot
            ];
        }

        return view('dashboard.show_mahasiswa', compact('data', 'sidang', 'kegiatan', 'dataPoin', 'poinKategori', 'totalPoin'));
    }

    public function dataDosen()
    {
        $data = User::where('level', 2)->orderBy('nik', 'ASC')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('foto', function ($data) {
                $path = asset("$data->foto");
                return '<img src=' . $path . ' class="img-circle img-bordered-sm" width="40"/>';
            })
            ->addColumn('aksi', function ($data) {
                return '
                <div class="btn-group">
                    <a href="' . route('dashboardDosen.show', $data->id) . '"><i class="fa fa-search"></i></a>
                </div>
        ';
            })
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function showDosen($id)
    {
        $data = User::find($id);
        $bimbingan = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where('dosen1_id', $id)->get();
        // dd($bimbingan);
        $arsip = Archive::select('archives.id', 'archives.name as a_name', 'archives.file as a_file', 'subcategory_archives.name as s_name', 'tahun_ajaran.tahun_ajaran as ta', 'semester.semester as smt')
            ->leftJoin('my_archives', 'my_archives.archive_id', 'archives.id')
            ->leftJoin('subcategory_archives', 'subcategory_archives.id', 'archives.subcategory_archive_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'archives.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'archives.semester_id')
            ->where('my_archives.user_id', $data->id)->get();
        // dd($arsip);
        return view('dashboard.show_dosen', compact('data', 'bimbingan', 'arsip'));
    }

    public function rekapLulusan()
    {
        $data = DaftarSidang::with('tahun_ajaran')->with('semester')->with('mahasiswa')->where('status', 1)->orderBy('tahun_ajaran_id', 'ASC')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                <div class="btn-group">
                    <a href="' . route('rekapLulusan.show', $data->id) . '"><i class="fa fa-search"></i></a>
                </div>
        ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function showRekapLulusan($id)
    {
        $data = DaftarSidang::find($id);
        $data2 = DaftarSeminar::find($id);
        // dd($data);
        return view('lulusan.show', compact('data', 'data2'));
    }

    public function exportExcelLulusan()
    {
        return Excel::download(new RekapLulusanExport, 'rekap_lulusan_' . date('Y-m-d-his') . '.xlsx');
    }
}
