<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\SertifikatSkkft;
use App\Models\Skpi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkpiController extends Controller
{
    public function index()
    {
        $data = SertifikatSkkft::where('status_skpi', 0)->get();
        return view('skpi.index', compact('data'));
    }

    public function show($id)
    {
        $data = SertifikatSkkft::find($id);
        // dd($data);
        $dataKegiatan = Kegiatan::select('kegiatan.*', 'users.nik', 'users.nama', 'category_skkft.category_name', 'subcategory_skkft.subcategory_name', 'tingkat.tingkat', 'jabatan.jabatan', 'prestasi_skkft.prestasi')
                        ->where(['user_id' => $data->user_id, 'status_skpi' => 1])
                        ->leftJoin('users', 'users.id', '=', 'kegiatan.user_id')
                        ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan.category_id')
                        ->leftJoin('subcategory_skkft', 'subcategory_skkft.id', '=', 'kegiatan.subcategory_id')
                        ->leftJoin('tingkat', 'tingkat.id', '=', 'kegiatan.tingkat_id')
                        ->leftJoin('prestasi_skkft', 'prestasi_skkft.id', '=', 'kegiatan.prestasi_id')
                        ->leftJoin('jabatan', 'jabatan.id', '=', 'kegiatan.jabatan_id')
                        ->get();
        // dd($dataKegiatan);
        return view('skpi.show', compact('data', 'dataKegiatan'));
    }

    public function verify($id)
    {
        $dataSertifikat = SertifikatSkkft::find($id);
        $dataSertifikat->status_skpi = 1;
        $dataSertifikat->save();

        // create SKPI
        $data = new Skpi();
        $data->user_id = $dataSertifikat->user_id;
        $data->tanggal = Carbon::now();
        $data->status = 1;
        $data->save();

        return redirect()->route('skpi.index')->with('success', "Sukses Terbitkan SKPI!");
    }

    public function list()
    {
        $data = Skpi::where('status', 1)->get();
        return view('skpi.list', compact('data'));
    }

    public function print()
    {
        $dataSkpi = Skpi::get();
        // $dataMahasiswa = $dataSkpi->user_skpi;
        
        // $query = "
        //     select category_skkft.category_name from kegiatan
        //     left join category_skkft on category_skkft.id = kegiatan.category_id
        //     where kegiatan.user_id =? and kegiatan.status_skpi = 1
            
        // ";

        // $dataKegiatan = DB::select($query, [$dataMahasiswa->id]);
        // $data = [
        //     'nama' => $dataMahasiswa->nama,
        //     'npm' => $dataMahasiswa->nik,
        //     'program_studi' => $dataMahasiswa->program_studi,
        //     'fakultas' => 'Fakultas Teknik',
        //     'foto' => $dataMahasiswa->foto,
        //     'kegiatan' => $dataKegiatan
        // ];

        $pdf = PDF::loadView('skpi.print_skpi', ['dataSkpi' => $dataSkpi]);
        return $pdf->download('skpi.pdf');
    }
}
