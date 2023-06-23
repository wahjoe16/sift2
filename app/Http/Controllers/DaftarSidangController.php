<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DaftarSidangController extends Controller
{
    public function indexTmb()
    {
        $dataMhs = auth()->user();
        // dd($dataMhs);
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        // dd($dataSidang);
        $lastData = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->orderBy('id', 'desc')->first();

        return view('daftar_sidang.tmb.index', compact('dataSidang', 'lastData'));
    }

    public function daftarTmb()
    {
        $title = "Pengajuan Sidang Skripsi";
        Session::put('page', 'daftar_seminar_tmb');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Teknik Pertambangan'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();

        return view('daftar_sidang.tmb.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function storeTmb(Request $request)
    {
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'dosen1_id' => 'required',
                'dosen2_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'required|mimes:pdf',
                'syarat_2' => 'required|mimes:pdf',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Transkrip Nilai harus diisi',
                'syarat_2.required' => 'Sertifikat Pesantren Calon Sarjana harus diisi',
                'syarat_1.mimes' => 'Format File Transkrip Nilai harus PDF',
                'syarat_2.mimes' => 'Format File Sertifikat Pesantren Calon Sarjana harus PDF',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSidang = new DaftarSidang();
            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
            $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
            $syarat_1_path = 'mahasiswa/sidang/syarat01';
            $syarat_1->move($syarat_1_path, $nama_syarat_1);
            $daftarSidang->syarat_1 = $nama_syarat_1;

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
            $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
            $syarat_2_path = 'mahasiswa/sidang/syarat02';
            $syarat_2->move($syarat_2_path, $nama_syarat_2);
            $daftarSidang->syarat_2 = $nama_syarat_2;

            $daftarSidang->save();

            return redirect()->route('sidang_tmb.index')->with('success', 'Sukses mengajukan pendaftaran sidang skripsi!');
        }
    }

    public function showTmb($id)
    {
        $data = DaftarSidang::find($id);
        return view('daftar_sidang.tmb.show', compact('data'));
    }

    public function editTmb($id)
    {
        $data = DaftarSidang::find($id);
        $title = "Pengajuan Sidang Skripsi";
        Session::put('page', 'daftar_sidang_tmb');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Teknik Pertambangan'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        return view('daftar_sidang.tmb.edit', compact('data', 'title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function updateTmb(Request $request, $id)
    {
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $daftarSidang = DaftarSidang::find($id);
            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            $daftarSidang->status = 0;
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            if (!is_null($syarat_1)) {
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/sidang/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;
                $daftarSidang->status_1 = 0;
            }


            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/sidang/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;
                $daftarSidang->status_2 = 0;
            }

            $daftarSidang->save();

            return redirect()->route('sidang_tmb.index')->with('success', 'Sukses mengajukan pendaftaran sidang skripsi!');
        }
    }

    public function indexTi()
    {
        $dataMhs = auth()->user();
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $lastData = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->orderBy('id', 'desc')->first();
        return view('daftar_sidang.ti.index', compact('dataSidang', 'lastData'));
    }

    public function daftarTi()
    {
        $title = "Pengajuan Sidang Tugas Akhir";
        Session::put('page', 'daftar_sidang_ti');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Teknik Industri'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();

        return view('daftar_sidang.ti.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function storeTi(Request $request)
    {
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id' => 'required',
                'dosen1_id' => 'required',
                'dosen2_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'required|mimes:pdf',
                'syarat_2' => 'required|mimes:pdf',
                'syarat_3' => 'required|mimes:pdf',
                'syarat_4' => 'required|mimes:pdf',
                'syarat_5' => 'required|mimes:pdf',
                'syarat_6' => 'required|mimes:pdf',
                'syarat_7' => 'required|mimes:pdf',
                'syarat_8' => 'required|mimes:pdf',
                'syarat_9' => 'required|mimes:pdf',
                'syarat_10' => 'required|mimes:pdf',
                'syarat_11' => 'required|mimes:pdf',
                'syarat_12' => 'required|mimes:pdf',
                'syarat_13' => 'required|mimes:pdf',
                'syarat_14' => 'required|mimes:pdf',
                'syarat_15' => 'required|mimes:pdf',
                'syarat_16' => 'required|mimes:pdf',
                'syarat_17' => 'required|mimes:pdf',

            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Fotocopy Kwitansi Bimbingan TA Harus Diisi',
                'syarat_2.required' => 'Fotocopy Kwitansi Sidang TA Harus Diisi',
                'syarat_3.required' => 'Fotocopy Kwitansi Seminar TA Harus Diisi',
                'syarat_4.required' => 'Fotocopy Sertifikat Pesantren Calon Sarjana Harus Diisi',
                'syarat_5.required' => 'Formulir Rencana Studi (FRS) Harus Diisi',
                'syarat_6.required' => 'Bukti Penyerahan Draft TA Harus Diisi',
                'syarat_7.required' => 'Bukti Bebas Perpustakaan Pusat UNISBA Harus Diisi',
                'syarat_8.required' => 'Bukti Bebas Perpustakaan TI Harus Diisi',
                'syarat_9.required' => 'Transkrip Nilai Terakhir Harus Diisi',
                'syarat_10.required' => 'Persetujuan Sidang dari Dosen Pembimbing Harus Diisi',
                'syarat_11.required' => 'Fotocopy Sertifikat TOEFL Harus Diisi',
                'syarat_12.required' => 'Foto Harus Diisi',
                'syarat_13.required' => 'Bukti Bebas Pinjaman / Tunggakan Harus Diisi',
                'syarat_14.required' => 'Menghadiri Seminar / Sidang Harus Diisi',
                'syarat_15.required' => 'Form Hafalan Surat Al-Quran Harus Diisi',
                'syarat_16.required' => 'Print out bukti pengecekan Plagiarisme Harus Diisi',
                'syarat_17.required' => 'Sertifikat SKKFT Harus Diisi',
                'syarat_1.mimes' => 'Fotocopy Kwitansi Bimbingan TA Harus PDF',
                'syarat_2.mimes' => 'Fotocopy Kwitansi Sidang TA Harus PDF',
                'syarat_3.mimes' => 'Fotocopy Kwitansi Seminar TA Harus PDF',
                'syarat_4.mimes' => 'Fotocopy Sertifikat Pesantren Calon Sarjana Harus PDF',
                'syarat_5.mimes' => 'Formulir Rencana Studi (FRS) Harus PDF',
                'syarat_6.mimes' => 'Bukti Penyerahan Draft TA Harus PDF',
                'syarat_7.mimes' => 'Bukti Bebas Perpustakaan Pusat UNISBA Harus PDF',
                'syarat_8.mimes' => 'Bukti Bebas Perpustakaan TI Harus PDF',
                'syarat_9.mimes' => 'Transkrip Nilai Terakhir Harus PDF',
                'syarat_10.mimes' => 'Persetujuan Sidang dari Dosen Pembimbing Harus PDF',
                'syarat_11.mimes' => 'Format File Fotocopy Sertifikat TOEFL Harus PDF',
                'syarat_12.mimes' => 'Format File Foto Harus PDF',
                'syarat_13.mimes' => 'Format File Bukti Bebas Pinjaman / Tunggakan Harus PDF',
                'syarat_14.mimes' => 'Format File Menghadiri Seminar / Sidang Harus PDF',
                'syarat_15.mimes' => 'Format File Form Hafalan Surat Al-Quran Harus PDF',
                'syarat_16.mimes' => 'Format File Print out bukti pengecekan Plagiarisme Harus PDF',
                'syarat_17.mimes' => 'Format File Sertifikat SKKFT Harus PDF',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSidang = new DaftarSidang();
            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
            $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
            $syarat_1_path = 'mahasiswa/sidang/syarat01';
            $syarat_1->move($syarat_1_path, $nama_syarat_1);
            $daftarSidang->syarat_1 = $nama_syarat_1;

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
            $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
            $syarat_2_path = 'mahasiswa/sidang/syarat02';
            $syarat_2->move($syarat_2_path, $nama_syarat_2);
            $daftarSidang->syarat_2 = $nama_syarat_2;

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
            $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
            $syarat_3_path = 'mahasiswa/sidang/syarat03';
            $syarat_3->move($syarat_3_path, $nama_syarat_3);
            $daftarSidang->syarat_3 = $nama_syarat_3;

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
            $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
            $syarat_4_path = 'mahasiswa/sidang/syarat04';
            $syarat_4->move($syarat_4_path, $nama_syarat_4);
            $daftarSidang->syarat_4 = $nama_syarat_4;

            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
            $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
            $syarat_5_path = 'mahasiswa/sidang/syarat05';
            $syarat_5->move($syarat_5_path, $nama_syarat_5);
            $daftarSidang->syarat_5 = $nama_syarat_5;

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
            $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
            $syarat_6_path = 'mahasiswa/sidang/syarat06';
            $syarat_6->move($syarat_6_path, $nama_syarat_6);
            $daftarSidang->syarat_6 = $nama_syarat_6;

            // upload syarat 
            $syarat_7 = $request->file('syarat_7');
            $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
            $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
            $syarat_7_path = 'mahasiswa/sidang/syarat07';
            $syarat_7->move($syarat_7_path, $nama_syarat_7);
            $daftarSidang->syarat_7 = $nama_syarat_7;

            // upload syarat 
            $syarat_8 = $request->file('syarat_8');
            $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
            $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
            $syarat_8_path = 'mahasiswa/sidang/syarat08';
            $syarat_8->move($syarat_8_path, $nama_syarat_8);
            $daftarSidang->syarat_8 = $nama_syarat_8;

            // upload syarat 
            $syarat_9 = $request->file('syarat_9');
            $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
            $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
            $syarat_9_path = 'mahasiswa/sidang/syarat09';
            $syarat_9->move($syarat_9_path, $nama_syarat_9);
            $daftarSidang->syarat_9 = $nama_syarat_8;

            // upload syarat 
            $syarat_10 = $request->file('syarat_10');
            $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
            $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
            $syarat_10_path = 'mahasiswa/sidang/syarat10';
            $syarat_10->move($syarat_10_path, $nama_syarat_10);
            $daftarSidang->syarat_10 = $nama_syarat_10;

            // upload syarat 
            $syarat_11 = $request->file('syarat_11');
            $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
            $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
            $syarat_11_path = 'mahasiswa/sidang/syarat11';
            $syarat_11->move($syarat_11_path, $nama_syarat_11);
            $daftarSidang->syarat_11 = $nama_syarat_11;

            // upload syarat 2
            $syarat_12 = $request->file('syarat_12');
            $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
            $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
            $syarat_12_path = 'mahasiswa/sidang/syarat12';
            $syarat_12->move($syarat_12_path, $nama_syarat_12);
            $daftarSidang->syarat_12 = $nama_syarat_12;

            // upload syarat 3
            $syarat_13 = $request->file('syarat_13');
            $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
            $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
            $syarat_13_path = 'mahasiswa/sidang/syarat13';
            $syarat_13->move($syarat_13_path, $nama_syarat_13);
            $daftarSidang->syarat_13 = $nama_syarat_13;

            // upload syarat 
            $syarat_14 = $request->file('syarat_14');
            $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
            $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
            $syarat_14_path = 'mahasiswa/sidang/syarat14';
            $syarat_14->move($syarat_14_path, $nama_syarat_14);
            $daftarSidang->syarat_14 = $nama_syarat_14;

            // upload syarat 
            $syarat_15 = $request->file('syarat_15');
            $ext_syarat_15 = $syarat_15->getClientOriginalExtension();
            $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName() . "." . $ext_syarat_15;
            $syarat_15_path = 'mahasiswa/sidang/syarat15';
            $syarat_15->move($syarat_15_path, $nama_syarat_15);
            $daftarSidang->syarat_15 = $nama_syarat_15;

            // upload syarat 
            $syarat_16 = $request->file('syarat_16');
            $ext_syarat_16 = $syarat_16->getClientOriginalExtension();
            $nama_syarat_16 = $npm . "_" . $syarat_16->getClientOriginalName() . "." . $ext_syarat_16;
            $syarat_16_path = 'mahasiswa/sidang/syarat16';
            $syarat_16->move($syarat_16_path, $nama_syarat_16);
            $daftarSidang->syarat_16 = $nama_syarat_16;

            // upload syarat 
            $syarat_17 = $request->file('syarat_17');
            $ext_syarat_17 = $syarat_17->getClientOriginalExtension();
            $nama_syarat_17 = $npm . "_" . $syarat_17->getClientOriginalName() . "." . $ext_syarat_17;
            $syarat_17_path = 'mahasiswa/sidang/syarat17';
            $syarat_17->move($syarat_17_path, $nama_syarat_17);
            $daftarSidang->syarat_17 = $nama_syarat_17;

            $daftarSidang->save();

            return redirect()->route('sidang_ti.index')->with('success', 'Sukses mengajukan pendaftaran sidang tugas akhir!');
        }
    }

    public function showTi($id)
    {
        $data = DaftarSidang::find($id);
        return view('daftar_sidang.ti.show', compact('data'));
    }

    public function editTi($id)
    {
        $data = DaftarSidang::find($id);
        $title = "Pengajuan Sidang Tugas Akhir";
        Session::put('page', 'daftar_sidang_ti');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Teknik Industri'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        return view('daftar_sidang.ti.edit', compact('data', 'title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function updateTi(Request $request, $id)
    {
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $daftarSidang = DaftarSidang::find($id);
            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            $daftarSidang->status = 0;
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            if (!is_null($syarat_1)) {
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/sidang/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;
                $daftarSidang->status_1 = 0;
            }


            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/sidang/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;
                $daftarSidang->status_2 = 0;
            }


            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/sidang/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;
                $daftarSidang->status_3 = 0;
            }


            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/sidang/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;
                $daftarSidang->status_4 = 0;
            }


            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/sidang/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;
                $daftarSidang->status_5 = 0;
            }

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/sidang/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSidang->syarat_6 = $nama_syarat_6;
                $daftarSidang->status_6 = 0;
            }


            // upload syarat 
            $syarat_7 = $request->file('syarat_7');
            if (!is_null($syarat_7)) {
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/sidang/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSidang->syarat_7 = $nama_syarat_7;
                $daftarSidang->status_7 = 0;
            }

            // upload syarat 
            $syarat_8 = $request->file('syarat_8');
            if (!is_null($syarat_8)) {
                $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
                $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
                $syarat_8_path = 'mahasiswa/sidang/syarat08';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSidang->syarat_8 = $nama_syarat_8;
                $daftarSidang->status_8 = 0;
            }

            // upload syarat 
            $syarat_9 = $request->file('syarat_9');
            if (!is_null($syarat_9)) {
                $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
                $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
                $syarat_9_path = 'mahasiswa/sidang/syarat09';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSidang->syarat_9 = $nama_syarat_9;
                $daftarSidang->status_9 = 0;
            }

            // upload syarat 
            $syarat_10 = $request->file('syarat_10');
            if (!is_null($syarat_10)) {
                $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
                $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
                $syarat_10_path = 'mahasiswa/sidang/syarat10';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSidang->syarat_10 = $nama_syarat_10;
                $daftarSidang->status_10 = 0;
            }

            // upload syarat 
            $syarat_11 = $request->file('syarat_11');
            if (!is_null($syarat_11)) {
                $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
                $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
                $syarat_11_path = 'mahasiswa/sidang/syarat11';
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $daftarSidang->syarat_11 = $nama_syarat_11;
                $daftarSidang->status_11 = 0;
            }

            // upload syarat 
            $syarat_12 = $request->file('syarat_12');
            if (!is_null($syarat_12)) {
                $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
                $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
                $syarat_12_path = 'mahasiswa/sidang/syarat12';
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $daftarSidang->syarat_12 = $nama_syarat_12;
                $daftarSidang->status_12 = 0;
            }

            // upload syarat 
            $syarat_13 = $request->file('syarat_13');
            if (!is_null($syarat_13)) {
                $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
                $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
                $syarat_13_path = 'mahasiswa/sidang/syarat13';
                $syarat_13->move($syarat_13_path, $nama_syarat_13);
                $daftarSidang->syarat_13 = $nama_syarat_13;
                $daftarSidang->status_13 = 0;
            }

            // upload syarat 
            $syarat_14 = $request->file('syarat_14');
            if (!is_null($syarat_14)) {
                $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
                $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
                $syarat_14_path = 'mahasiswa/sidang/syarat14';
                $syarat_14->move($syarat_14_path, $nama_syarat_14);
                $daftarSidang->syarat_14 = $nama_syarat_14;
                $daftarSidang->status_14 = 0;
            }

            // upload syarat 
            $syarat_15 = $request->file('syarat_15');
            if (!is_null($syarat_15)) {
                $ext_syarat_15 = $syarat_15->getClientOriginalExtension();
                $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName() . "." . $ext_syarat_15;
                $syarat_15_path = 'mahasiswa/sidang/syarat15';
                $syarat_15->move($syarat_15_path, $nama_syarat_15);
                $daftarSidang->syarat_15 = $nama_syarat_15;
                $daftarSidang->status_15 = 0;
            }

            // upload syarat 
            $syarat_16 = $request->file('syarat_16');
            if (!is_null($syarat_16)) {
                $ext_syarat_16 = $syarat_16->getClientOriginalExtension();
                $nama_syarat_16 = $npm . "_" . $syarat_16->getClientOriginalName() . "." . $ext_syarat_16;
                $syarat_16_path = 'mahasiswa/sidang/syarat16';
                $syarat_16->move($syarat_16_path, $nama_syarat_16);
                $daftarSidang->syarat_16 = $nama_syarat_16;
                $daftarSidang->status_6 = 0;
            }

            // upload syarat 
            $syarat_17 = $request->file('syarat_17');
            if (!is_null($syarat_17)) {
                $ext_syarat_17 = $syarat_17->getClientOriginalExtension();
                $nama_syarat_17 = $npm . "_" . $syarat_17->getClientOriginalName() . "." . $ext_syarat_17;
                $syarat_17_path = 'mahasiswa/sidang/syarat17';
                $syarat_17->move($syarat_17_path, $nama_syarat_17);
                $daftarSidang->syarat_17 = $nama_syarat_17;
                $daftarSidang->status_17 = 0;
            }

            $daftarSidang->save();

            return redirect()->route('sidang_ti.index')->with('success', 'Sukses mengajukan pendaftaran sidang tugas akhir!');
        }
    }

    public function indexPwk()
    {
        $dataMhs = auth()->user();
        $dataSeminar = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $lastData = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->orderBy('id', 'desc')->first();

        return view('daftar_sidang.pwk.index', compact('dataSeminar', 'lastData'));
    }

    public function daftarPwk()
    {
        $title = "Pengajuan Sidang Terbuka";
        Session::put('page', 'daftar_sidang_ti');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Perencanaan Wilayah dan Kota'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();

        return view('daftar_sidang.pwk.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function storePwk(Request $request)
    {
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'dosen1_id' => 'required',
                'dosen2_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'required|mimes:pdf',
                'syarat_2' => 'required|mimes:pdf',
                'syarat_3' => 'required|mimes:pdf',
                'syarat_4' => 'required|mimes:pdf',
                'syarat_5' => 'required|mimes:pdf',
                'syarat_6' => 'required|mimes:pdf',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Sertifikat pesantren calon sarjana Harus Diisi',
                'syarat_2.required' => 'Transkrip nilai Harus Diisi',
                'syarat_3.required' => 'Sertifikat TOEFL Harus Diisi',
                'syarat_4.required' => 'Sertifikat SKKFT Harus Diisi',
                'syarat_5.required' => 'Pemeriksaan turnitin Harus Diisi',
                'syarat_6.required' => 'Bukti pembayaran sidang terbuka Harus Diisi',
                'syarat_1.mimes' => 'Format File Sertifikat pesantren calon sarjana Harus PDF',
                'syarat_2.mimes' => 'Format File Transkrip nilai Harus PDF',
                'syarat_3.mimes' => 'Format File Sertifikat TOEFL Harus PDF',
                'syarat_4.mimes' => 'Format Sertifikat SKKFT Harus PDF',
                'syarat_5.mimes' => 'Format File Pemeriksaan turnitin Harus PDF',
                'syarat_6.mimes' => 'Format File Bukti pembayaran sidang terbuka Harus PDF',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSeminar = new DaftarSidang();
            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
            $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
            $syarat_1_path = 'mahasiswa/sidang/syarat01';
            $syarat_1->move($syarat_1_path, $nama_syarat_1);
            $daftarSeminar->syarat_1 = $nama_syarat_1;

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
            $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
            $syarat_2_path = 'mahasiswa/sidang/syarat02';
            $syarat_2->move($syarat_2_path, $nama_syarat_2);
            $daftarSeminar->syarat_2 = $nama_syarat_2;

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
            $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
            $syarat_3_path = 'mahasiswa/sidang/syarat03';
            $syarat_3->move($syarat_3_path, $nama_syarat_3);
            $daftarSeminar->syarat_3 = $nama_syarat_3;

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
            $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
            $syarat_4_path = 'mahasiswa/sidang/syarat04';
            $syarat_4->move($syarat_4_path, $nama_syarat_4);
            $daftarSeminar->syarat_4 = $nama_syarat_4;

            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
            $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
            $syarat_5_path = 'mahasiswa/sidang/syarat05';
            $syarat_5->move($syarat_5_path, $nama_syarat_5);
            $daftarSeminar->syarat_5 = $nama_syarat_5;

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
            $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
            $syarat_6_path = 'mahasiswa/sidang/syarat06';
            $syarat_6->move($syarat_6_path, $nama_syarat_6);
            $daftarSeminar->syarat_6 = $nama_syarat_6;

            $daftarSeminar->save();

            return redirect()->route('sidang_pwk.index')->with('success', 'Sukses mengajukan pendaftaran sidang terbuka!');
        }
    }

    public function showPwk($id)
    {
        $data = DaftarSidang::find($id);
        return view('daftar_sidang.pwk.show', compact('data'));
    }

    public function editPwk($id)
    {
        $data = DaftarSidang::find($id);
        $title = "Pengajuan Sidang Terbuka";
        Session::put('page', 'daftar_sidang_pwk');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Perencanaan Wilayah dan Kota'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        return view('daftar_sidang.pwk.edit', compact('data', 'title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function updatePwk(Request $request, $id)
    {
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $daftarSidang = DaftarSidang::find($id);
            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            $daftarSidang->status = 0;
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            if (!is_null($syarat_1)) {
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/seminar/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;
                $daftarSidang->status_1 = 0;
            }


            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/seminar/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;
                $daftarSidang->status_2 = 0;
            }


            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/seminar/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;
                $daftarSidang->status_3 = 0;
            }


            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/seminar/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;
                $daftarSidang->status_4 = 0;
            }


            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/seminar/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;
                $daftarSidang->status_5 = 0;
            }


            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/seminar/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSidang->syarat_6 = $nama_syarat_6;
                $daftarSidang->status_6 = 0;
            }

            $daftarSidang->save();

            return redirect()->route('sidang_pwk.index')->with('success', 'Sukses mengajukan pendaftaran sidang terbuka!');
        }
    }
}
