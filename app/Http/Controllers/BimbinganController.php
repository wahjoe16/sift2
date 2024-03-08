<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\DaftarSeminar;
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
                        <a href="' . route('bimbinganTmb.showTmb1', $data->mahasiswa_id) . '"><i class="fa fa-search"></i></a>
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
                        <a href="' . route('bimbinganTmb.showTmb2', $data->mahasiswa_id) . '"><i class="fa fa-search"></i></a>
                    </div>
            ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function showTmb1($id)
    {
        $dataSeminar = DaftarSeminar::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen1_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        $dataSidang = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen1_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        // dd($dataSidang);

        return view('bimbingan.show_tmb', compact('dataSeminar', 'dataSidang'));
    }

    public function showTmb2($id)
    {
        $dataSeminar = DaftarSeminar::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        $dataSidang = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        return view('bimbingan.show_tmb2', compact('dataSeminar', 'dataSidang'));
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
                            <a href="' . route('bimbinganTi.showTi1', $data->mahasiswa_id) . '"><i class="fa fa-search"></i></a>
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
                            <a href="' . route('bimbinganTi.showTi2', $data->mahasiswa_id) . '"><i class="fa fa-search"></i></a>
                        </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function showTi1($id)
    {
        $dataSeminar = DaftarSeminar::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen1_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        $dataSidang = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen1_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        // dd($dataSidang);

        return view('bimbingan.show_ti', compact('dataSeminar', 'dataSidang'));
    }

    public function showTi2($id)
    {
        $dataSeminar = DaftarSeminar::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        $dataSidang = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        return view('bimbingan.show_ti2', compact('dataSeminar', 'dataSidang'));
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
                <a href="' . route('bimbinganPwk.showPwk1', $data->mahasiswa_id) . '"><i class="fa fa-search"></i></a>
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
                <a href="' . route('bimbinganPwk.showPwk2', $data->mahasiswa_id) . '"><i class="fa fa-search"></i></a>
            </div>
    ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function showPwk1($id)
    {
        $dataSeminar = DaftarSeminar::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen1_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        $dataSidang = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen1_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        // dd($dataSidang);

        return view('bimbingan.show_pwk', compact('dataSeminar', 'dataSidang'));
    }

    public function showPwk2($id)
    {
        $dataSeminar = DaftarSeminar::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        $dataSidang = DaftarSidang::with(['mahasiswa', 'tahun_ajaran', 'semester'])->where([
            'dosen2_id' => auth()->user()->id,
            'status' => 1,
            'mahasiswa_id' => $id
        ])->first();

        return view('bimbingan.show_pwk2', compact('dataSeminar', 'dataSidang'));
    }
}
