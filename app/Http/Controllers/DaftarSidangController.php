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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            $daftarSidang = new DaftarSidang();

            $pathFolder = 'mahasiswa/sidang';

            for ($i = 1; $i <= 5; $i++) {
                $fieldName = 'syarat_' . $i;

                if ($request->hasFile($fieldName)) {
                    $file = $request->file($fieldName);
                    $fileName = Str::uuid() . '.' . $file->extension();

                    // Simpan file ke folder storage/app/mahasiswa/sidang
                    $filePath = $file->storeAs($pathFolder, $fileName, 'public');

                    // Simpan nama file ke database
                    $daftarSidang->mahasiswa_id = $mhs->id;
                    $daftarSidang->program_studi_id = auth()->user()->program_studi;
                    $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                    $daftarSidang->semester_id = $request['semester_id'];
                    $daftarSidang->dosen1_id = $request['dosen1_id'];
                    $daftarSidang->dosen2_id = $request['dosen2_id'];
                    $daftarSidang->judul_skripsi = $request['judul_skripsi']; 
                    $daftarSidang->{$fieldName} = $filePath;
                    $daftarSidang->save();
                } else {
                    $daftarSidang->{$fieldName} = null; // atau bisa diisi dengan nilai default jika diperlukan
                }
            }
            
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

            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            $daftarSidang = DaftarSidang::find($id);
            $folderPath = 'mahasiswa/sidang';

            for ($i = 1; $i <= 5; $i++) {
                $fieldFile = 'syarat_' . $i;
                $fieldStatus = 'status_' . $i;

                if ($request->hasFile($fieldFile)) {
                    $file = $request->file($fieldFile);

                    if (!empty($daftarSidang->{$fieldFile}) && Storage::disk('public')->exists($daftarSidang->{$fieldFile})) {
                        Storage::disk('public')->delete($daftarSidang->{$fieldFile});
                    }

                    $fileName = Str::uuid() . '.' . $file->extension();

                    // Simpan file ke folder storage/app/mahasiswa/sidang
                    $filePath = $file->storeAs($folderPath, $fileName, 'public');

                    // Simpan nama file ke database
                    $daftarSidang->{$fieldFile} = $filePath;
                    $daftarSidang->{$fieldStatus} = 0;
                }
            }
            
            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            $daftarSidang->status = 0;
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
                'syarat_6' => 'required|mimes:pdf|max:10240',
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
                'syarat_6.required' => 'Softcopy Draft TA Harus Diisi',
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
                'syarat_6.mimes' => 'Format Softcopy Draft TA Harus PDF',
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
                'syarat_6.max' => 'Format File Softcopy Draft TA tidak boleh lebih dari 10MB',
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

            $daftarSidang = new DaftarSidang();
            $pathFolder = 'mahasiswa/sidang';

            for ($i = 1; $i <= 17; $i++) {
                $fieldName = 'syarat_' . $i;

                if ($request->hasFile($fieldName)) {
                    $files = $request->file($fieldName);
                    $fileName = Str::uuid() . '.' . $files->extension();

                    $filePath = $files->storeAs($pathFolder, $fileName, 'public');

                    $daftarSidang->mahasiswa_id = auth()->user()->id;
                    $daftarSidang->program_studi_id = auth()->user()->program_studi;
                    $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                    $daftarSidang->semester_id = $request['semester_id'];
                    $daftarSidang->dosen1_id = $request['dosen1_id'];
                    $daftarSidang->dosen2_id = $request['dosen2_id'];
                    $daftarSidang->dosen3_id = $request['dosen3_id'];
                    $daftarSidang->dosen4_id = $request['dosen4_id'];
                    $daftarSidang->judul_skripsi = $request['judul_skripsi'];
                    $daftarSidang->{$fieldName} = $filePath;
                    $daftarSidang->save();
                }
            }

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

            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id' => 'required',
                'dosen1_id' => 'required',
                'dosen3_id' => 'required',
                'dosen4_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'mimes:pdf|max:1024',
                'syarat_2' => 'mimes:pdf|max:1024',
                'syarat_3' => 'mimes:pdf|max:1024',
                'syarat_4' => 'mimes:pdf|max:1024',
                'syarat_5' => 'mimes:pdf|max:1024',
                'syarat_6' => 'mimes:pdf|max:10240',
                'syarat_7' => 'mimes:pdf|max:1024',
                'syarat_8' => 'mimes:pdf|max:1024',
                'syarat_9' => 'mimes:pdf|max:1024',
                'syarat_10' => 'mimes:pdf|max:1024',
                'syarat_11' => 'mimes:pdf|max:1024',
                'syarat_12' => 'mimes:pdf|max:1024',
                'syarat_13' => 'mimes:pdf|max:1024',
                'syarat_14' => 'mimes:pdf|max:1024',
                'syarat_15' => 'mimes:pdf|max:1024',
                'syarat_16' => 'mimes:pdf|max:1024',
                'syarat_17' => 'mimes:pdf|max:1024',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'dosen3_id.required' => 'Dosen Penguji 1 Seminar Tidak Boleh Kosong',
                'dosen4_id.required' => 'Dosen Penguji 2 Seminar Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.mimes' => 'Format File Fotocopy Kwitansi Bimbingan TA Harus PDF',
                'syarat_2.mimes' => 'Format File Fotocopy Kwitansi Sidang TA Harus PDF',
                'syarat_3.mimes' => 'Format File Fotocopy Kwitansi Seminar TA Harus PDF',
                'syarat_4.mimes' => 'Format File Fotocopy Sertifikat Pesantren Calon Sarjana Harus PDF',
                'syarat_5.mimes' => 'Format File Formulir Rencana Studi (FRS) Harus PDF',
                'syarat_6.mimes' => 'Format Softcopy Draft TA Harus PDF',
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
                'syarat_6.max' => 'Format File Softcopy Draft TA tidak boleh lebih dari 10MB',
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

            $daftarSidang = DaftarSidang::find($id);
            $folderPath = 'mahasiswa/sidang';

            for ($i = 1; $i <= 17; $i++) {
                $fieldFile = 'syarat_' . $i;
                $fieldStatus = 'status_' . $i;

                if ($request->hasFile($fieldFile)) {
                    $file = $request->file($fieldFile);

                    if (!empty($daftarSidang->{$fieldFile}) && Storage::disk('public')->exists($daftarSidang->{$fieldFile})) {
                        Storage::disk('public')->delete($daftarSidang->{$fieldFile});
                    }

                    $fileName = Str::uuid() . '.' . $file->extension();

                    // Simpan file ke folder storage/app/mahasiswa/sidang
                    $filePath = $file->storeAs($folderPath, $fileName, 'public');

                    // Simpan nama file ke database
                    $daftarSidang->{$fieldFile} = $filePath;
                    $daftarSidang->{$fieldStatus} = 0;
                }
            }

            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            $daftarSidang->status = 0;
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

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
            $pathFolder = 'mahasiswa/sidang';

            for ($i = 1; $i <= 6; $i++) {
                $fieldName = 'syarat_' . $i;

                if ($request->hasFile($fieldName)) {
                    $files = $request->file($fieldName);
                    $fileName = Str::uuid() . '.' . $files->extension();

                    $filePath = $files->storeAs($pathFolder, $fileName, 'public');

                    $daftarSeminar->mahasiswa_id = auth()->user()->id;
                    $daftarSeminar->program_studi_id = auth()->user()->program_studi;
                    $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
                    $daftarSeminar->semester_id = $request['semester_id'];
                    $daftarSeminar->dosen1_id = $request['dosen1_id'];
                    $daftarSeminar->dosen2_id = $request['dosen2_id'];
                    $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
                    $daftarSeminar->{$fieldName} = $filePath;
                    // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));
                    $daftarSeminar->save();
                }
            }

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
        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id' => 'required',
                'dosen1_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'mimes:pdf',
                'syarat_2' => 'mimes:pdf',
                'syarat_3' => 'mimes:pdf',
                'syarat_4' => 'mimes:pdf',
                'syarat_5' => 'mimes:pdf',
                'syarat_6' => 'mimes:pdf',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Akademik Tidak Boleh Kosong',
                'semester_id.required' => 'Semester Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                
                'syarat_1.mimes' => 'Format File Sertifikat pesantren calon sarjana Harus PDF',
                'syarat_2.mimes' => 'Format File Transkrip nilai Harus PDF',
                'syarat_3.mimes' => 'Format File Sertifikat TOEFL Harus PDF',
                'syarat_4.mimes' => 'Format Sertifikat SKKFT Harus PDF',
                'syarat_5.mimes' => 'Format File Pemeriksaan turnitin Harus PDF',
                'syarat_6.mimes' => 'Format File Bukti pembayaran sidang terbuka Harus PDF',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSidang = DaftarSidang::find($id);
            $pathFolder = 'mahasiswa/sidang';

            for ($i = 1; $i <= 6; $i++) {
                $fieldFile = 'syarat_' . $i;
                $fieldStatus = 'status_' . $i;

                if ($request->hasFile($fieldFile)) {
                    $file = $request->file($fieldFile);

                    if (!empty($daftarSidang->{$fieldFile}) && Storage::disk('public')->exists($daftarSidang->{$fieldFile})) {
                        Storage::disk('public')->delete($daftarSidang->{$fieldFile});
                    }

                    $fileName = Str::uuid() . '.' . $file->extension();

                    // Simpan file ke folder storage/app/mahasiswa/sidang
                    $filePath = $file->storeAs($pathFolder, $fileName, 'public');

                    // Simpan nama file ke database
                    $daftarSidang->{$fieldFile} = $filePath;
                    $daftarSidang->{$fieldStatus} = 0;
                }
            }

            $daftarSidang->mahasiswa_id = auth()->user()->id;
            $daftarSidang->program_studi_id = auth()->user()->program_studi;
            $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSidang->semester_id = $request['semester_id'];
            $daftarSidang->dosen1_id = $request['dosen1_id'];
            $daftarSidang->dosen2_id = $request['dosen2_id'];
            $daftarSidang->judul_skripsi = $request['judul_skripsi'];
            $daftarSidang->status = 0;
            // $daftarSidang->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));
            $daftarSidang->save();

            return redirect()->route('sidang_pwk.index')->with('success', 'Sukses mengajukan pendaftaran sidang terbuka!');
        }
    }
}
