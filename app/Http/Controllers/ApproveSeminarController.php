<?php

namespace App\Http\Controllers;

use App\Models\DaftarSeminar;
use Illuminate\Http\Request;

class ApproveSeminarController extends Controller
{
    public function viewTmb()
    {
        return view('approve_seminar.tmb.index');
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
            'status_15',
            'status_16',
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

    public function rekapTmb()
    {
        return view('approve_seminar.tmb.rekap');
    }

    public function dataRekapTmb()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
            ->where([
                'program_studi_id' => 'Teknik Pertambangan',
                'status' => 1,
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-seminarTmb.show', $data->id) . '" class="btn btn-info btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'aksi'])
            ->make(true);
    }

    public function showRekapTmb($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.tmb.show', compact('data'));
    }


    public function viewTi()
    {
        return view('approve_seminar.ti.index');
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
            'status_10',
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

            return redirect()->route('view-seminarTi.index')->with('success', 'Pengajuan seminar tugas akhir berhasil diapprove');
        }
        return view('approve_seminar.ti.approve', compact('data'));
    }

    public function rekapTi()
    {
        return view('approve_seminar.ti.rekap');
    }

    public function dataRekapTi()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
            ->where([
                'program_studi_id' => 'Teknik Industri',
                'status' => 1,
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-seminarTi.show', $data->id) . '" class="btn btn-info btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'aksi'])
            ->make(true);
    }

    public function showRekapTi($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.ti.show', compact('data'));
    }


    public function viewPwk()
    {
        return view('approve_seminar.pwk.index');
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
                'status_3' => 'required',
                'status_4' => 'required',
                'status_5' => 'required',
                'status_6' => 'required',
                'status_7' => 'required',
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

            return redirect()->route('view-seminarPwk.index')->with('success', 'Pengajuan seminar tugas akhir berhasil diapprove');
        }
        return view('approve_seminar.pwk.approve', compact('data'));
    }

    public function rekapPwk()
    {
        return view('approve_seminar.pwk.rekap');
    }

    public function dataRekapPwk()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
            ->where([
                'program_studi_id' => 'Perencanaan Wilayah dan Kota',
                'status' => 1,
            ])->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_pengajuan', function ($data) {
                return tanggal_indonesia($data->created_at, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('rekap-seminarPwk.show', $data->id) . '" class="btn btn-info btn-xs btn-flat"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['tanggal_pengajuan', 'aksi'])
            ->make(true);
    }

    public function showRekapPwk($id)
    {
        $data = DaftarSeminar::find($id);
        return view('approve_seminar.pwk.show', compact('data'));
    }
}
