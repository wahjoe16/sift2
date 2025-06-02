<?php

namespace App\Http\Controllers;

use App\Exports\RekapSidangPwkExport;
use App\Exports\RekapSidangTiExport;
use App\Exports\RekapSidangTmbExport;
use App\Models\DaftarSidang;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ApproveSidangController extends Controller
{
    public function viewTmb()
    {
        Session::put('page', 'appSkripsi');
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('approve_sidang.tmb.index', compact('ta', 'smt'));
    }

    public function viewAdminTmb()
    {
        Session::put('page', 'adminSidangTambang');
        return view('approve_sidang.tmb.index_admin');
    }

    public function dataTmb()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi_id' => 'Teknik Pertambangan',
                'status' => 0,
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('approve-sidangTmb.store', $data->id) . '" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'approve'])
            ->make(true);
    }

    public function viewDataAdminTmb()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi_id' => 'Teknik Pertambangan',
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('adminSkripsiTmb.show', $data->id) . '" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'status', 'approve'])
            ->make(true);
    }

    public function approveTmb(Request $request, $id)
    {
        $data = DaftarSidang::find($id);

        $dataStatus = request([
            'status_1',
            'status_2',
            'status_3',
            'status_4',
            'status_5',
        ]);

        if ($request->isMethod('POST')) {
            $request->validate([
                'status_1' => 'required',
                'status_2' => 'required',
                'status_3' => 'required',
                'status_4' => 'required',
                'status_5' => 'required',
                'keterangan_1' => 'required_if:status_1,2',
                'keterangan_2' => 'required_if:status_2,2',
                'keterangan_3' => 'required_if:status_3,2',
                'keterangan_4' => 'required_if:status_4,2',
                'keterangan_5' => 'required_if:status_5,2',
            ], [
                'status_1.required' => 'Status approval harus diverifikasi',
                'status_2.required' => 'Status approval harus diverifikasi',
                'status_3.required' => 'Status approval harus diverifikasi',
                'status_4.required' => 'Status approval harus diverifikasi',
                'status_5.required' => 'Status approval harus diverifikasi',
                'keterangan_1.required_if' => 'Keterangan harus diisi',
                'keterangan_2.required_if' => 'Keterangan harus diisi',
                'keterangan_3.required_if' => 'Keterangan harus diisi',
                'keterangan_4.required_if' => 'Keterangan harus diisi',
                'keterangan_5.required_if' => 'Keterangan harus diisi',
            ]);

            $data->fill($request->input());

            if (in_array(2, $dataStatus)) {
                $data->status = 2;
            } else {
                $data->status = 1;
            }

            $data->save();

            return redirect()->route('view-sidangTmb.index')->with('success', 'Pengajuan sidang skripsi berhasil diapprove');
        }
        return view('approve_sidang.tmb.approve', compact('data'));
    }

    public function rekapTmb()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        Session::put('page', 'rekapSkripsi');
        return view('approve_sidang.tmb.rekap', compact('ta', 'smt'));
    }

    public function dataRekapTmb()
    {
        $data = DaftarSidang::with([
            'mahasiswa',
            'tahun_ajaran',
            'semester'
        ])->where([
            'program_studi_id' => 'Teknik Pertambangan',
            'status' => 1
        ])->orderBy('tahun_ajaran_id', 'desc');

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->filterColumn('tahun_ajaran.tahun_ajaran', function ($query, $keyword) {
                $query->whereRelation('tahun_ajaran', 'id', $keyword);
            })
            ->filterColumn('semester.semester', function ($query, $keyword) {
                $query->whereRelation('semester', 'id', $keyword);
            })
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('tanggal_approve', function ($data) {
                return tanggal_indonesia($data->updated_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-sidangTmb.show', $data->id) . '"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'aksi'])
            ->make(true);
    }

    public function showRekapTmb($id)
    {
        $data = DaftarSidang::find($id);
        return view('approve_sidang.tmb.show', compact('data'));
    }

    public function showAdminTmb($id)
    {
        $data = DaftarSidang::find($id);
        return view('approve_sidang.tmb.show_admin', compact('data'));
    }

    public function exportExcelTmb()
    {
        return Excel::download(new RekapSidangTmbExport, 'rekap_sidang_' . date('Y-m-d-his') . '.xlsx');
    }


    public function viewTi()
    {
        Session::put('page', 'appSidangTA');
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('approve_sidang.ti.index', compact('ta', 'smt'));
    }

    public function viewAdminTi()
    {
        Session::put('page', 'adminSidangTi');
        return view('approve_sidang.ti.index_admin');
    }

    public function dataTi()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi_id' => 'Teknik Industri',
                'status' => 0,
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('approve-sidangTi.store', $data->id) . '" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'approve'])
            ->make(true);
    }

    public function viewDataAdminTi()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi_id' => 'Teknik Industri',
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('adminSidangTi.show', $data->id) . '" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'status', 'approve'])
            ->make(true);
    }

    public function approveTi(Request $request, $id)
    {
        $data = DaftarSidang::find($id);

        $dataStatus = request([
            'status_1',
            'status_2',
            'status_3',
            'status_4',
            'status_5',
            'status_6',
            'status_7',
            'status_8',
            'status_9',
            'status_10',
            'status_11',
            'status_12',
            'status_13',
            'status_14',
            'status_15',
            'status_16',
            'status_17',
        ]);

        if ($request->isMethod('POST')) {
            $request->validate([
                'status_1' => 'required',
                'status_2' => 'required',
                'status_3' => 'required',
                'status_4' => 'required',
                'status_5' => 'required',
                'status_6' => 'required',
                'status_7' => 'required',
                'status_8' => 'required',
                'status_9' => 'required',
                'status_10' => 'required',
                'status_11' => 'required',
                'status_12' => 'required',
                'status_13' => 'required',
                'status_14' => 'required',
                'status_15' => 'required',
                'status_16' => 'required',
                'status_17' => 'required',
                'keterangan_1' => 'required_if:status_1,2',
                'keterangan_2' => 'required_if:status_2,2',
                'keterangan_3' => 'required_if:status_3,2',
                'keterangan_4' => 'required_if:status_4,2',
                'keterangan_5' => 'required_if:status_5,2',
                'keterangan_6' => 'required_if:status_6,2',
                'keterangan_7' => 'required_if:status_7,2',
                'keterangan_8' => 'required_if:status_8,2',
                'keterangan_9' => 'required_if:status_9,2',
                'keterangan_10' => 'required_if:status_10,2',
                'keterangan_11' => 'required_if:status_11,2',
                'keterangan_12' => 'required_if:status_12,2',
                'keterangan_13' => 'required_if:status_13,2',
                'keterangan_14' => 'required_if:status_14,2',
                'keterangan_15' => 'required_if:status_15,2',
                'keterangan_16' => 'required_if:status_16,2',
                'keterangan_17' => 'required_if:status_17,2',
            ], [
                'status_1.required' => 'Status approval harus diverifikasi',
                'status_2.required' => 'Status approval harus diverifikasi',
                'status_3.required' => 'Status approval harus diverifikasi',
                'status_4.required' => 'Status approval harus diverifikasi',
                'status_5.required' => 'Status approval harus diverifikasi',
                'status_6.required' => 'Status approval harus diverifikasi',
                'status_7.required' => 'Status approval harus diverifikasi',
                'status_8.required' => 'Status approval harus diverifikasi',
                'status_9.required' => 'Status approval harus diverifikasi',
                'status_10.required' => 'Status approval harus diverifikasi',
                'status_11.required' => 'Status approval harus diverifikasi',
                'status_12.required' => 'Status approval harus diverifikasi',
                'status_13.required' => 'Status approval harus diverifikasi',
                'status_14.required' => 'Status approval harus diverifikasi',
                'status_15.required' => 'Status approval harus diverifikasi',
                'status_16.required' => 'Status approval harus diverifikasi',
                'status_17.required' => 'Status approval harus diverifikasi',
                'keterangan_1.required_if' => 'Keterangan harus diisi',
                'keterangan_2.required_if' => 'Keterangan harus diisi',
                'keterangan_3.required_if' => 'Keterangan harus diisi',
                'keterangan_4.required_if' => 'Keterangan harus diisi',
                'keterangan_5.required_if' => 'Keterangan harus diisi',
                'keterangan_6.required_if' => 'Keterangan harus diisi',
                'keterangan_7.required_if' => 'Keterangan harus diisi',
                'keterangan_8.required_if' => 'Keterangan harus diisi',
                'keterangan_9.required_if' => 'Keterangan harus diisi',
                'keterangan_10.required_if' => 'Keterangan harus diisi',
                'keterangan_11.required_if' => 'Keterangan harus diisi',
                'keterangan_12.required_if' => 'Keterangan harus diisi',
                'keterangan_13.required_if' => 'Keterangan harus diisi',
                'keterangan_14.required_if' => 'Keterangan harus diisi',
                'keterangan_15.required_if' => 'Keterangan harus diisi',
                'keterangan_16.required_if' => 'Keterangan harus diisi',
                'keterangan_17.required_if' => 'Keterangan harus diisi'
            ]);

            $data->fill($request->input());

            if (in_array(2, $dataStatus)) {
                $data->status = 2;
            } else {
                $data->status = 1;
            }

            $data->save();

            return redirect()->route('view-sidangTi.index')->with('success', 'Pengajuan sidang tugas akhir berhasil diapprove');
        }
        return view('approve_sidang.ti.approve', compact('data'));
    }

    public function rekapTi()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        Session::put('page', 'rekapSidangTA');
        return view('approve_sidang.ti.rekap', compact('ta', 'smt'));
    }

    public function dataRekapTi()
    {
        $data = DaftarSidang::with([
            'mahasiswa',
            'tahun_ajaran',
            'semester'
        ])->where([
            'program_studi_id' => 'Teknik Industri',
            'status' => 1
        ])->orderBy('tahun_ajaran_id', 'desc');;

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->filterColumn('tahun_ajaran.tahun_ajaran', function ($query, $keyword) {
                $query->whereRelation('tahun_ajaran', 'id', $keyword);
            })
            ->filterColumn('semester.semester', function ($query, $keyword) {
                $query->whereRelation('semester', 'id', $keyword);
            })
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('tanggal_approve', function ($data) {
                return tanggal_indonesia($data->updated_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-sidangTi.show', $data->id) . '" class="btn btn-info btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'aksi'])
            ->make(true);
    }

    public function showRekapTi($id)
    {
        $data = DaftarSidang::find($id);
        return view('approve_sidang.ti.show', compact('data'));
    }

    public function showAdminTi($id)
    {
        $data = DaftarSidang::find($id);
        return view('approve_sidang.ti.show_admin', compact('data'));
    }

    public function exportExcelTi()
    {
        return Excel::download(new RekapSidangTiExport, 'rekap_sidang_' . date('Y-m-d-his') . '.xlsx');
    }

    public function viewPwk()
    {
        Session::put('page', 'appTerbuka');
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('approve_sidang.pwk.index', compact('ta', 'smt'));
    }

    public function viewAdminPwk()
    {
        Session::put('page', 'adminTerbukaPwk');
        return view('approve_sidang.pwk.index_admin');
    }

    public function dataPwk()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi_id' => 'Perencanaan Wilayah dan Kota',
                'status' => 0,
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('approve-sidangPwk.store', $data->id) . '" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'approve'])
            ->make(true);
    }

    public function viewDataAdminPwk()
    {
        $data = DaftarSidang::select('daftar_sidang.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_sidang.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_sidang.semester_id')
            ->where([
                'program_studi_id' => 'Perencanaan Wilayah dan Kota',
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-warning text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('adminTerbukaPwk.show', $data->id) . '" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'status', 'approve'])
            ->make(true);
    }

    public function approvePwk(Request $request, $id)
    {
        $data = DaftarSidang::find($id);

        $dataStatus = request([
            'status_1',
            'status_2',
            'status_3',
            'status_4',
            'status_5',
            'status_6',
        ]);

        if ($request->isMethod('POST')) {
            $request->validate([
                'status_1' => 'required',
                'status_2' => 'required',
                'status_3' => 'required',
                'status_4' => 'required',
                'status_5' => 'required',
                'status_6' => 'required',
                'keterangan_1' => 'required_if:status_1,2',
                'keterangan_2' => 'required_if:status_2,2',
                'keterangan_3' => 'required_if:status_3,2',
                'keterangan_4' => 'required_if:status_4,2',
                'keterangan_5' => 'required_if:status_5,2',
                'keterangan_6' => 'required_if:status_6,2',
            ], [
                'status_1.required' => 'Status approval harus diverifikasi',
                'status_2.required' => 'Status approval harus diverifikasi',
                'status_3.required' => 'Status approval harus diverifikasi',
                'status_4.required' => 'Status approval harus diverifikasi',
                'status_5.required' => 'Status approval harus diverifikasi',
                'status_6.required' => 'Status approval harus diverifikasi',
                'keterangan_1.required_if' => 'Keterangan harus diisi',
                'keterangan_2.required_if' => 'Keterangan harus diisi',
                'keterangan_3.required_if' => 'Keterangan harus diisi',
                'keterangan_4.required_if' => 'Keterangan harus diisi',
                'keterangan_5.required_if' => 'Keterangan harus diisi',
                'keterangan_6.required_if' => 'Keterangan harus diisi',
            ]);

            $data->fill($request->input());

            if (in_array(2, $dataStatus)) {
                $data->status = 2;
            } else {
                $data->status = 1;
            }

            $data->save();

            return redirect()->route('view-sidangPwk.index')->with('success', 'Pengajuan sidang terbuka berhasil diapprove');
        }
        return view('approve_sidang.pwk.approve', compact('data'));
    }

    public function rekapPwk()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        Session::put('page', 'rekapTerbuka');
        return view('approve_sidang.pwk.rekap', compact('ta', 'smt'));
    }

    public function dataRekapPwk()
    {
        $data = DaftarSidang::with([
            'mahasiswa',
            'tahun_ajaran',
            'semester'
        ])->where([
            'program_studi_id' => 'Perencanaan Wilayah dan Kota',
            'status' => 1
        ])->orderBy('tahun_ajaran_id', 'desc');;

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        return datatables()
            ->of($data)
            ->filterColumn('tahun_ajaran.tahun_ajaran', function ($query, $keyword) {
                $query->whereRelation('tahun_ajaran', 'id', $keyword);
            })
            ->filterColumn('semester.semester', function ($query, $keyword) {
                $query->whereRelation('semester', 'id', $keyword);
            })
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-sidangPwk.show', $data->id) . '" class="btn btn-info btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'aksi'])
            ->make(true);
    }

    public function showRekapPwk($id)
    {
        $data = DaftarSidang::find($id);
        return view('approve_sidang.pwk.show', compact('data'));
    }

    public function showAdminPwk($id)
    {
        $data = DaftarSidang::find($id);
        return view('approve_sidang.pwk.show_admin', compact('data'));
    }

    public function exportExcelPwk()
    {
        return Excel::download(new RekapSidangPwkExport, 'rekap_sidang_terbuka' . date('Y-m-d-his') . '.xlsx');
    }
}
