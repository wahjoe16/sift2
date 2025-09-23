<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\DaftarSeminar;
use App\Models\Semester;
use App\Models\SertifikatSkkft;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class DaftarSidangController extends Controller
{
    public function indexTmb()
    {
        $dataMhs = auth()->user();
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLogSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->first();
        $dataLogSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->first();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->where('status', 1)->first();
        $dataSertifikatSkkft = SertifikatSkkft::where('user_id', $dataMhs->id)->first();
        // dd($dataSeminar);
        Session::put('page', 'indexSkripsi');
        return view('daftar_sidang.tmb.index', compact('dataSidang', 'dataLogSidang', 'dataLogSeminar', 'dataSeminar', 'dataSertifikatSkkft'));
    }

    public function daftarTmb()
    {
        $title = "Pengajuan Sidang Skripsi";
        Session::put('page', 'indexSkripsi');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Teknik Pertambangan'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        $dataMhs = auth()->user();
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLogSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->first();
        $dataLogSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->first();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->where('status', 1)->first();

        return view('daftar_sidang.tmb.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2', 'dataSidang', 'dataLogSidang', 'dataLogSeminar', 'dataSeminar'));
    }

    public function storeTmb(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id' => 'required',
                'dosen1_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'required|mimes:pdf|max:1024',
                'syarat_2' => 'required|mimes:pdf|max:1024',
                'syarat_3' => 'required|mimes:pdf|max:1024',
                'syarat_4' => 'required|mimes:pdf|max:1024',
                'syarat_5' => 'required|mimes:pdf|max:1024',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Akademik Tidak Boleh Kosong',
                'semester_id.required' => 'Semester Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Transkrip Nilai harus diisi',
                'syarat_2.required' => 'Sertifikat Pesantren Calon Sarjana harus diisi',
                'syarat_3.required' => 'Sertifikat SKKFT harus diisi',
                'syarat_4.required' => 'Bukti Pembayaran Sidang Skripsi harus diisi',
                'syarat_5.required' => 'Sertifikat TOEFL yang masih berlaku harus diisi',
                'syarat_1.mimes' => 'Format File Transkrip Nilai harus PDF',
                'syarat_2.mimes' => 'Format File Sertifikat Pesantren Calon Sarjana harus PDF',
                'syarat_3.mimes' => 'Format File SKKFT harus PDF',
                'syarat_4.mimes' => 'Format File Bukti Pembayaran Sidang Skripsi harus PDF',
                'syarat_5.mimes' => 'Format File Sertifikat TOEFL yang masih berlaku harus PDF',
                'syarat_1.max' => 'File Transkrip Nilai tidak boleh melebihi 1MB',
                'syarat_2.max' => 'File Sertifikat Pesantren Calon Sarjana tidak boleh melebihi 1MB',
                'syarat_3.max' => 'File SKKFT tidak boleh melebihi 1MB',
                'syarat_4.max' => 'File Bukti Pembayaran Sidang Skripsi tidak boleh melebihi 1MB',
                'syarat_5.max' => 'File Sertifikat TOEFL yang masih berlaku tidak boleh melebihi 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $mhs = auth()->user();
            $npm = $mhs->nik;
            $daftarSidang = new DaftarSidang();

            $files = [];
            for ($i = 1; $i <= 5; $i++) {
                if ($request->file('syarat_' . $i)) {
                    $files[] = $request->file('syarat_' . $i);
                }
            }

            foreach ($files as $file) {
                $path = 'mahasiswa/sidang';
                $nama = $npm . "_" . time() . "_" . $file->getClientOriginalName();
                $file->move($path, $nama);
                $dataFile[] = $nama;
            }

            $daftarSidang->mahasiswa_id = $mhs->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            $daftarSidang->syarat_1 = $dataFile[0];
            $daftarSidang->syarat_2 = $dataFile[1];
            $daftarSidang->syarat_3 = $dataFile[2];
            $daftarSidang->syarat_4 = $dataFile[3];
            $daftarSidang->syarat_5 = $dataFile[4];
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

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
        Session::put('page', 'indexSkripsi');
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
        if ($request->isMethod('POST')) {

            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id.required' => 'Semester Tidak Boleh Kosong',
                'dosen1_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'mimes:pdf|max:1024',
                'syarat_2' => 'mimes:pdf|max:1024',
                'syarat_3' => 'mimes:pdf|max:1024',
                'syarat_4' => 'mimes:pdf|max:1024',
                'syarat_5' => 'mimes:pdf|max:1024',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Akademik Tidak Boleh Kosong',
                'semester_id.required' => 'Semester Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Transkrip Nilai harus diisi',
                'syarat_2.required' => 'Sertifikat Pesantren Calon Sarjana harus diisi',
                'syarat_3.required' => 'Sertifikat SKKFT harus diisi',
                'syarat_4.required' => 'Bukti Pembayaran Sidang Skripsi harus diisi',
                'syarat_5.required' => 'Sertifikat TOEFL yang masih berlaku harus diisi',
                'syarat_1.mimes' => 'Format File Transkrip Nilai harus PDF',
                'syarat_2.mimes' => 'Format File Sertifikat Pesantren Calon Sarjana harus PDF',
                'syarat_3.mimes' => 'Format File SKKFT harus PDF',
                'syarat_4.mimes' => 'Format File Bukti Pembayaran Sidang Skripsi harus PDF',
                'syarat_5.mimes' => 'Format File Sertifikat TOEFL yang masih berlaku harus PDF',
                'syarat_1.max' => 'File Transkrip Nilai tidak boleh melebihi 1MB',
                'syarat_2.max' => 'File Sertifikat Pesantren Calon Sarjana tidak boleh melebihi 1MB',
                'syarat_3.max' => 'File SKKFT tidak boleh melebihi 1MB',
                'syarat_4.max' => 'File Bukti Pembayaran Sidang Skripsi tidak boleh melebihi 1MB',
                'syarat_5.max' => 'File Sertifikat TOEFL yang masih berlaku tidak boleh melebihi 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $mhs = auth()->user();
            $npm = $mhs->nik;
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
                $nama_syarat_1 = $npm . "_" . time() . "_" . $syarat_1->getClientOriginalName();
                $syarat_1_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_1);
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;
                $daftarSidang->status_1 = 0;
            }

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
                $syarat_2_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_2);
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;
                $daftarSidang->status_2 = 0;
            }

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
                $syarat_3_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_3);
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;
                $daftarSidang->status_3 = 0;
            }

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
                $syarat_4_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_4);
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;
                $daftarSidang->status_4 = 0;
            }

            // upload syarat 5
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
                $syarat_5_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_5);
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;
                $daftarSidang->status_5 = 0;
            }

            $daftarSidang->save();

            return redirect()->route('sidang_tmb.index')->with('success', 'Sukses mengajukan pendaftaran sidang skripsi!');
        }
    }

    public function indexTi()
    {
        $dataMhs = auth()->user();
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLogSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->first();
        $dataLogSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->first();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->where('status', 1)->first();
        $dataSertifikatSkkft = SertifikatSkkft::where('user_id', $dataMhs->id)->first();
        Session::put('page', 'sidangTA');
        return view('daftar_sidang.ti.index', compact('dataSidang', 'dataLogSidang', 'dataLogSeminar', 'dataSeminar', 'dataSertifikatSkkft'));
    }

    public function daftarTi()
    {
        $title = "Pengajuan Sidang Tugas Akhir";
        Session::put('page', 'sidangTA');
        $dosen1 = User::where('level', 2)->get();
        $dosen2 = User::where('level', 2)->get();
        $dosen3 = User::where('level', 2)->get();
        $dosen4 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        $dataMhs = auth()->user();
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLogSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->first();
        $dataLogSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->first();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->where('status', 1)->first();

        return view('daftar_sidang.ti.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2', 'dosen3', 'dosen4' ,'dataSidang', 'dataLogSidang', 'dataLogSeminar', 'dataSeminar'));
    }

    public function storeTi(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id' => 'required',
                'dosen1_id' => 'required',
                'dosen3_id' => 'required',
                'dosen4_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'required|mimes:pdf|max:1024',
                'syarat_2' => 'required|mimes:pdf|max:1024',
                'syarat_3' => 'required|mimes:pdf|max:1024',
                'syarat_4' => 'required|mimes:pdf|max:1024',
                'syarat_5' => 'required|mimes:pdf|max:1024',
                'syarat_6' => 'required|mimes:pdf|max:1024',
                'syarat_7' => 'required|mimes:pdf|max:1024',
                'syarat_8' => 'required|mimes:pdf|max:1024',
                'syarat_9' => 'required|mimes:pdf|max:1024',
                'syarat_10' => 'required|mimes:pdf|max:1024',
                'syarat_11' => 'required|mimes:pdf|max:1024',
                'syarat_12' => 'required|mimes:pdf|max:1024',
                'syarat_13' => 'required|mimes:pdf|max:1024',
                'syarat_14' => 'required|mimes:pdf|max:1024',
                'syarat_15' => 'required|mimes:pdf|max:1024',
                'syarat_16' => 'required|mimes:pdf|max:1024',
                'syarat_17' => 'required|mimes:pdf|max:1024',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'dosen3_id.required' => 'Dosen Penguji 1 Seminar Tidak Boleh Kosong',
                'dosen4_id.required' => 'Dosen Penguji 2 Seminar Tidak Boleh Kosong',
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
                'syarat_1.mimes' => 'Format File Fotocopy Kwitansi Bimbingan TA Harus PDF',
                'syarat_2.mimes' => 'Format File Fotocopy Kwitansi Sidang TA Harus PDF',
                'syarat_3.mimes' => 'Format File Fotocopy Kwitansi Seminar TA Harus PDF',
                'syarat_4.mimes' => 'Format File Fotocopy Sertifikat Pesantren Calon Sarjana Harus PDF',
                'syarat_5.mimes' => 'Format File Formulir Rencana Studi (FRS) Harus PDF',
                'syarat_6.mimes' => 'Format File Bukti Penyerahan Draft TA Harus PDF',
                'syarat_7.mimes' => 'Format File Bukti Bebas Perpustakaan Pusat UNISBA Harus PDF',
                'syarat_8.mimes' => 'Format File Bukti Bebas Perpustakaan TI Harus PDF',
                'syarat_9.mimes' => 'Format File Transkrip Nilai Terakhir Harus PDF',
                'syarat_10.mimes' => 'Format File Persetujuan Sidang dari Dosen Pembimbing Harus PDF',
                'syarat_11.mimes' => 'Format File Fotocopy Sertifikat TOEFL Harus PDF',
                'syarat_12.mimes' => 'Format File Foto Harus PDF',
                'syarat_13.mimes' => 'Format File Bukti Bebas Pinjaman / Tunggakan Harus PDF',
                'syarat_14.mimes' => 'Format File Menghadiri Seminar / Sidang Harus PDF',
                'syarat_15.mimes' => 'Format File Form Hafalan Surat Al-Quran Harus PDF',
                'syarat_16.mimes' => 'Format File Print out bukti pengecekan Plagiarisme Harus PDF',
                'syarat_17.mimes' => 'Format File Sertifikat SKKFT Harus PDF',
                'syarat_1.max' => 'Format File Fotocopy Kwitansi Bimbingan TA tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'Format File Fotocopy Kwitansi Sidang TA tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'Format File Fotocopy Kwitansi Seminar TA tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'Format File Fotocopy Sertifikat Pesantren Calon Sarjana tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'Format File Formulir Rencana Studi (FRS) tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'Format File Bukti Penyerahan Draft TA tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'Format File Bukti Bebas Perpustakaan Pusat UNISBA tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'Format File Bukti Bebas Perpustakaan TI tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'Format File Transkrip Nilai Terakhir tidak boleh lebih dari 1MB',
                'syarat_10.max' => 'Format File Persetujuan Sidang dari Dosen Pembimbing tidak boleh lebih dari 1MB',
                'syarat_11.max' => 'Format File Fotocopy Sertifikat TOEFL tidak boleh lebih dari 1MB',
                'syarat_12.max' => 'Format File Foto tidak boleh lebih dari 1MB',
                'syarat_13.max' => 'Format File Bukti Bebas Pinjaman / Tunggakan tidak boleh lebih dari 1MB',
                'syarat_14.max' => 'Format File Menghadiri Seminar / Sidang tidak boleh lebih dari 1MB',
                'syarat_15.max' => 'Format File Form Hafalan Surat Al-Quran tidak boleh lebih dari 1MB',
                'syarat_16.max' => 'Format File Print out bukti pengecekan Plagiarisme tidak boleh lebih dari 1MB',
                'syarat_17.max' => 'Format File Sertifikat SKKFT tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $mhs = auth()->user();
            $npm = $mhs->nik;
            $daftarSidang = new DaftarSidang();

            $files = [];
            for ($i = 1; $i <= 17; $i++) {
                if ($request->file('syarat_' . $i)) {
                    $files[] = $request->file('syarat_' . $i);
                }
            }

            foreach ($files as $file) {
                $path = 'mahasiswa/sidang';
                $nama = $npm . "_" . time() . "_" . $file->getClientOriginalName();
                $file->move($path, $nama);
                $dataFile[] = $nama;
            }

            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->dosen3_id = $request['dosen3_id'];
            $daftarSidang->dosen4_id = $request['dosen4_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));
            $daftarSidang->syarat_1 = $dataFile[0];
            $daftarSidang->syarat_2 = $dataFile[1];
            $daftarSidang->syarat_3 = $dataFile[2];
            $daftarSidang->syarat_4 = $dataFile[3];
            $daftarSidang->syarat_5 = $dataFile[4];
            $daftarSidang->syarat_6 = $dataFile[5];
            $daftarSidang->syarat_7 = $dataFile[6];
            $daftarSidang->syarat_8 = $dataFile[7];
            $daftarSidang->syarat_9 = $dataFile[8];
            $daftarSidang->syarat_10 = $dataFile[9];
            $daftarSidang->syarat_11 = $dataFile[10];
            $daftarSidang->syarat_12 = $dataFile[11];
            $daftarSidang->syarat_13 = $dataFile[12];
            $daftarSidang->syarat_14 = $dataFile[13];
            $daftarSidang->syarat_15 = $dataFile[14];
            $daftarSidang->syarat_16 = $dataFile[15];
            $daftarSidang->syarat_17 = $dataFile[16];

            // // upload syarat 
            // $syarat_1 = $request->file('syarat_1');
            // $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName();
            // $syarat_1_path = 'mahasiswa/sidang';
            // $syarat_1->move($syarat_1_path, $nama_syarat_1);
            // $daftarSidang->syarat_1 = $nama_syarat_1;

            // // upload syarat 2
            // $syarat_2 = $request->file('syarat_2');
            // $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName();
            // $syarat_2_path = 'mahasiswa/sidang';
            // $syarat_2->move($syarat_2_path, $nama_syarat_2);
            // $daftarSidang->syarat_2 = $nama_syarat_2;

            // // upload syarat 3
            // $syarat_3 = $request->file('syarat_3');
            // $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName();
            // $syarat_3_path = 'mahasiswa/sidang';
            // $syarat_3->move($syarat_3_path, $nama_syarat_3);
            // $daftarSidang->syarat_3 = $nama_syarat_3;

            // // upload syarat 
            // $syarat_4 = $request->file('syarat_4');
            // $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName();
            // $syarat_4_path = 'mahasiswa/sidang';
            // $syarat_4->move($syarat_4_path, $nama_syarat_4);
            // $daftarSidang->syarat_4 = $nama_syarat_4;

            // // upload syarat 
            // $syarat_5 = $request->file('syarat_5');
            // $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName();
            // $syarat_5_path = 'mahasiswa/sidang';
            // $syarat_5->move($syarat_5_path, $nama_syarat_5);
            // $daftarSidang->syarat_5 = $nama_syarat_5;

            // // upload syarat 
            // $syarat_6 = $request->file('syarat_6');
            // $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName();
            // $syarat_6_path = 'mahasiswa/sidang';
            // $syarat_6->move($syarat_6_path, $nama_syarat_6);
            // $daftarSidang->syarat_6 = $nama_syarat_6;

            // // upload syarat 
            // $syarat_7 = $request->file('syarat_7');
            // $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName();
            // $syarat_7_path = 'mahasiswa/sidang';
            // $syarat_7->move($syarat_7_path, $nama_syarat_7);
            // $daftarSidang->syarat_7 = $nama_syarat_7;

            // // upload syarat 
            // $syarat_8 = $request->file('syarat_8');
            // $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName();
            // $syarat_8_path = 'mahasiswa/sidang';
            // $syarat_8->move($syarat_8_path, $nama_syarat_8);
            // $daftarSidang->syarat_8 = $nama_syarat_8;

            // // upload syarat 
            // $syarat_9 = $request->file('syarat_9');
            // $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName();
            // $syarat_9_path = 'mahasiswa/sidang';
            // $syarat_9->move($syarat_9_path, $nama_syarat_9);
            // $daftarSidang->syarat_9 = $nama_syarat_9;

            // // upload syarat 
            // $syarat_10 = $request->file('syarat_10');
            // $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName();
            // $syarat_10_path = 'mahasiswa/sidang';
            // $syarat_10->move($syarat_10_path, $nama_syarat_10);
            // $daftarSidang->syarat_10 = $nama_syarat_10;

            // // upload syarat 
            // $syarat_11 = $request->file('syarat_11');
            // $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName();
            // $syarat_11_path = 'mahasiswa/sidang';
            // $syarat_11->move($syarat_11_path, $nama_syarat_11);
            // $daftarSidang->syarat_11 = $nama_syarat_11;

            // // upload syarat 2
            // $syarat_12 = $request->file('syarat_12');
            // $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName();
            // $syarat_12_path = 'mahasiswa/sidang';
            // $syarat_12->move($syarat_12_path, $nama_syarat_12);
            // $daftarSidang->syarat_12 = $nama_syarat_12;

            // // upload syarat 3
            // $syarat_13 = $request->file('syarat_13');
            // $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName();
            // $syarat_13_path = 'mahasiswa/sidang';
            // $syarat_13->move($syarat_13_path, $nama_syarat_13);
            // $daftarSidang->syarat_13 = $nama_syarat_13;

            // // upload syarat 
            // $syarat_14 = $request->file('syarat_14');
            // $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName();
            // $syarat_14_path = 'mahasiswa/sidang';
            // $syarat_14->move($syarat_14_path, $nama_syarat_14);
            // $daftarSidang->syarat_14 = $nama_syarat_14;

            // // upload syarat 
            // $syarat_15 = $request->file('syarat_15');
            // $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName();
            // $syarat_15_path = 'mahasiswa/sidang';
            // $syarat_15->move($syarat_15_path, $nama_syarat_15);
            // $daftarSidang->syarat_15 = $nama_syarat_15;

            // // upload syarat 
            // $syarat_16 = $request->file('syarat_16');
            // $nama_syarat_16 = $npm . "_" . $syarat_16->getClientOriginalName();
            // $syarat_16_path = 'mahasiswa/sidang';
            // $syarat_16->move($syarat_16_path, $nama_syarat_16);
            // $daftarSidang->syarat_16 = $nama_syarat_16;

            // // upload syarat 
            // $syarat_17 = $request->file('syarat_17');
            // $nama_syarat_17 = $npm . "_" . $syarat_17->getClientOriginalName();
            // $syarat_17_path = 'mahasiswa/sidang';
            // $syarat_17->move($syarat_17_path, $nama_syarat_17);
            // $daftarSidang->syarat_17 = $nama_syarat_17;

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
        Session::put('page', 'sidangTA');
        $dosen1 = User::where('level', 2)->get();
        $dosen2 = User::where('level', 2)->get();
        $dosen3 = User::where('level', 2)->get();
        $dosen4 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        return view('daftar_sidang.ti.edit', compact('data', 'title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2', 'dosen3', 'dosen4'));
    }

    public function updateTi(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $mhs = auth()->user();
            $npm = $mhs->nik;
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
                $nama_syarat_1 = $npm . "_" . time() . "_" . $syarat_1->getClientOriginalName();
                $syarat_1_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_1);
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;
                $daftarSidang->status_1 = 0;
            }

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
                $syarat_2_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_2);
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;
                $daftarSidang->status_2 = 0;
            }

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
                $syarat_3_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_3);
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;
                $daftarSidang->status_3 = 0;
            }

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
                $syarat_4_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_4);
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;
                $daftarSidang->status_4 = 0;
            }

            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
                $syarat_5_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_5);
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;
                $daftarSidang->status_5 = 0;
            }

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $nama_syarat_6 = $npm . "_" . time() . "_" . $syarat_6->getClientOriginalName();
                $syarat_6_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_6);
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSidang->syarat_6 = $nama_syarat_6;
                $daftarSidang->status_6 = 0;
            }

            // upload syarat 
            $syarat_7 = $request->file('syarat_7');
            if (!is_null($syarat_7)) {
                $nama_syarat_7 = $npm . "_" . time() . "_" . $syarat_7->getClientOriginalName();
                $syarat_7_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_7);
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSidang->syarat_7 = $nama_syarat_7;
                $daftarSidang->status_7 = 0;
            }

            // upload syarat 
            $syarat_8 = $request->file('syarat_8');
            if (!is_null($syarat_8)) {
                $nama_syarat_8 = $npm . "_" . time() . "_" . $syarat_8->getClientOriginalName();
                $syarat_8_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_8);
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSidang->syarat_8 = $nama_syarat_8;
                $daftarSidang->status_8 = 0;
            }

            // upload syarat 
            $syarat_9 = $request->file('syarat_9');
            if (!is_null($syarat_9)) {
                $nama_syarat_9 = $npm . "_" . time() . "_" . $syarat_9->getClientOriginalName();
                $syarat_9_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_9);
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSidang->syarat_9 = $nama_syarat_9;
                $daftarSidang->status_9 = 0;
            }

            // upload syarat 
            $syarat_10 = $request->file('syarat_10');
            if (!is_null($syarat_10)) {
                $nama_syarat_10 = $npm . "_" . time() . "_" . $syarat_10->getClientOriginalName();
                $syarat_10_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_10);
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSidang->syarat_10 = $nama_syarat_10;
                $daftarSidang->status_10 = 0;
            }

            // upload syarat 
            $syarat_11 = $request->file('syarat_11');
            if (!is_null($syarat_11)) {
                $nama_syarat_11 = $npm . "_" . time() . "_" . $syarat_11->getClientOriginalName();
                $syarat_11_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_11);
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $daftarSidang->syarat_11 = $nama_syarat_11;
                $daftarSidang->status_11 = 0;
            }

            // upload syarat 
            $syarat_12 = $request->file('syarat_12');
            if (!is_null($syarat_12)) {
                $nama_syarat_12 = $npm . "_" . time() . "_" . $syarat_12->getClientOriginalName();
                $syarat_12_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_12);
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $daftarSidang->syarat_12 = $nama_syarat_12;
                $daftarSidang->status_12 = 0;
            }

            // upload syarat 
            $syarat_13 = $request->file('syarat_13');
            if (!is_null($syarat_13)) {
                $nama_syarat_13 = $npm . "_" . time() . "_" . $syarat_13->getClientOriginalName();
                $syarat_13_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_13);
                $syarat_13->move($syarat_13_path, $nama_syarat_13);
                $daftarSidang->syarat_13 = $nama_syarat_13;
                $daftarSidang->status_13 = 0;
            }

            // upload syarat 
            $syarat_14 = $request->file('syarat_14');
            if (!is_null($syarat_14)) {
                $nama_syarat_14 = $npm . "_" . time() . "_" . $syarat_14->getClientOriginalName();
                $syarat_14_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_14);
                $syarat_14->move($syarat_14_path, $nama_syarat_14);
                $daftarSidang->syarat_14 = $nama_syarat_14;
                $daftarSidang->status_14 = 0;
            }

            // upload syarat 
            $syarat_15 = $request->file('syarat_15');
            if (!is_null($syarat_15)) {
                $nama_syarat_15 = $npm . "_" . time() . "_" . $syarat_15->getClientOriginalName();
                $syarat_15_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_15);
                $syarat_15->move($syarat_15_path, $nama_syarat_15);
                $daftarSidang->syarat_15 = $nama_syarat_15;
                $daftarSidang->status_15 = 0;
            }

            // upload syarat 
            $syarat_16 = $request->file('syarat_16');
            if (!is_null($syarat_16)) {
                $nama_syarat_16 = $npm . "_" . time() . "_" . $syarat_16->getClientOriginalName();
                $syarat_16_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_16);
                $syarat_16->move($syarat_16_path, $nama_syarat_16);
                $daftarSidang->syarat_16 = $nama_syarat_16;
                $daftarSidang->status_16 = 0;
            }

            // upload syarat 
            $syarat_17 = $request->file('syarat_17');
            if (!is_null($syarat_17)) {
                $nama_syarat_17 = $npm . "_" . time() . "_" . $syarat_17->getClientOriginalName();
                $syarat_17_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_17);
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
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLogSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->first();
        $dataLogSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->first();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->where('status', 1)->first();
        $dataSertifikatSkkft = SertifikatSkkft::where('user_id', $dataMhs->id)->first();
        Session::put('page', 'ST');
        return view('daftar_sidang.pwk.index', compact('dataSidang', 'dataLogSidang', 'dataLogSeminar', 'dataSeminar', 'dataSertifikatSkkft'));
    }

    public function daftarPwk()
    {
        $title = "Pengajuan Sidang Terbuka";
        Session::put('page', 'ST');
        $dosen1 = User::where('level', 2)->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        $dataMhs = auth()->user();
        $dataSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLogSidang = DaftarSidang::where('mahasiswa_id', $dataMhs->id)->first();
        $dataLogSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->first();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->where('status', 1)->first();

        return view('daftar_sidang.pwk.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2', 'dataSidang', 'dataLogSidang', 'dataLogSeminar', 'dataSeminar'));
    }

    public function storePwk(Request $request)
    {
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id' => 'required',
                'dosen1_id' => 'required',
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
                'tahun_ajaran_id.required' => 'Tahun Akademik Tidak Boleh Kosong',
                'semester_id.required' => 'Semester Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
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
            $nama_syarat_1 = $npm . "_" . time() . "_" . $syarat_1->getClientOriginalName();
            $syarat_1_path = 'mahasiswa/sidang';
            $syarat_1->move($syarat_1_path, $nama_syarat_1);
            $daftarSeminar->syarat_1 = $nama_syarat_1;

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
            $syarat_2_path = 'mahasiswa/sidang';
            $syarat_2->move($syarat_2_path, $nama_syarat_2);
            $daftarSeminar->syarat_2 = $nama_syarat_2;

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
            $syarat_3_path = 'mahasiswa/sidang';
            $syarat_3->move($syarat_3_path, $nama_syarat_3);
            $daftarSeminar->syarat_3 = $nama_syarat_3;

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
            $syarat_4_path = 'mahasiswa/sidang';
            $syarat_4->move($syarat_4_path, $nama_syarat_4);
            $daftarSeminar->syarat_4 = $nama_syarat_4;

            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
            $syarat_5_path = 'mahasiswa/sidang';
            $syarat_5->move($syarat_5_path, $nama_syarat_5);
            $daftarSeminar->syarat_5 = $nama_syarat_5;

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            $nama_syarat_6 = $npm . "_" . time() . "_" . $syarat_6->getClientOriginalName();
            $syarat_6_path = 'mahasiswa/sidang';
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
        Session::put('page', 'ST');
        $dosen1 = User::where('level', 2)->get();
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
                $nama_syarat_1 = $npm . "_" . time() . "_" . $syarat_1->getClientOriginalName();
                $syarat_1_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_1);
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;
                $daftarSidang->status_1 = 0;
            }


            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
                $syarat_2_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_2);
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;
                $daftarSidang->status_2 = 0;
            }


            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
                $syarat_3_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_3);
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;
                $daftarSidang->status_3 = 0;
            }


            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
                $syarat_4_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_4);
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;
                $daftarSidang->status_4 = 0;
            }


            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
                $syarat_5_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_5);
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;
                $daftarSidang->status_5 = 0;
            }


            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $nama_syarat_6 = $npm . "_" . time() . "_" . $syarat_6->getClientOriginalName();
                $syarat_6_path = 'mahasiswa/sidang';
                File::delete('mahasiswa/sidang/' . $daftarSidang->syarat_6);
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSidang->syarat_6 = $nama_syarat_6;
                $daftarSidang->status_6 = 0;
            }

            $daftarSidang->save();

            return redirect()->route('sidang_pwk.index')->with('success', 'Sukses mengajukan pendaftaran sidang terbuka!');
        }
    }
}
