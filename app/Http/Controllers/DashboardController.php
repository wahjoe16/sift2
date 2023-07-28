<?php

namespace App\Http\Controllers;

use App\Charts\DosenPieChart;
use App\Charts\MahasiswaPieChart;
use App\Charts\TrenLulusanChart;
use App\Exports\RekapLulusanExport;
use App\Models\DaftarSeminar;
use App\Models\DaftarSidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function indexSidang(MahasiswaPieChart $mahasiswaPieChart, DosenPieChart $dosenPieChart, TrenLulusanChart $trenLulusanChart)
    {
        return view('sidang', [
            'mahasiswaPieChart' => $mahasiswaPieChart->build(),
            'dosenPieChart' => $dosenPieChart->build(),
            'trenLulusanChart' => $trenLulusanChart->build(),
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
        return view('dashboard.show_mahasiswa', compact('data', 'sidang'));
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
        return view('dashboard.show_dosen', compact('data', 'bimbingan'));
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
