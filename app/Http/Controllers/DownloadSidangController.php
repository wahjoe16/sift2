<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DownloadSidangController extends Controller
{
    public function indexTmb()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('download_sidang.tmb.index', compact('ta', 'smt'));
    }

    public function dataTmb()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi' => 'Teknik Pertambangan',
            ]);

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('syarat_1', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_1 . '" target="_blank">' . $data->syarat_1 . '</a>';
            })
            ->addColumn('syarat_2', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_2 . '" target="_blank">' . $data->syarat_2 . '</a>';
            })
            ->addColumn('syarat_3', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_3 . '" target="_blank">' . $data->syarat_3 . '</a>';
            })
            ->addColumn('syarat_4', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_4 . '" target="_blank">' . $data->syarat_4 . '</a>';
            })
            ->addColumn('syarat_5', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_5 . '" target="_blank">' . $data->syarat_5 . '</a>';
            })
            ->rawColumns([
                'status', 'syarat_1', 'syarat_2', 'syarat_3', 'syarat_4', 'syarat_5'
            ])
            ->make(true);
    }

    public function indexTi()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('download_sidang.ti.index', compact('ta', 'smt'));
    }

    public function dataTi()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi' => 'Teknik Industri',
            ]);

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('syarat_1', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_1 . '" target="_blank">' . $data->syarat_1 . '</a>';
            })
            ->addColumn('syarat_2', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_2 . '" target="_blank">' . $data->syarat_2 . '</a>';
            })
            ->addColumn('syarat_3', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_3 . '" target="_blank">' . $data->syarat_3 . '</a>';
            })
            ->addColumn('syarat_4', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_4 . '" target="_blank">' . $data->syarat_4 . '</a>';
            })
            ->addColumn('syarat_5', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_5 . '" target="_blank">' . $data->syarat_5 . '</a>';
            })
            ->addColumn('syarat_6', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_6 . '" target="_blank">' . $data->syarat_6 . '</a>';
            })
            ->addColumn('syarat_7', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_7 . '" target="_blank">' . $data->syarat_7 . '</a>';
            })
            ->addColumn('syarat_8', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_8 . '" target="_blank">' . $data->syarat_8 . '</a>';
            })
            ->addColumn('syarat_9', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_9 . '" target="_blank">' . $data->syarat_9 . '</a>';
            })
            ->addColumn('syarat_10', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_10 . '" target="_blank">' . $data->syarat_10 . '</a>';
            })
            ->addColumn('syarat_11', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_11 . '" target="_blank">' . $data->syarat_11 . '</a>';
            })
            ->addColumn('syarat_12', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_12 . '" target="_blank">' . $data->syarat_12 . '</a>';
            })
            ->addColumn('syarat_13', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_13 . '" target="_blank">' . $data->syarat_13 . '</a>';
            })
            ->addColumn('syarat_14', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_14 . '" target="_blank">' . $data->syarat_14 . '</a>';
            })
            ->addColumn('syarat_15', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_15 . '" target="_blank">' . $data->syarat_15 . '</a>';
            })
            ->addColumn('syarat_16', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_16 . '" target="_blank">' . $data->syarat_16 . '</a>';
            })
            ->addColumn('syarat_17', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_17 . '" target="_blank">' . $data->syarat_17 . '</a>';
            })
            ->rawColumns([
                'status',
                'syarat_1', 'syarat_2', 'syarat_3', 'syarat_4', 'syarat_5', 'syarat_6', 'syarat_7', 'syarat_8', 'syarat_9',
                'syarat_10', 'syarat_11', 'syarat_12', 'syarat_13', 'syarat_14', 'syarat_15', 'syarat_16', 'syarat_17',
            ])
            ->make(true);
    }

    public function indexPwk()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('download_sidang.pwk.index', compact('ta', 'smt'));
    }

    public function dataPwk()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi' => 'Perencanaan Wilayah dan Kota',
            ]);

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('syarat_1', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_1 . '" target="_blank">' . $data->syarat_1 . '</a>';
            })
            ->addColumn('syarat_2', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_2 . '" target="_blank">' . $data->syarat_2 . '</a>';
            })
            ->addColumn('syarat_3', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_3 . '" target="_blank">' . $data->syarat_3 . '</a>';
            })
            ->addColumn('syarat_4', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_4 . '" target="_blank">' . $data->syarat_4 . '</a>';
            })
            ->addColumn('syarat_5', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_5 . '" target="_blank">' . $data->syarat_5 . '</a>';
            })
            ->addColumn('syarat_6', function ($data) {
                return '<a href="/mahasiswa/seminar/' . $data->syarat_6 . '" target="_blank">' . $data->syarat_6 . '</a>';
            })
            ->rawColumns([
                'status',
                'syarat_1', 'syarat_2', 'syarat_3', 'syarat_4', 'syarat_5', 'syarat_6'

            ])
            ->make(true);
    }
}
