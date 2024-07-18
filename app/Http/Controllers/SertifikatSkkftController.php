<?php

namespace App\Http\Controllers;

use App\Models\CategorySkkft;
use App\Models\Kegiatan;
use App\Models\SertifikatSkkft;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SertifikatSkkftController extends Controller
{
    public function store()
    {
        $data = new SertifikatSkkft();
        $data->user_id = auth()->user()->id;
        $data->tanggal = Carbon::now();
        $data->save();

        return redirect()->back()->with('success', "Sukses Mengajukan Sertifikat SKKFT!");
    }

    public function index()
    {
        $data = SertifikatSkkft::where('status', 0)->get();
        return view('sertifikat.index', compact('data'));
    }

    public function show($id)
    {
        $dataSertifikat = SertifikatSkkft::find($id);
        $dataKegiatan = Kegiatan::select('users.nik', 'users.nama', 'kegiatan.*', 'category_skkft.category_name', 'subcategory_skkft.subcategory_name', 'tingkat.tingkat', 'jabatan.jabatan', 'prestasi_skkft.prestasi')
                        ->where('user_id', $dataSertifikat->user_id)
                        ->leftJoin('users', 'users.id', '=', 'kegiatan.user_id')
                        ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan.category_id')
                        ->leftJoin('subcategory_skkft', 'subcategory_skkft.id', '=', 'kegiatan.subcategory_id')
                        ->leftJoin('tingkat', 'tingkat.id', '=', 'kegiatan.tingkat_id')
                        ->leftJoin('prestasi_skkft', 'prestasi_skkft.id', '=', 'kegiatan.prestasi_id')
                        ->leftJoin('jabatan', 'jabatan.id', '=', 'kegiatan.jabatan_id')
                        ->get();
        
        $poinPerKategori = "
                            select category_skkft.id, category_skkft.category_name, sum(kegiatan.point) as poin from kegiatan
                            left join category_skkft on category_skkft.id = kegiatan.category_id
                            where kegiatan.user_id =? and kegiatan.status_skkft = 1
                            group by category_skkft.category_name, category_skkft.id
                            order by category_skkft.id
                        ";
        
        $category = CategorySkkft::get();
        $dataPoin = DB::select($poinPerKategori, [$dataSertifikat->user_id]);
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

        return view('sertifikat.show', compact('dataSertifikat', 'dataKegiatan', 'dataPoin', 'poinKategori', 'totalPoin'));
    }

    public function verify($id)
    {
        $dataSertifikat = SertifikatSkkft::find($id);
        $dataSertifikat->status = 1;
        $dataSertifikat->save();

        return redirect()->route('sertifikat.index')->with('success', 'Sertifikat Berhasil Diterbitkan');
    }

    public function reject($id)
    {
        $dataSertifikat = SertifikatSkkft::find($id);
        $dataSertifikat->delete();

        return redirect()->route('sertifikat.index')->with('success', 'Sertifikat Berhasil Ditolak');
    }
}
