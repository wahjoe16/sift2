<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KegiatanOld;
use App\Models\User;
use Illuminate\Http\Request;

class ClaimSkkftController extends Controller
{
    public function recoveryKegiatan($id)
    {
        $mhs = User::find($id);
        $npm = $mhs->nik;
        $kegiatanOld = KegiatanOld::select('kegiatan_old.*', 'mahasiswa.npm', 'mahasiswa.nama_mahasiswa', 'category_skkft.category_name', 'subcategory_skkft.subcategory_name', 'tingkat.tingkat', 'jabatan.jabatan', 'prestasi_skkft.prestasi')
                       ->where(['mahasiswa.npm' => $npm, 'status' => 1])
                       ->leftJoin('mahasiswa', 'mahasiswa.id', 'kegiatan_old.mahasiswa_id')
                       ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan_old.kategori_id')
                       ->leftJoin('subcategory_skkft', 'subcategory_skkft.id', '=', 'kegiatan_old.subkategori_id')
                       ->leftJoin('tingkat', 'tingkat.id', '=', 'kegiatan_old.grade_id')
                       ->leftJoin('prestasi_skkft', 'prestasi_skkft.id', '=', 'kegiatan_old.prestasi_id')
                       ->leftJoin('jabatan', 'jabatan.id', '=', 'kegiatan_old.jabatan_id')
                       ->get();
        // dd($kegiatanOld);
        
        foreach ($kegiatanOld as $ko) {
            $newKegiatan = new Kegiatan();
            $newKegiatan->user_id = $mhs->id;
            $newKegiatan->category_id = $ko->kategori_id;
            $newKegiatan->subcategory_id = $ko->subkategori_id;
            $newKegiatan->tingkat_id = $ko->grade_id;
            $newKegiatan->prestasi_id = $ko->prestasi_id;
            $newKegiatan->jabatan_id = $ko->jabatan_id;
            $newKegiatan->nama_kegiatan = $ko->nama_kegiatan;
            $newKegiatan->tanggal = $ko->tanggal;
            $newKegiatan->bukti_fisik = $ko->sertifikat;
            $newKegiatan->point = $ko->poin;
            $newKegiatan->status_skkft = $ko->status;
            $newKegiatan->status_skpi = 1;
            $newKegiatan->keterangan = $ko->keterangan;
            $newKegiatan->save();
        }

        return redirect()->back()->with('success', 'Kegiatan SKKFT berhasil di pulihkan!');
        
    }
}
