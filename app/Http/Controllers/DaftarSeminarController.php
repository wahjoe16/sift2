<?php

namespace App\Http\Controllers;

use App\Models\DaftarSeminar;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

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
                'syarat_13' => 'required|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:10240',
                'syarat_14' => 'required|mimes:pdf|max:1024',
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
                'syarat_13.required' => 'Draft skripsi (DOCX) Harus Diisi',
                'syarat_14.required' => 'Transkrip Nilai Harus Diisi',
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
                'syarat_13.mimetypes' => 'Format File Draft skripsi Harus DOC / DOCX',
                'syarat_14.mimes' => 'Format File Transkrip Nilai Harus PDF',
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
                'syarat_13.max' => 'File Draft skripsi (DOCX) tidak boleh lebih dari 10MB',
                'syarat_14.max' => 'File Transkrip Nilai tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $mhs = auth()->user();
            $npm = $mhs->nik;
            $daftarSeminar = new DaftarSeminar();

            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // for ($i = 1; $i <= 14; $i++) {
            //     if ($request->hasFile('syarat_' . $i)) {
            //         $daftarSeminar->addMediaFromRequest('syarat_' . $i)
            //             ->usingName($npm . '_syarat_' . $i)
            //             ->usingFilename($npm . '_' . $request->file('syarat_' . $i)->getClientOriginalName())
            //             ->toMediaCollection('syarat_' . $i);
            //     }
            // }

            $files = [];
            for ($i = 1; $i <= 14; $i++) {
                if ($request->file('syarat_' . $i)) {
                    $files[] = $request->file('syarat_' . $i);
                }
            }

            foreach ($files as $file) {
                $path = 'mahasiswa/seminar';
                $nama = $npm . "_" . time() . "_" . $file->getClientOriginalName();
                $file->move($path, $nama);
                $dataFile[] = $nama;
            }

            $daftarSeminar->mahasiswa_id = $mhs->id;
            $daftarSeminar->program_studi_id = $mhs->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            // for ($i = 1; $i <= 14; $i++) {
            //     for ($j = 0; $j <= $i; $j++) {
            //         $daftarSeminar->syarat_ . $i = $dataFile[$j];
            //     }
            // }
            $daftarSeminar->syarat_1 = $dataFile[0];
            $daftarSeminar->syarat_2 = $dataFile[1];
            $daftarSeminar->syarat_3 = $dataFile[2];
            $daftarSeminar->syarat_4 = $dataFile[3];
            $daftarSeminar->syarat_5 = $dataFile[4];
            $daftarSeminar->syarat_6 = $dataFile[5];
            $daftarSeminar->syarat_7 = $dataFile[6];
            $daftarSeminar->syarat_8 = $dataFile[7];
            $daftarSeminar->syarat_9 = $dataFile[8];
            $daftarSeminar->syarat_10 = $dataFile[9];
            $daftarSeminar->syarat_11 = $dataFile[10];
            $daftarSeminar->syarat_12 = $dataFile[11];
            $daftarSeminar->syarat_13 = $dataFile[12];
            $daftarSeminar->syarat_14 = $dataFile[13];

            $daftarSeminar->save();

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
                'syarat_13' => 'mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:10240',
                'syarat_14' => 'mimes:pdf|max:1024',
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
                'syarat_13.mimetypes' => 'Format File Draft skripsi Harus DOC / DOCX',
                'syarat_14.mimes' => 'Format File Transkrip Nilai Harus PDF',
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
                'syarat_13.max' => 'Draft skripsi (DOCX) tidak boleh lebih dari 10MB',
                'syarat_14.max' => 'Transkrip Nilai tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $daftarSeminar = DaftarSeminar::find($id);
            $mhs = auth()->user();
            $npm = $mhs->nik;

            // $files = [];
            // for ($i = 1; $i <= 14; $i++) {
            //     if ($request->file('syarat_' . $i)) {
            //         $files[] = $request->file('syarat_' . $i);
            //     }
            // }

            // foreach ($files as $file) {
            //     $path = 'mahasiswa/seminar';
            //     $nama = $npm . '_' . $file->getClientOriginalName();
            //     File::delete('mahasiswa/seminar' . $daftarSeminar->syarat_ . $i);
            //     $file->move($path, $nama);
            //     $dataFile[] = $nama;
            //     $daftarSeminar->status_ . $i = 0;
            // }

            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            $daftarSeminar->status = 0;
            // $daftarSeminar->syarat_1 = $dataFile[0];
            // $daftarSeminar->syarat_2 = $dataFile[1];
            // $daftarSeminar->syarat_3 = $dataFile[2];
            // $daftarSeminar->syarat_4 = $dataFile[3];
            // $daftarSeminar->syarat_5 = $dataFile[4];
            // $daftarSeminar->syarat_6 = $dataFile[5];
            // $daftarSeminar->syarat_7 = $dataFile[6];
            // $daftarSeminar->syarat_8 = $dataFile[7];
            // $daftarSeminar->syarat_9 = $dataFile[8];
            // $daftarSeminar->syarat_10 = $dataFile[9];
            // $daftarSeminar->syarat_11 = $dataFile[10];
            // $daftarSeminar->syarat_12 = $dataFile[11];
            // $daftarSeminar->syarat_13 = $dataFile[12];
            // $daftarSeminar->syarat_14 = $dataFile[13];
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $data_1 = $request->file('syarat_1');
            if (!is_null($data_1)) {
                $nama_syarat_1 = $npm . "_" . time() . "_" . $data_1->getClientOriginalName();
                $syarat_1_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_1);
                $data_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSeminar->syarat_1 = $nama_syarat_1;
                $daftarSeminar->status_1 = 0;
            }


            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
                $syarat_2_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_2);
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSeminar->syarat_2 = $nama_syarat_2;
                $daftarSeminar->status_2 = 0;
            }


            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
                $syarat_3_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_3);
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSeminar->syarat_3 = $nama_syarat_3;
                $daftarSeminar->status_3 = 0;
            }


            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
                $syarat_4_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_4);
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSeminar->syarat_4 = $nama_syarat_4;
                $daftarSeminar->status_4 = 0;
            }


            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
                $syarat_5_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_5);
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSeminar->syarat_5 = $nama_syarat_5;
                $daftarSeminar->status_5 = 0;
            }


            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $nama_syarat_6 = $npm . "_" . time() . "_" . $syarat_6->getClientOriginalName();
                $syarat_6_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_6);
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSeminar->syarat_6 = $nama_syarat_6;
                $daftarSeminar->status_6 = 0;
            }


            // upload syarat 
            $syarat_7 = $request->file('syarat_7');
            if (!is_null($syarat_7)) {
                $nama_syarat_7 = $npm . "_" . time() . "_" . $syarat_7->getClientOriginalName();
                $syarat_7_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_7);
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSeminar->syarat_7 = $nama_syarat_7;
                $daftarSeminar->status_7 = 0;
            }


            // upload syarat 
            $syarat_8 = $request->file('syarat_8');
            if (!is_null($syarat_8)) {
                $nama_syarat_8 = $npm . "_" . time() . "_" . $syarat_8->getClientOriginalName();
                $syarat_8_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_8);
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSeminar->syarat_8 = $nama_syarat_8;
                $daftarSeminar->status_8 = 0;
            }


            // upload syarat 
            $syarat_9 = $request->file('syarat_9');
            if (!is_null($syarat_9)) {
                $nama_syarat_9 = $npm . "_" . time() . "_" . $syarat_9->getClientOriginalName();
                $syarat_9_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_9);
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSeminar->syarat_9 = $nama_syarat_9;
                $daftarSeminar->status_9 = 0;
            }


            // upload syarat 
            $syarat_10 = $request->file('syarat_10');
            if (!is_null($syarat_10)) {
                $nama_syarat_10 = $npm . "_" . time() . "_" . $syarat_10->getClientOriginalName();
                $syarat_10_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_10);
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSeminar->syarat_10 = $nama_syarat_10;
                $daftarSeminar->status_10 = 0;
            }


            // upload syarat 
            $syarat_11 = $request->file('syarat_11');
            if (!is_null($syarat_11)) {
                $nama_syarat_11 = $npm . "_" . time() . "_" . $syarat_11->getClientOriginalName();
                $syarat_11_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_11);
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $daftarSeminar->syarat_11 = $nama_syarat_11;
                $daftarSeminar->status_11 = 0;
            }


            // upload syarat 
            $syarat_12 = $request->file('syarat_12');
            if (!is_null($syarat_12)) {
                $nama_syarat_12 = $npm . "_" . time() . "_" . $syarat_12->getClientOriginalName();
                $syarat_12_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_12);
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $daftarSeminar->syarat_12 = $nama_syarat_12;
                $daftarSeminar->status_12 = 0;
            }


            // upload syarat 
            $syarat_13 = $request->file('syarat_13');
            if (!is_null($syarat_13)) {
                $nama_syarat_13 = $npm . "_" . time() . "_" . $syarat_13->getClientOriginalName();
                $syarat_13_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_13);
                $syarat_13->move($syarat_13_path, $nama_syarat_13);
                $daftarSeminar->syarat_13 = $nama_syarat_13;
                $daftarSeminar->status_13 = 0;
            }


            // upload syarat 
            $syarat_14 = $request->file('syarat_14');
            if (!is_null($syarat_14)) {
                $nama_syarat_14 = $npm . "_" . time() . "_" . $syarat_14->getClientOriginalName();
                $syarat_14_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_14);
                $syarat_14->move($syarat_14_path, $nama_syarat_14);
                $daftarSeminar->syarat_14 = $nama_syarat_14;
                $daftarSeminar->status_14 = 0;
            }

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
                'syarat_9' => 'required|mimes:pdf|max:1024',
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
                'syarat_9.required' => 'Bukti penyerahan Draft Tugas Akhir (Bab 1-3) sebanyak 4 eksemplar Harus Diisi',
                'syarat_1.mimes' => 'Format File Formulir pendaftaran Seminar terisi Harus PDF',
                'syarat_2.mimes' => 'Format File Copy Berita Acara Pembimbingan / Kartu Bimbingan Harus PDF',
                'syarat_3.mimes' => 'Format File Persetujuan Seminar dari Dosen Pembimbing Harus PDF',
                'syarat_4.mimes' => 'Format File Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir Harus PDF',
                'syarat_5.mimes' => 'Format File Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP Harus PDF',
                'syarat_6.mimes' => 'Format File Form Bebas Tunggakan / Pinjaman Harus PDF',
                'syarat_7.mimes' => 'Format File Print out bukti pengecekan Plagiarisme <= 25% Harus PDF',
                'syarat_8.mimes' => 'Format File Bukti Monitoring Hafalan Harus PDF',
                'syarat_9.mimes' => 'Format File Bukti penyerahan Draft Tugas Akhir (Bab 1-3) sebanyak 4 eksemplar Harus PDF',
                'syarat_1.max' => 'File Formulir pendaftaran Seminar terisi tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'File Copy Berita Acara Pembimbingan / Kartu Bimbingan tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'File Persetujuan Seminar dari Dosen Pembimbing tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'File Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'File Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'File Form Bebas Tunggakan / Pinjaman tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'File Print out bukti pengecekan Plagiarisme <= 25% tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'File Bukti Monitoring Hafalan tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'File Bukti penyerahan Draft Tugas Akhir (Bab 1-3) sebanyak 4 eksemplar tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $mhs = auth()->user();
            $npm = $mhs->nik;
            $daftarSeminar = new DaftarSeminar();

            $files = [];
            for ($i = 1; $i <= 9; $i++) {
                if ($request->file('syarat_' . $i)) {
                    $files[] = $request->file('syarat_' . $i);
                }
            }

            foreach ($files as $file) {
                $path = 'mahasiswa/seminar';
                $nama = $npm . '_' . time() . '_' . $file->getClientOriginalName();
                $file->move($path, $nama);
                $dataFile[] = $nama;
            }

            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));
            $daftarSeminar->syarat_1 = $dataFile[0];
            $daftarSeminar->syarat_2 = $dataFile[1];
            $daftarSeminar->syarat_3 = $dataFile[2];
            $daftarSeminar->syarat_4 = $dataFile[3];
            $daftarSeminar->syarat_5 = $dataFile[4];
            $daftarSeminar->syarat_6 = $dataFile[5];
            $daftarSeminar->syarat_7 = $dataFile[6];
            $daftarSeminar->syarat_8 = $dataFile[7];
            $daftarSeminar->syarat_9 = $dataFile[8];

            $daftarSeminar->save();

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
                'syarat_9' => 'mimes:pdf|max:1024',
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
                'syarat_9.mimes' => 'Format File Bukti penyerahan Draft Tugas Akhir (Bab 1-3) sebanyak 4 eksemplar Harus PDF',
                'syarat_1.max' => 'File Formulir pendaftaran Seminar terisi tidak boleh lebih dari 1MB',
                'syarat_2.max' => 'File Copy Berita Acara Pembimbingan / Kartu Bimbingan tidak boleh lebih dari 1MB',
                'syarat_3.max' => 'File Persetujuan Seminar dari Dosen Pembimbing tidak boleh lebih dari 1MB',
                'syarat_4.max' => 'File Fotocopy Kwitansi Pembayaran Seminar dan Bimbingan Tugas Akhir tidak boleh lebih dari 1MB',
                'syarat_5.max' => 'File Transkrip Nilai terakhir yang sudah lulus MK Semester 1-6 dan KP tidak boleh lebih dari 1MB',
                'syarat_6.max' => 'File Form Bebas Tunggakan / Pinjaman tidak boleh lebih dari 1MB',
                'syarat_7.max' => 'File Print out bukti pengecekan Plagiarisme <= 25% tidak boleh lebih dari 1MB',
                'syarat_8.max' => 'File Bukti Monitoring Hafalan tidak boleh lebih dari 1MB',
                'syarat_9.max' => 'File Bukti penyerahan Draft Tugas Akhir (Bab 1-3) sebanyak 4 eksemplar tidak boleh lebih dari 1MB',
            ];

            $this->validate($request, $rules, $customMessage);

            $mhs = auth()->user();
            $npm = $mhs->nik;
            $daftarSeminar = DaftarSeminar::find($id);
            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            $daftarSeminar->status = 0;
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            if (!is_null($syarat_1)) {
                $nama_syarat_1 = $npm . "_" . time() . "_" . $syarat_1->getClientOriginalName();
                $syarat_1_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_1);
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSeminar->syarat_1 = $nama_syarat_1;
                $daftarSeminar->status_1 = 0;
            }

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
                $syarat_2_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_2);
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSeminar->syarat_2 = $nama_syarat_2;
                $daftarSeminar->status_2 = 0;
            }

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
                $syarat_3_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_3);
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSeminar->syarat_3 = $nama_syarat_3;
                $daftarSeminar->status_3 = 0;
            }

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
                $syarat_4_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_4);
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSeminar->syarat_4 = $nama_syarat_4;
                $daftarSeminar->status_4 = 0;
            }

            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
                $syarat_5_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_5);
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSeminar->syarat_5 = $nama_syarat_5;
                $daftarSeminar->status_5 = 0;
            }

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $nama_syarat_6 = $npm . "_" . time() . "_" . $syarat_6->getClientOriginalName();
                $syarat_6_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_6);
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSeminar->syarat_6 = $nama_syarat_6;
                $daftarSeminar->status_6 = 0;
            }

            // upload syarat 
            $syarat_7 = $request->file('syarat_7');
            if (!is_null($syarat_7)) {
                $nama_syarat_7 = $npm . "_" . time() . "_" . $syarat_7->getClientOriginalName();
                $syarat_7_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_7);
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSeminar->syarat_7 = $nama_syarat_7;
                $daftarSeminar->status_7 = 0;
            }

            // upload syarat 
            $syarat_8 = $request->file('syarat_8');
            if (!is_null($syarat_8)) {
                $nama_syarat_8 = $npm . "_" . time() . "_" . $syarat_8->getClientOriginalName();
                $syarat_8_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_8);
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSeminar->syarat_8 = $nama_syarat_8;
                $daftarSeminar->status_8 = 0;
            }

            // upload syarat 
            $syarat_9 = $request->file('syarat_9');
            if (!is_null($syarat_9)) {
                $nama_syarat_9 = $npm . "_" . time() . "_" . $syarat_9->getClientOriginalName();
                $syarat_9_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_9);
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSeminar->syarat_9 = $nama_syarat_9;
                $daftarSeminar->status_9 = 0;
            }

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

        return view('daftar_seminar.pwk.create', compact('title', 'semester', 'tahun_ajaran', 'dosen1', 'dosen2'));
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

            $mhs = auth()->user();
            $npm = $mhs->nik;
            $daftarSeminar = new DaftarSeminar();

            // $files = [];
            // for ($i = 1; $i <= 10; $i++) {
            //     if ($request->file('syarat_' . $i)) {
            //         $files[] = $request->file('syarat_' . $i);
            //     }
            // }

            // foreach ($files as $file) {
            //     $path = 'mahasiswa/seminar';
            //     $nama = $npm . "_" . time() . "_" . $file->getClientOriginalName();
            //     $file->move($path, $nama);
            //     $dataFile[] = $nama;
            // }

            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));


            // $daftarSeminar->syarat_1 = $dataFile[0];
            // $daftarSeminar->syarat_2 = $dataFile[1];

            // if ($request->get('syarat_3') != null) {
            //     $daftarSeminar->syarat_3 = $dataFile[2];
            // }else {
            //     $daftarSeminar->syarat_3 = null;
            // }
                        
            // $daftarSeminar->syarat_4 = $dataFile[3];
           
            // if ($request->get('syarat_5') != null) {
            //     $daftarSeminar->syarat_5 = $dataFile[4];
            // }else {
            //     $daftarSeminar->syarat_5 = null;
            // }

            // $daftarSeminar->syarat_6 = $dataFile[5];

            // if ($request->get('syarat_7') != null) {
            //     $daftarSeminar->syarat_7 = $dataFile[6];
            // }else {
            //     $daftarSeminar->syarat_7 = null;
            // }  
            
            // $daftarSeminar->syarat_8 = $dataFile[7];
            // $daftarSeminar->syarat_9 = $dataFile[8];
            // $daftarSeminar->syarat_10 = $dataFile[9];

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            if (!is_null($syarat_1)) {
                $nama_syarat_1 = $npm . "_" . time() . "_" . $syarat_1->getClientOriginalName();
                $syarat_1_path = 'mahasiswa/seminar';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSeminar->syarat_1 = $nama_syarat_1;
                $daftarSeminar->status_1 = 0;
            }

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
                $syarat_2_path = 'mahasiswa/seminar';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSeminar->syarat_2 = $nama_syarat_2;
                $daftarSeminar->status_2 = 0;
            }

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
                $syarat_3_path = 'mahasiswa/seminar';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSeminar->syarat_3 = $nama_syarat_3;
                $daftarSeminar->status_3 = 0;
            }

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
                $syarat_4_path = 'mahasiswa/seminar';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSeminar->syarat_4 = $nama_syarat_4;
                $daftarSeminar->status_4 = 0;
            }

            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
                $syarat_5_path = 'mahasiswa/seminar';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSeminar->syarat_5 = $nama_syarat_5;
                $daftarSeminar->status_5 = 0;
            }

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $nama_syarat_6 = $npm . "_" . time() . "_" . $syarat_6->getClientOriginalName();
                $syarat_6_path = 'mahasiswa/seminar';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSeminar->syarat_6 = $nama_syarat_6;
                $daftarSeminar->status_6 = 0;
            }

            // upload syarat 
            $syarat_7 = $request->file('syarat_7');
            if (!is_null($syarat_7)) {
                $nama_syarat_7 = $npm . "_" . time() . "_" . $syarat_7->getClientOriginalName();
                $syarat_7_path = 'mahasiswa/seminar';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSeminar->syarat_7 = $nama_syarat_7;
                $daftarSeminar->status_7 = 0;
            }

            // upload syarat 
            $syarat_8 = $request->file('syarat_8');
            if (!is_null($syarat_8)) {
                $nama_syarat_8 = $npm . "_" . time() . "_" . $syarat_8->getClientOriginalName();
                $syarat_8_path = 'mahasiswa/seminar';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSeminar->syarat_8 = $nama_syarat_8;
                $daftarSeminar->status_8 = 0;
            }

            // upload syarat 
            $syarat_9 = $request->file('syarat_9');
            if (!is_null($syarat_9)) {
                $nama_syarat_9 = $npm . "_" . time() . "_" . $syarat_9->getClientOriginalName();
                $syarat_9_path = 'mahasiswa/seminar';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSeminar->syarat_9 = $nama_syarat_9;
                $daftarSeminar->status_9 = 0;
            }

            // upload syarat 
            $syarat_10 = $request->file('syarat_10');
            if (!is_null($syarat_10)) {
                $nama_syarat_10 = $npm . "_" . time() . "_" . $syarat_10->getClientOriginalName();
                $syarat_10_path = 'mahasiswa/seminar';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSeminar->syarat_10 = $nama_syarat_10;
                $daftarSeminar->status_10 = 0;
            }

            $daftarSeminar->save();

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
        $mhs = auth()->user();
        $npm = $mhs->nik;

        if ($request->isMethod('POST')) {
            $daftarSeminar = DaftarSeminar::find($id);
            $daftarSeminar->mahasiswa_id = auth()->user()->id;
            $daftarSeminar->program_studi_id = auth()->user()->program_studi;
            $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
            $daftarSeminar->semester_id = $request['semester_id'];
            $daftarSeminar->dosen1_id = $request['dosen1_id'];
            $daftarSeminar->dosen2_id = $request['dosen2_id'];
            $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
            $daftarSeminar->status = 0;
            // $daftarSeminar->tanggal_pengajuan = date('Y-m-d', strtotime($request['tanggal_pengajuan']));

            // upload syarat 
            $syarat_1 = $request->file('syarat_1');
            if (!is_null($syarat_1)) {
                $nama_syarat_1 = $npm . "_" . time() . "_" . $syarat_1->getClientOriginalName();
                $syarat_1_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_1);
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSeminar->syarat_1 = $nama_syarat_1;
                $daftarSeminar->status_1 = 0;
            }

            // upload syarat 2
            $syarat_2 = $request->file('syarat_2');
            if (!is_null($syarat_2)) {
                $nama_syarat_2 = $npm . "_" . time() . "_" . $syarat_2->getClientOriginalName();
                $syarat_2_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_2);
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSeminar->syarat_2 = $nama_syarat_2;
                $daftarSeminar->status_2 = 0;
            }

            // upload syarat 3
            $syarat_3 = $request->file('syarat_3');
            if (!is_null($syarat_3)) {
                $nama_syarat_3 = $npm . "_" . time() . "_" . $syarat_3->getClientOriginalName();
                $syarat_3_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_3);
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSeminar->syarat_3 = $nama_syarat_3;
                $daftarSeminar->status_3 = 0;
            }

            // upload syarat 
            $syarat_4 = $request->file('syarat_4');
            if (!is_null($syarat_4)) {
                $nama_syarat_4 = $npm . "_" . time() . "_" . $syarat_4->getClientOriginalName();
                $syarat_4_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_4);
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSeminar->syarat_4 = $nama_syarat_4;
                $daftarSeminar->status_4 = 0;
            }

            // upload syarat 
            $syarat_5 = $request->file('syarat_5');
            if (!is_null($syarat_5)) {
                $nama_syarat_5 = $npm . "_" . time() . "_" . $syarat_5->getClientOriginalName();
                $syarat_5_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_5);
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSeminar->syarat_5 = $nama_syarat_5;
                $daftarSeminar->status_5 = 0;
            }

            // upload syarat 
            $syarat_6 = $request->file('syarat_6');
            if (!is_null($syarat_6)) {
                $nama_syarat_6 = $npm . "_" . time() . "_" . $syarat_6->getClientOriginalName();
                $syarat_6_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_6);
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSeminar->syarat_6 = $nama_syarat_6;
                $daftarSeminar->status_6 = 0;
            }

            // upload syarat 
            $syarat_7 = $request->file('syarat_7');
            if (!is_null($syarat_7)) {
                $nama_syarat_7 = $npm . "_" . time() . "_" . $syarat_7->getClientOriginalName();
                $syarat_7_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_7);
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSeminar->syarat_7 = $nama_syarat_7;
                $daftarSeminar->status_7 = 0;
            }

            // upload syarat 
            $syarat_8 = $request->file('syarat_8');
            if (!is_null($syarat_8)) {
                $nama_syarat_8 = $npm . "_" . time() . "_" . $syarat_8->getClientOriginalName();
                $syarat_8_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_8);
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSeminar->syarat_8 = $nama_syarat_8;
                $daftarSeminar->status_8 = 0;
            }

            // upload syarat 
            $syarat_9 = $request->file('syarat_9');
            if (!is_null($syarat_9)) {
                $nama_syarat_9 = $npm . "_" . time() . "_" . $syarat_9->getClientOriginalName();
                $syarat_9_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_9);
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSeminar->syarat_9 = $nama_syarat_9;
                $daftarSeminar->status_9 = 0;
            }

            // upload syarat 
            $syarat_10 = $request->file('syarat_10');
            if (!is_null($syarat_10)) {
                $nama_syarat_10 = $npm . "_" . time() . "_" . $syarat_10->getClientOriginalName();
                $syarat_10_path = 'mahasiswa/seminar';
                File::delete('mahasiswa/seminar/' . $daftarSeminar->syarat_10);
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSeminar->syarat_10 = $nama_syarat_10;
                $daftarSeminar->status_10 = 0;
            }

            $daftarSeminar->save();

            return redirect()->route('seminar_pwk.index')->with('success', 'Sukses mengajukan pendaftaran sidang pembahasan!');
        }
    }
}
