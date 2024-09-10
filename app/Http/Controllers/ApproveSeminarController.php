<?php

namespace App\Http\Controllers;

use App\Exports\RekapSeminarPwkExport;
use App\Exports\RekapSeminarTiExport;
use App\Exports\RekapSeminarTmbExport;
use App\Models\DaftarSeminar;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ApproveSeminarController extends Controller
{
    public function viewTmb()
    {
        Session::put('page', 'appKolokium');
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('approve_seminar.tmb.index', compact('ta', 'smt'));
    }

    public function viewAdminTmb()
    {
        Session::put('page', 'adminKolokiumTambang');
        return view('approve_seminar.tmb.index_admin');
    }

    public function dataTmb()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
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
                    <a href="' . route('approve-seminarTmb.store', $data->id) . '" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-edit"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'approve'])
            ->make(true);
    }

    public function viewDataAdminTmb()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
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
                    return '<span class="label bg-yellow text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="label bg-green">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="label bg-red">Rejected</span>';
                }
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('adminKolokiumTmb.show', $data->id) . '" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'status', 'approve'])
            ->make(true);
    }

    public function approveTmb(Request $request, $id)
    {
        $data = DaftarSeminar::find($id);

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
            ], [
                'status_1.required' => 'Status approval harus dipilih',
                'status_2.required' => 'Status approval harus dipilih',
                'status_3.required' => 'Status approval harus dipilih',
                'status_4.required' => 'Status approval harus dipilih',
                'status_5.required' => 'Status approval harus dipilih',
                'status_6.required' => 'Status approval harus dipilih',
                'status_7.required' => 'Status approval harus dipilih',
                'status_8.required' => 'Status approval harus dipilih',
                'status_9.required' => 'Status approval harus dipilih',
                'status_10.required' => 'Status approval harus dipilih',
                'status_11.required' => 'Status approval harus dipilih',
                'status_12.required' => 'Status approval harus dipilih',
                'status_13.required' => 'Status approval harus dipilih',
                'status_14.required' => 'Status approval harus dipilih',
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
            ]);

            $data->fill($request->input());

            if (in_array(2, $dataStatus)) {
                $data->status = 2;
            } else {
                $data->status = 1;
            }

            $data->save();

            return redirect()->route('view-seminarTmb.index')->with('success', 'Pengajuan kolokium skripsi berhasil diapprove');
        }
        return view('approve_seminar.tmb.approve', compact('data'));
    }

    // public function rekapTmb()
    // {
    //     $ta = TahunAjaran::get();
    //     $smt = Semester::get();
    //     Session::put('page', 'rekapKolokium');
    //     return view('approve_seminar.tmb.rekap', compact('ta', 'smt'));
    // }

    public function getDataRekapTmb()
    {
        $data = DaftarSeminar::with([
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

        return $data;
    }

    public function dataRekapTmb()
    {
        // $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
        //     ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
        //     ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
        //     ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
        //     ->where([
        //         'program_studi_id' => 'Teknik Pertambangan',
        //         'status' => 1,
        //     ]);      

        $data = $this->getDataRekapTmb();

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
                    <a href="' . route('rekap-seminarTmb.show', $data->id) . '"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'tanggal_approve', 'aksi'])
            ->make(true);
    }

    public function showRekapTmb($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.tmb.show', compact('data'));
    }

    public function showAdminTmb($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.tmb.show_admin', compact('data'));
    }

    public function exportExcelTmb()
    {
        return Excel::download(new RekapSeminarTmbExport, 'rekap_kolokium_' . date('Y-m-d-his') . '.xlsx');
    }

    public function exportPdfTmb()
    {
        $data = DaftarSeminar::with([
            'mahasiswa',
            'tahun_ajaran',
            'semester'
        ])->where([
            'program_studi_id' => 'Teknik Pertambangan',
            'status' => 1
        ]);

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        $pdf = PDF::loadView('rekap_seminar.tambang_pdf', compact('data'));
        $pdf->setPaper(0, 0, 609, 440, 'potrait');

        return $pdf->stream('rekap_kolokium_' . date('Y-m-d-his') . '.pdf');
    }


    public function viewTi()
    {
        Session::put('page', 'appSeminarTA');
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('approve_seminar.ti.index', compact('ta', 'smt'));
    }

    public function viewAdminTi()
    {
        Session::put('page', 'adminSeminarTi');
        return view('approve_seminar.ti.index_admin');
    }

    public function dataTi()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
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
                    <a href="' . route('approve-seminarTi.store', $data->id) . '" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-edit"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'approve'])
            ->make(true);
    }

    public function viewDataAdminTi()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
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
                    return '<span class="label bg-yellow text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="label bg-green">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="label bg-red">Rejected</span>';
                }
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('adminSeminarTi.show', $data->id) . '" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'status', 'approve'])
            ->make(true);
    }

    public function approveTi(Request $request, $id)
    {
        $data = DaftarSeminar::find($id);

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
                'keterangan_1' => 'required_if:status_1,2',
                'keterangan_2' => 'required_if:status_2,2',
                'keterangan_3' => 'required_if:status_3,2',
                'keterangan_4' => 'required_if:status_4,2',
                'keterangan_5' => 'required_if:status_5,2',
                'keterangan_6' => 'required_if:status_6,2',
                'keterangan_7' => 'required_if:status_7,2',
                'keterangan_8' => 'required_if:status_8,2',
                'keterangan_9' => 'required_if:status_9,2',
            ], [
                'status_1.required' => 'Status approval harus dipilih',
                'status_2.required' => 'Status approval harus dipilih',
                'status_3.required' => 'Status approval harus dipilih',
                'status_4.required' => 'Status approval harus dipilih',
                'status_5.required' => 'Status approval harus dipilih',
                'status_6.required' => 'Status approval harus dipilih',
                'status_7.required' => 'Status approval harus dipilih',
                'status_8.required' => 'Status approval harus dipilih',
                'status_9.required' => 'Status approval harus dipilih',
                'keterangan_1.required_if' => 'Keterangan harus diisi',
                'keterangan_2.required_if' => 'Keterangan harus diisi',
                'keterangan_3.required_if' => 'Keterangan harus diisi',
                'keterangan_4.required_if' => 'Keterangan harus diisi',
                'keterangan_5.required_if' => 'Keterangan harus diisi',
                'keterangan_6.required_if' => 'Keterangan harus diisi',
                'keterangan_7.required_if' => 'Keterangan harus diisi',
                'keterangan_8.required_if' => 'Keterangan harus diisi',
                'keterangan_9.required_if' => 'Keterangan harus diisi',
            ]);

            $data->fill($request->input());

            if (in_array(2, $dataStatus)) {
                $data->status = 2;
            } else {
                $data->status = 1;
            }

            $data->save();

            return redirect()->route('view-seminarTi.index')->with('success', 'Pengajuan seminar tugas akhir berhasil diapprove');
        }
        return view('approve_seminar.ti.approve', compact('data'));
    }

    // public function rekapTi()
    // {
    //     $ta = TahunAjaran::get();
    //     $smt = Semester::get();
    //     Session::put('page', 'rekapSeminarTA');
    //     return view('approve_seminar.ti.rekap', compact('ta', 'smt'));
    // }

    public function dataRekapTi()
    {
        $data = DaftarSeminar::with([
            'mahasiswa',
            'tahun_ajaran',
            'semester'
        ])->where([
            'program_studi_id' => 'Teknik Industri',
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
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('tanggal_approve', function ($data) {
                return tanggal_indonesia($data->updated_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-seminarTi.show', $data->id) . '" class="btn btn-info btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'tanggal_approve', 'aksi'])
            ->make(true);
    }

    public function showRekapTi($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.ti.show', compact('data'));
    }

    public function showAdminTi($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.ti.show_admin', compact('data'));
    }

    public function exportExcelTi()
    {
        return Excel::download(new RekapSeminarTiExport, 'rekap_seminar_' . date('Y-m-d-his') . '.xlsx');
    }


    public function viewPwk()
    {
        Session::put('page', 'appPembahasan');
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('approve_seminar.pwk.index', compact('smt', 'ta'));
    }

    public function viewAdminPwk()
    {
        Session::put('page', 'adminPembahasanPwk');
        return view('approve_seminar.pwk.index_admin');
    }

    public function dataPwk()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
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
                    <a href="' . route('approve-seminarPwk.store', $data->id) . '" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-edit"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'approve'])
            ->make(true);
    }

    public function viewDataAdminPwk()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
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
                    return '<span class="label bg-yellow text-black">Waiting for Approval</span>';
                } elseif ($data->status == 1) {
                    return '<span class="label bg-green">Approved</span>';
                } elseif ($data->status == 2) {
                    return '<span class="label bg-red">Rejected</span>';
                }
            })
            ->addColumn('approve', function ($data) {
                return '
                    <a href="' . route('adminPembahasanPwk.show', $data->id) . '" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'status', 'approve'])
            ->make(true);
    }

    public function approvePwk(Request $request, $id)
    {
        $data = DaftarSeminar::find($id);

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
        ]);

        if ($request->isMethod('POST')) {
            $request->validate([
                'status_1' => 'required',
                'status_2' => 'required',
                'status_4' => 'required',
                'status_6' => 'required',
                'status_8' => 'required',
                'status_9' => 'required',
                'status_10' => 'required',
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
            ], [
                'status_1.required' => 'Status approval harus dipilih',
                'status_2.required' => 'Status approval harus dipilih',
                'status_4.required' => 'Status approval harus dipilih',
                'status_6.required' => 'Status approval harus dipilih',
                'status_8.required' => 'Status approval harus dipilih',
                'status_9.required' => 'Status approval harus dipilih',
                'status_10.required' => 'Status approval harus dipilih',
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
            ]);

            $data->fill($request->input());

            if (in_array(2, $dataStatus)) {
                $data->status = 2;
            } else {
                $data->status = 1;
            }

            $data->save();

            return redirect()->route('view-seminarPwk.index')->with('success', 'Pengajuan sidang pembahasan berhasil diapprove');
        }
        return view('approve_seminar.pwk.approve', compact('data'));
    }

    // public function rekapPwk()
    // {
    //     $ta = TahunAjaran::get();
    //     $smt = Semester::get();
    //     Session::put('page', 'rekapPembahasan');
    //     return view('approve_seminar.pwk.rekap', compact('ta', 'smt'));
    // }

    public function dataRekapPwk()
    {
        $data = DaftarSeminar::with([
            'mahasiswa',
            'tahun_ajaran',
            'semester'
        ])->where([
            'program_studi_id' => 'Perencanaan Wilayah dan Kota',
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
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('tanggal_approve', function ($data) {
                return tanggal_indonesia($data->updated_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-seminarPwk.show', $data->id) . '" class="btn btn-info btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'tanggal_approve', 'aksi'])
            ->make(true);
    }

    public function showRekapPwk($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.pwk.show', compact('data'));
    }

    public function showAdminPwk($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.pwk.show_admin', compact('data'));
    }

    public function exportExcelPwk()
    {
        return Excel::download(new RekapSeminarPwkExport, 'rekap_sidang_pembahasan_' . date('Y-m-d-his') . '.xlsx');
    }
}
