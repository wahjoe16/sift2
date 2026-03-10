<?php

namespace App\Http\Controllers;

use App\Models\DaftarSeminar;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DaftarSeminarController extends Controller
{
    public function indexTmb()
    {
        $dataMhs = auth()->user();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLog = DaftarSeminar::where('mahasiswa_id', auth()->user()->id)->first();
        Session::put('page', 'indexKolokium');
        return view('daftar_seminar.tmb.index', compact('dataSeminar', 'dataLog'));
    }

    public function daftarTmb()
    {
        $title = "Pengajuan Kolokium Skripsi";
        Session::put('page', 'indexKolokium');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Teknik Pertambangan'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        $dataLog = DaftarSeminar::where('mahasiswa_id', auth()->user()->id)->first();

        return view('daftar_seminar.tmb.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2', 'dataLog'));
    }

    public function storeTmb(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'dosen1_id' => 'required',
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
                'syarat_12' => 'required|mimes:pdf|max:10240',
                'syarat_13' => 'required|mimes:pdf|max:1024',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Bukti pembayaran kolokium skripsi harus diisi',
                'syarat_2.required' => 'Sertifikat TOEFL harus diisi',
                'syarat_3.required' => 'Formulir nilai bimbingan skripsi harus diisi',
                'syarat_4.required' => 'Formulir kemajuan bimbingan skripsi harus diisi',
                'syarat_5.required' => 'Formulir persetujuan kolokium skripsi harus diisi',
                'syarat_6.required' => 'Formulir kesediaan menghadiri kolokium skripsi harus diisi',
                'syarat_7.required' => 'Pas foto ukuran 4 x 6 sebanyak 2 lembar harus diisi',
                'syarat_8.required' => 'Kartu Tanda Mahasiswa harus diisi',
                'syarat_9.required' => 'Bukti pembayaran kuliah harus diisi',
                'syarat_10.required' => 'Bukti perwalian harus diisi',
                'syarat_11.required' => 'Bukti bebas pinjaman perpustakaan harus diisi',
                'syarat_12.required' => 'Draft skripsi (PDF) Harus Diisi',
                'syarat_13.required' => 'Transkrip Nilai Harus Diisi',
                'syarat_1.mimes' => 'Format File Bukti pembayaran Kolokium Skripsi harus PDF',
                'syarat_2.mimes' => 'Format File Sertifikat TOEFL harus PDF',
                'syarat_3.mimes' => 'Format File Formulir nilai bimbingan skripsi harus PDF',
                'syarat_4.mimes' => 'Format File Formulir kemajuan bimbingan skripsi harus PDF',
                'syarat_5.mimes' => 'Format File Formulir persetujuan kolokium skripsi harus PDF',
                'syarat_6.mimes' => 'Format File Formulir kesediaan menghadiri kolokium skripsi harus PDF',
                'syarat_7.mimes' => 'Format File Pas foto ukuran 4 x 6 sebanyak 2 lembar harus PDF',
                'syarat_8.mimes' => 'Format File Kartu Tanda Mahasiswa harus PDF',
                'syarat_9.mimes' => 'Format File Bukti pembayaran kuliah harus PDF',
                'syarat_10.mimes' => 'Format File Bukti perwalian harus PDF',
                'syarat_11.mimes' => 'Format File Bukti bebas pinjaman perpustakaan harus PDF',
                'syarat_12.mimes' => 'Format File Draft skripsi Harus PDF',
                'syarat_13.mimes' => 'Format File Transkrip Nilai Harus PDF',
                'syarat_1.max' => 'File Bukti pembayaran kolokium skripsi tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'File Sertifikat TOEFL tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'File Formulir nilai bimbingan skripsi tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'File Formulir kemajuan bimbingan skripsi tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'File Formulir persetujuan kolokium skripsi tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'File Formulir kesediaan menghadiri kolokium skripsi tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'File Pas foto ukuran 4 x 6 sebanyak 2 lembar tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'File Kartu Tanda Mahasiswa tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'File Bukti pembayaran kuliah tidak boleh lebih dari 1MB',
                'syarat_10.max' => 'File Bukti perwalian tidak boleh lebih dari 1MB',
                'syarat_11.max' => 'File Bukti bebas pinjaman perpustakaan tidak boleh lebih dari 1MB',
                'syarat_12.max' => 'File Draft skripsi (PDF) tidak boleh lebih dari 10MB',
                'syarat_13.max' => 'File Transkrip Nilai tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $mhs = auth()->user();
            $daftarSeminar = new DaftarSeminar();

            $pathFolder = 'mahasiswa/seminar';

            for ($i = 1; $i <= 13; $i++) {
                $fieldName = 'syarat_' . $i;

                if ($request->hasFile($fieldName)) {
                    $file = $request->file($fieldName);
                    $fileName = Str::uuid() . '.' . $file->extension();

                    // simpan ke folder storage/app/public/mahasiswa/seminar
                    $filePath = $file->storeAs($pathFolder, $fileName, 'public');

                    // simpan path relative ke DB
                    $daftarSeminar->mahasiswa_id = $mhs->id;
                    $daftarSeminar->program_studi_id = $mhs->program_studi;
                    $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
                    $daftarSeminar->semester_id = $request['semester_id'];
                    $daftarSeminar->dosen1_id = $request['dosen1_id'];
                    $daftarSeminar->dosen2_id = $request['dosen2_id'];
                    $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
                    $daftarSeminar->{$fieldName} = $filePath;
                    $daftarSeminar->save();

                } else {
                    $daftarSeminar->{$fieldName} = null; // atau bisa diisi dengan nilai default jika diperlukan
                }
            }

            return redirect()->route('seminar_tmb.index')->with('success', 'Sukses mengajukan pendaftaran kolokium skripsi!');
        }
    }

    public function showTmb($id)
    {
        $data = DaftarSeminar::find($id);
        // dd($data);
        return view('daftar_seminar.tmb.show', compact('data'));
    }

    public function editTmb($id)
    {
        $data = DaftarSeminar::find($id);
        $title = "Pengajuan Kolokium Skripsi";
        Session::put('page', 'indexKolokium');
        $dosen1 = User::where([
            'level' => 2,
            'program_studi' => 'Teknik Pertambangan'
        ])->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        return view('daftar_seminar.tmb.edit', compact('data', 'title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function updateTmb(Request $request, $id)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'tahun_ajaran_id' => 'required',
                'dosen1_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'mimes:pdf|max:1024',
                'syarat_2' => 'mimes:pdf|max:1024',
                'syarat_3' => 'mimes:pdf|max:1024',
                'syarat_4' => 'mimes:pdf|max:1024',
                'syarat_5' => 'mimes:pdf|max:1024',
                'syarat_6' => 'mimes:pdf|max:1024',
                'syarat_7' => 'mimes:pdf|max:1024',
                'syarat_8' => 'mimes:pdf|max:1024',
                'syarat_9' => 'mimes:pdf|max:1024',
                'syarat_10' => 'mimes:pdf|max:1024',
                'syarat_11' => 'mimes:pdf|max:1024',
                'syarat_12' => 'mimes:pdf|max:10240',
                'syarat_13' => 'mimes:pdf|max:1024',
            ];

            $customMessage = [
                'syarat_1.mimes' => 'Format File Bukti pembayaran Kolokium Skripsi harus PDF',
                'syarat_2.mimes' => 'Format File Sertifikat TOEFL harus PDF',
                'syarat_3.mimes' => 'Format File Formulir nilai bimbingan skripsi harus PDF',
                'syarat_4.mimes' => 'Format File Formulir kemajuan bimbingan skripsi harus PDF',
                'syarat_5.mimes' => 'Format File Formulir persetujuan kolokium skripsi harus PDF',
                'syarat_6.mimes' => 'Format File Formulir kesediaan menghadiri kolokium skripsi harus PDF',
                'syarat_7.mimes' => 'Format File Pas foto ukuran 4 x 6 sebanyak 2 lembar harus PDF',
                'syarat_8.mimes' => 'Format File Kartu Tanda Mahasiswa harus PDF',
                'syarat_9.mimes' => 'Format File Bukti pembayaran kuliah harus PDF',
                'syarat_10.mimes' => 'Format File Bukti perwalian harus PDF',
                'syarat_11.mimes' => 'Format File Bukti bebas pinjaman perpustakaan harus PDF',
                'syarat_12.mimes' => 'Format File Draft skripsi Harus PDF',
                'syarat_13.mimes' => 'Format File Transkrip Nilai Harus PDF',
                'syarat_1.max' => 'Bukti pembayaran kolokium skripsi tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'Sertifikat TOEFL tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'Formulir nilai bimbingan skripsi tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'Formulir kemajuan bimbingan skripsi tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'Formulir persetujuan kolokium skripsi tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'Formulir kesediaan menghadiri kolokium skripsi tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'Pas foto ukuran 4 x 6 sebanyak 2 lembar tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'Kartu Tanda Mahasiswa tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'Bukti pembayaran kuliah tidak boleh lebih dari 1MB',
                'syarat_10.max' => 'Bukti perwalian tidak boleh lebih dari 1MB',
                'syarat_11.max' => 'Bukti bebas pinjaman perpustakaan tidak boleh lebih dari 1MB',
                'syarat_12.max' => 'Draft skripsi (PDF) tidak boleh lebih dari 10MB',
                'syarat_13.max' => 'Transkrip Nilai tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSeminar = DaftarSeminar::find($id);

            $folderPath = 'mahasiswa/seminar';
            
            for ($i = 1; $i <= 13; $i++) {
                $fieldFile = 'syarat_' . $i;
                $fieldStatus = 'status_' . $i;

                if ($request->hasFile($fieldFile)) {
                    $file = $request->file($fieldFile);

                    // hapus file lama jika ada
                    if (!empty($daftarSeminar->$fieldFile) && Storage::disk('public')->exists($daftarSeminar->$fieldFile)) {
                        Storage::disk('public')->delete($daftarSeminar->$fieldFile);
                    }

                    // generate file name baru
                    $fileName = Str::uuid() . '.' . $file->extension();

                    // simpan file baru
                    $filePath = $file->storeAs($folderPath, $fileName, 'public');

                    // update path file di database
                    $daftarSeminar->$fieldFile = $filePath;
                    $daftarSeminar->$fieldStatus = 0; // reset status approval jika file diupdate
                    
                }
            }

            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            $daftarSeminar->status = 0;           

            $daftarSeminar->save();

            return redirect()->route('seminar_tmb.index')->with('success', 'Sukses mengajukan pendaftaran kolokium skripsi!');
        }
    }

    public function indexTi()
    {
        $dataMhs = auth()->user();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLog = DaftarSeminar::where('mahasiswa_id', auth()->user()->id)->first();
        Session::put('page', 'seminarTA');
        return view('daftar_seminar.ti.index', compact('dataSeminar', 'dataLog'));
    }

    public function daftarTi()
    {
        $title = "Pengajuan Seminar Tugas Akhir";
        Session::put('page', 'seminarTA');
        $dosen1 = User::where('level', 2)->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        $dataLog = DaftarSeminar::where('mahasiswa_id', auth()->user()->id)->first();

        return view('daftar_seminar.ti.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2', 'dataLog'));
    }

    public function storeTi(Request $request)
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
                'syarat_6' => 'required|mimes:pdf|max:1024',
                'syarat_7' => 'required|mimes:pdf|max:1024',
                'syarat_8' => 'required|mimes:pdf|max:1024',
                'syarat_9' => 'required|mimes:pdf|max:10240',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Formulir pendaftaran Seminar terisi Harus Diisi',
                'syarat_2.required' => 'Copy Berita Acara Pembimbingan / Kartu Bimbingan Harus Diisi',
                'syarat_3.required' => 'Persetujuan Seminar dari Dosen Pembimbing Harus Diisi',
                'syarat_4.required' => 'Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir Harus Diisi',
                'syarat_5.required' => 'Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP Harus Diisi',
                'syarat_6.required' => 'Form Bebas Tunggakan / Pinjaman Harus Diisi',
                'syarat_7.required' => 'Print out bukti pengecekan Plagiarisme <= 25% Harus Diisi',
                'syarat_8.required' => 'Bukti Monitoring Hafalan Harus Diisi',
                'syarat_9.required' => 'Bukti Softcopy Draft Tugas Akhir Harus Diisi',
                'syarat_1.mimes' => 'Format File Formulir pendaftaran Seminar terisi Harus PDF',
                'syarat_2.mimes' => 'Format File Copy Berita Acara Pembimbingan / Kartu Bimbingan Harus PDF',
                'syarat_3.mimes' => 'Format File Persetujuan Seminar dari Dosen Pembimbing Harus PDF',
                'syarat_4.mimes' => 'Format File Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir Harus PDF',
                'syarat_5.mimes' => 'Format File Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP Harus PDF',
                'syarat_6.mimes' => 'Format File Form Bebas Tunggakan / Pinjaman Harus PDF',
                'syarat_7.mimes' => 'Format File Print out bukti pengecekan Plagiarisme <= 25% Harus PDF',
                'syarat_8.mimes' => 'Format File Bukti Monitoring Hafalan Harus PDF',
                'syarat_9.mimes' => 'Format File Bukti Softcopy Draft Tugas Akhir Harus PDF',
                'syarat_1.max' => 'File Formulir pendaftaran Seminar terisi tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'File Copy Berita Acara Pembimbingan / Kartu Bimbingan tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'File Persetujuan Seminar dari Dosen Pembimbing tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'File Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'File Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'File Form Bebas Tunggakan / Pinjaman tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'File Print out bukti pengecekan Plagiarisme <= 25% tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'File Bukti Monitoring Hafalan tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'File Bukti Softcopy Draft tidak boleh lebih dari 10MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSeminar = new DaftarSeminar();

            $pathFolder = 'mahasiswa/seminar';


            for ($i = 1; $i <= 9; $i++) {
                $fieldName = 'syarat_' . $i;

                if ($request->hasFile($fieldName)) {
                    $file = $request->file($fieldName);
                    $fileName = Str::uuid() . '.' . $file->extension();

                    $filePath = $file->storeAs($pathFolder, $fileName, 'public');

                    $daftarSeminar->mahasiswa_id = auth()->user()->id;
                    $daftarSeminar->program_studi_id = auth()->user()->program_studi;
                    $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
                    $daftarSeminar->semester_id = $request['semester_id'];
                    $daftarSeminar->dosen1_id = $request['dosen1_id'];
                    $daftarSeminar->dosen2_id = $request['dosen2_id'];
                    $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
                    $daftarSeminar->{$fieldName} = $filePath;
                    $daftarSeminar->save();
                } else {
                    $daftarSeminar->{$fieldName} = null; // atau bisa diisi dengan nilai default jika diperlukan
                }
            }

            return redirect()->route('seminar_ti.index')->with('success', 'Sukses mengajukan pendaftaran seminar tugas akhir!');
        }
    }

    public function showTi($id)
    {
        $data = DaftarSeminar::find($id);
        return view('daftar_seminar.ti.show', compact('data'));
    }

    public function editTi($id)
    {
        $data = DaftarSeminar::find($id);
        $title = "Pengajuan Seminar Tugas Akhir";
        Session::put('page', 'seminarTA');
        $dosen1 = User::where('level', 2)->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        return view('daftar_seminar.ti.edit', compact('data', 'title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function updateTi(Request $request, $id)
    {
        if ($request->isMethod('POST')) {

            $rules = [
                'tahun_ajaran_id' => 'required',
                'semester_id' => 'required',
                'dosen1_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'mimes:pdf|max:1024',
                'syarat_2' => 'mimes:pdf|max:1024',
                'syarat_3' => 'mimes:pdf|max:1024',
                'syarat_4' => 'mimes:pdf|max:1024',
                'syarat_5' => 'mimes:pdf|max:1024',
                'syarat_6' => 'mimes:pdf|max:1024',
                'syarat_7' => 'mimes:pdf|max:1024',
                'syarat_8' => 'mimes:pdf|max:1024',
                'syarat_9' => 'mimes:pdf|max:10240',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.mimes' => 'Format File Formulir pendaftaran Seminar terisi Harus PDF',
                'syarat_2.mimes' => 'Format File Copy Berita Acara Pembimbingan / Kartu Bimbingan Harus PDF',
                'syarat_3.mimes' => 'Format File Persetujuan Seminar dari Dosen Pembimbing Harus PDF',
                'syarat_4.mimes' => 'Format File Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir Harus PDF',
                'syarat_5.mimes' => 'Format File Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP Harus PDF',
                'syarat_6.mimes' => 'Format File Form Bebas Tunggakan / Pinjaman Harus PDF',
                'syarat_7.mimes' => 'Format File Print out bukti pengecekan Plagiarisme <= 25% Harus PDF',
                'syarat_8.mimes' => 'Format File Bukti Monitoring Hafalan Harus PDF',
                'syarat_9.mimes' => 'Format File Softcopy Draft Tugas Akhir (Bab 1-3) sebanyak 4 eksemplar Harus PDF',
                'syarat_1.max' => 'File Formulir pendaftaran Seminar terisi tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'File Copy Berita Acara Pembimbingan / Kartu Bimbingan tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'File Persetujuan Seminar dari Dosen Pembimbing tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'File Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'File Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'File Form Bebas Tunggakan / Pinjaman tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'File Print out bukti pengecekan Plagiarisme <= 25% tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'File Bukti Monitoring Hafalan tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'File Softcopy Draft Tugas Akhir (Bab 1-3) sebanyak 4 eksemplar tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            
            $daftarSeminar = DaftarSeminar::find($id);
            $folderPath = 'mahasiswa/seminar';

            for ($i = 1; $i <= 9; $i++) {
                $fieldFile = 'syarat_' . $i;
                $fieldStatus = 'status_' . $i;

                if ($request->hasFile($fieldFile)) {
                    $file = $request->file($fieldFile);

                    // hapus file lama jika ada
                    if (!empty($daftarSeminar->$fieldFile) && Storage::disk('public')->exists($daftarSeminar->$fieldFile)) {
                        Storage::disk('public')->delete($daftarSeminar->$fieldFile);
                    }

                    // generate file name baru
                    $fileName = Str::uuid() . '.' . $file->extension();

                    // simpan file baru
                    $filePath = $file->storeAs($folderPath, $fileName, 'public');

                    // update path file di database
                    $daftarSeminar->$fieldFile = $filePath;
                    $daftarSeminar->$fieldStatus = 0; // reset status approval jika file diupdate
                    
                }
            }

            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            $daftarSeminar->status = 0;
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            $daftarSeminar->save();

            return redirect()->route('seminar_ti.index')->with('success', 'Sukses mengajukan pendaftaran seminar tugas akhir!');
        }
    }

    public function indexPwk()
    {
        $dataMhs = auth()->user();
        $dataSeminar = DaftarSeminar::where('mahasiswa_id', $dataMhs->id)->get();
        $dataLog = DaftarSeminar::where('mahasiswa_id', auth()->user()->id)->first();
        Session::put('page', 'SP');
        return view('daftar_seminar.pwk.index', compact('dataSeminar', 'dataLog'));
    }

    public function daftarPwk()
    {
        $title = "Pengajuan Seminar Tugas Akhir";
        Session::put('page', 'SP');
        $dosen1 = User::where('level', 2)->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        $dataLog = DaftarSeminar::where('mahasiswa_id', auth()->user()->id)->first();

        return view('daftar_seminar.pwk.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2', 'dataLog'));
    }

    public function storePwk(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'tahun_ajaran_id' => 'required',
                'dosen1_id' => 'required',
                'judul_skripsi' => 'required',
                // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                'syarat_1' => 'required|mimes:pdf|max:1024',
                'syarat_2' => 'required|mimes:pdf|max:1024',
                'syarat_3' => 'mimes:pdf|max:1024',
                'syarat_4' => 'required|mimes:pdf|max:1024',
                'syarat_5' => 'mimes:pdf|max:1024',
                'syarat_6' => 'required|mimes:pdf|max:1024',
                'syarat_7' => 'mimes:pdf|max:1024',
                'syarat_8' => 'required|mimes:pdf|max:1024',
                'syarat_9' => 'required|mimes:pdf|max:1024',
                'syarat_10' => 'required|mimes:pdf|max:1024',
            ];

            $customMessage = [
                'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                'syarat_1.required' => 'Lembar bimbingan skripsi Harus Diisi',
                'syarat_2.required' => 'Sertifikat pesantren mahasiswa baru Harus Diisi',
                'syarat_4.required' => 'Transkrip nilai Harus Diisi',
                'syarat_6.required' => 'Bukti bebas pinjaman perpustakaan Harus Diisi',
                'syarat_8.required' => 'Bukti KRS (pengambilan MK. Skripsi) Harus Diisi',
                'syarat_9.required' => 'Bukti pembayaran DPP Mk. Skripsi Harus Diisi',
                'syarat_10.required' => 'Bukti pembayaran sidang pembahasan Harus Diisi',
                'syarat_1.mimes' => 'Format File Lembar bimbingan skripsi Harus PDF',
                'syarat_2.mimes' => 'Format File Sertifikat pesantren mahasiswa baru Harus PDF',
                'syarat_3.mimes' => 'Format File Sertifikat pesantren calon sarjana Harus PDF',
                'syarat_4.mimes' => 'Format File Transkrip nilai Harus PDF',
                'syarat_5.mimes' => 'Format File Sertifikat TOEFL Harus PDF',
                'syarat_6.mimes' => 'Format File Bukti bebas pinjaman perpustakaan Harus PDF',
                'syarat_7.mimes' => 'Format File Sertifikat SKKFT Harus PDF',
                'syarat_8.mimes' => 'Format File Bukti KRS (pengambilan MK. Skripsi) Harus PDF',
                'syarat_9.mimes' => 'Format File Bukti pembayaran DPP Mk. Skripsi Harus PDF',
                'syarat_10.mimes' => 'Format File Bukti pembayaran sidang pembahasan Harus PDF',
                'syarat_1.max' => 'Format File Lembar bimbingan skripsi tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'Format File Sertifikat pesantren mahasiswa baru tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'Format File Sertifikat pesantren calon sarjana tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'Format File Transkrip nilai tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'Format File Sertifikat TOEFL tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'Format File Bukti bebas pinjaman perpustakaan tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'Format File Sertifikat SKKFT tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'Format File Bukti KRS (pengambilan MK. Skripsi) tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'Format File Bukti pembayaran DPP Mk. Skripsi tidak boleh lebih dari 1MB',
                'syarat_10.max' => 'Format File Bukti pembayaran sidang pembahasan tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSeminar = new DaftarSeminar();
            $pathFolder = 'mahasiswa/seminar';

            for ($i = 1; $i <= 10; $i++) {
                $fieldName = 'syarat_' . $i;

                if ($request->hasFile($fieldName) && !is_null($request->file($fieldName))) {
                    $file = $request->file($fieldName);
                    $fileName = Str::uuid() . '.' . $file->extension();

                    $filePath = $file->storeAs($pathFolder, $fileName, 'public');

                    $daftarSeminar->mahasiswa_id = auth()->user()->id;
                    $daftarSeminar->program_studi_id = auth()->user()->program_studi;
                    $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
                    $daftarSeminar->semester_id = $request['semester_id'];
                    $daftarSeminar->dosen1_id = $request['dosen1_id'];
                    $daftarSeminar->dosen2_id = $request['dosen2_id'];
                    $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
                    $daftarSeminar->{$fieldName} = $filePath;
                    $daftarSeminar->save();
                } else {
                    $daftarSeminar->{$fieldName} = null; // atau bisa diisi dengan nilai default jika diperlukan
                }
            }

            return redirect()->route('seminar_pwk.index')->with('success', 'Sukses mengajukan pendaftaran sidang pembahasan!');
        }
    }

    public function showPwk($id)
    {
        $data = DaftarSeminar::find($id);
        return view('daftar_seminar.pwk.show', compact('data'));
    }

    public function editPwk($id)
    {
        $data = DaftarSeminar::find($id);
        $title = "Pengajuan Sidang Pembahasan";
        Session::put('page', 'SP');
        $dosen1 = User::where('level', 2)->get();
        $dosen2 = User::where('level', 2)->get();
        $tahun_ajaran = TahunAjaran::get();
        $semester = Semester::get();
        return view('daftar_seminar.pwk.edit', compact('data', 'title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
    }

    public function updatePwk(Request $request, $id)
    {
        
        if ($request->isMethod('POST')) {

            $daftarSeminar = DaftarSeminar::find($id);
            $pathFolder = 'mahasiswa/seminar';

            for ($i = 1; $i <= 10; $i++) {
                $fieldFile = 'syarat_' . $i;
                $fieldStatus = 'status_' . $i;

                if ($request->hasFile($fieldFile) && !is_null($request->file($fieldFile))) {
                    $file = $request->file($fieldFile);

                    // hapus file lama jika ada
                    if (!empty($daftarSeminar->$fieldFile) && Storage::disk('public')->exists($daftarSeminar->$fieldFile)) {
                        Storage::disk('public')->delete($daftarSeminar->$fieldFile);
                    }

                    // generate file name baru
                    $fileName = Str::uuid() . '.' . $file->extension();

                    // simpan file baru
                    $filePath = $file->storeAs($pathFolder, $fileName, 'public');

                    // update path file di database
                    $daftarSeminar->$fieldFile = $filePath;
                    $daftarSeminar->$fieldStatus = 0; // reset status approval jika file diupdate
                    
                }
            }

            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            $daftarSeminar->status = 0;
            $daftarSeminar->save();
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            return redirect()->route('seminar_pwk.index')->with('success', 'Sukses mengajukan pendaftaran sidang pembahasan!');
        }
    }
}
