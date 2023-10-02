<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BimbinganController extends Controller
{
    public function indexTmb()
    {
        Session::put('page', 'bimbinganTmb');
        return view('bimbingan.index_tmb');
    }

    public function dataTmb1()
    {
        $data = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'program_studi_id' => 'Teknik Pertambangan',
            'dosen1_id' => auth()->user()->id,
            'status' => 1
        ])->get();
        // dd($data);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                    <div class="btn-group">
                        <a href="' . route('rekap-sidangTmb.show', $data->id) . '"><i class="fa fa-search"></i></a>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function dataTmb2()
    {
        $data = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1
        ])->get();
        // dd($data);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
            <div class="btn-group">
                <a href="' . route('rekap-sidangTmb.show', $data->id) . '"><i class="fa fa-search"></i></a>
            </div>
    ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function indexTi()
    {
        Session::put('page', 'bimbinganTi');
        return view('bimbingan.index_ti');
    }

    public function dataTi1()
    {
        $data = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'program_studi_id' => 'Teknik Industri',
            'dosen1_id' => auth()->user()->id,
            'status' => 1
        ])->get();
        // dd($data);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                        <div class="btn-group">
                            <a href="' . route('rekap-sidangTi.show', $data->id) . '"><i class="fa fa-search"></i></a>
                        </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function dataTi2()
    {
        $data = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1
        ])->get();
        // dd($data);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                        <div class="btn-group">
                            <a href="' . route('rekap-sidangTi.show', $data->id) . '"><i class="fa fa-search"></i></a>
                        </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function indexPwk()
    {
        Session::put('page', 'bimbinganPwk');
        return view('bimbingan.index_pwk');
    }

    public function dataPwk1()
    {
        $data = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'program_studi_id' => 'Perencanaan Wilayah dan Kota',
            'dosen1_id' => auth()->user()->id,
            'status' => 1
        ])->get();
        // dd($data);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
            <div class="btn-group">
                <a href="' . route('rekap-sidangPwk.show', $data->id) . '"><i class="fa fa-search"></i></a>
            </div>
    ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function dataPwk2()
    {
        $data = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1
        ])->get();
        // dd($data);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
            <div class="btn-group">
                <a href="' . route('rekap-sidangPwk.show', $data->id) . '"><i class="fa fa-search"></i></a>
            </div>
    ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
