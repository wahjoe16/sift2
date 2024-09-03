<?php

namespace App\Http\Controllers;

use App\Models\CategorySkkft;
use App\Models\Kegiatan;
use App\Models\SertifikatSkkft;
use App\Models\Skpi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class SkpiController extends Controller
{
    public function index()
    {
        $data = SertifikatSkkft::where('status_skpi', 0)->get();
        return view('skpi.index', compact('data'));
    }

    public function show($id)
    {
        $data = SertifikatSkkft::find($id);
        // dd($data);
        $dataKegiatan = Kegiatan::select('kegiatan.*', 'users.nik', 'users.nama', 'category_skkft.category_name', 'subcategory_skkft.subcategory_name', 'tingkat.tingkat', 'jabatan.jabatan', 'prestasi_skkft.prestasi')
                        ->where(['user_id' => $data->user_id, 'status_skpi' => 1])
                        ->leftJoin('users', 'users.id', '=', 'kegiatan.user_id')
                        ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan.category_id')
                        ->leftJoin('subcategory_skkft', 'subcategory_skkft.id', '=', 'kegiatan.subcategory_id')
                        ->leftJoin('tingkat', 'tingkat.id', '=', 'kegiatan.tingkat_id')
                        ->leftJoin('prestasi_skkft', 'prestasi_skkft.id', '=', 'kegiatan.prestasi_id')
                        ->leftJoin('jabatan', 'jabatan.id', '=', 'kegiatan.jabatan_id')
                        ->get();
        // dd($dataKegiatan);
        return view('skpi.show', compact('data', 'dataKegiatan'));
    }

    public function verify($id)
    {
        $dataSertifikat = SertifikatSkkft::find($id);
        $dataSertifikat->status_skpi = 1;
        $dataSertifikat->save();

        // create SKPI
        $data = new Skpi();
        $data->user_id = $dataSertifikat->user_id;
        $data->tanggal = Carbon::now();
        $data->status = 1;
        $data->save();

        return redirect()->route('skpi.index')->with('success', "Sukses Terbitkan SKPI!");
    }

    public function deleteKegiatan($id)
    {
        $data = Kegiatan::find($id);
        $data->status_skpi = 0;
        $data->save();

        return redirect()->back()->with('success', 'Kegiatan SKKFT berhasil dihapus!');
    }

    public function list()
    {
        $data = Skpi::where('status', 1)->orderBy('id', 'desc')->get();
        return view('skpi.list', compact('data'));
    }

    public function datalist()
    {
        $data = Skpi::with('user_skpi')->where('status', 1)->orderBy('id', 'desc')->get();
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function($data){
                return tanggal_indonesia($data->tanggal, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="'.route('skpi.edit', $data->id).'" class="btn btn-warning text-black btn-flat btn-sm"><i class="fa fa-edit"></i></a>
                ';
            })
            ->rawColumns(['tanggal','aksi'])
            ->make(true);
    }

    public function edit($id)
    {
        $data = Skpi::with('user_skpi')->find($id);
        // dd($data);

        $dataKegiatan = Kegiatan::select('kegiatan.*', 'users.nik', 'users.nama', 'category_skkft.category_name', 'subcategory_skkft.subcategory_name', 'tingkat.tingkat', 'jabatan.jabatan', 'prestasi_skkft.prestasi')
                        ->where(['user_id' => $data->user_id, 'status_skpi' => 1])
                        ->leftJoin('users', 'users.id', '=', 'kegiatan.user_id')
                        ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan.category_id')
                        ->leftJoin('subcategory_skkft', 'subcategory_skkft.id', '=', 'kegiatan.subcategory_id')
                        ->leftJoin('tingkat', 'tingkat.id', '=', 'kegiatan.tingkat_id')
                        ->leftJoin('prestasi_skkft', 'prestasi_skkft.id', '=', 'kegiatan.prestasi_id')
                        ->leftJoin('jabatan', 'jabatan.id', '=', 'kegiatan.jabatan_id')
                        ->get();

        return view('skpi.edit', compact('data', 'dataKegiatan'));
    }

    public function update(Request $request, $id)
    {
        $data = Skpi::find($id);
        
        $date1 = $request->tanggal_lahir;
        $date2 = $request->tanggal_masuk;
        $date3 = $request->tanggal_lulus;
        $data->tanggal_lahir = date('Y-m-d', strtotime($date1));
        $data->tanggal_masuk = date('Y-m-d', strtotime($date2));
        $data->tanggal_lulus = date('Y-m-d', strtotime($date3));
        $data->no_ijazah = $request->no_ijazah;
        $data->no_skpi = $request->no_skpi;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->akreditasi_prodi = $request->akre_prodi;
        $data->akreditasi_fakultas = $request->akre_fakultas;
        $data->lama_studi = $request->lama_studi;
        $data->status_cetak = 1;
        $data->save();

        return redirect()->back()->with('success', 'Data SKPI berhasil diupdate!');
    }

    public function print($id)
    {
        $data = Skpi::find($id);       

        $templateProcessor = new TemplateProcessor('skpi-template/skpi.docx');

        $kodeTmb = "70.1";
        $kodeTi = "70.2";
        $kodePwk = "70.3";
        if($data->user_skpi->program_studi == 'Teknik Pertambangan') {
            $templateProcessor->setValue('kodeProdi', $kodeTmb);
        }elseif ($data->user_skpi->program_studi == 'Teknik Industri') {
            $templateProcessor->setValue('kodeProdi', $kodeTi);
        }elseif ($data->user_skpi->program_studi == 'Perencanaan Wilayah dan Kota') {
            $templateProcessor->setValue('kodeProdi', $kodePwk);
        }

        $tahun = date('Y');
        $templateProcessor->setValue('tahun', $tahun);

        $templateProcessor->setValue('no_skpi', $data->no_skpi);
        $templateProcessor->setValue('nama', $data->user_skpi->nama);
        $templateProcessor->setValue('npm', $data->user_skpi->nik);
        $templateProcessor->setValue('program_studi', $data->user_skpi->program_studi);
        $templateProcessor->setValue('tempat_lahir', $data->tempat_lahir);
        $templateProcessor->setValue('tanggal_lahir', tanggal_indonesia($data->tanggal_lahir, false));
        $templateProcessor->setValue('no_ijazah', $data->no_ijazah);
        $templateProcessor->setValue('tanggal_masuk', tanggal_indonesia($data->tanggal_masuk, false));
        $templateProcessor->setValue('tanggal_lulus', tanggal_indonesia($data->tanggal_lulus, false));

        $dateIn = date_create($data->tanggal_masuk);
        $dateOut = date_create($data->tanggal_lulus);
        $interval = date_diff($dateIn, $dateOut);
        $templateProcessor->setValue('lama_studi', $interval->y.' Tahun '. $interval->m.' Bulan ');

        $templateProcessor->setValue('akre_fakultas', $data->akreditasi_fakultas);
        $templateProcessor->setValue('akre_prodi', $data->akreditasi_prodi);
        $templateProcessor->setValue('tanggal_pengajuan', tanggal_indonesia($data->tanggal, false));
        $templateProcessor->setImageValue('foto', 
                                            array(
                                                'pathOnDisk' => public_path('user/foto/'.$data->user_skpi->foto),
                                                'width' => 200,
                                                'height' => 200,
                                                'align' => 'center',
                                                'vertical' => 'center'
                                            )
                                        );

        $gelarTiTmb = "S.T. (Sarjana Teknik)";
        $gelarPwk = "S.PWK. (Sarjana Perencanaan Wilayah dan Kota)";

        if ($data->user_skpi->program_studi == 'Teknik Pertambangan' || $data->user_skpi->program_studi == 'Teknik Industri') {
            $templateProcessor->setValue('gelar', $gelarTiTmb);
        }elseif ($data->user_skpi->program_studi == 'Perencanaan Wilayah dan Kota') {
            $templateProcessor->setValue('gelar', $gelarPwk);
        }

        $cplTambang = [
            "Mampu mengidentifikasi, memformulasi, dan menyelesaikan permasalahan rekayasa (engineering) dalam bidang pertambangan dengan menerapkan prinsip-prinsip rekayasa, sains dan matematika.",
            "Mampu menerapkan perancangan rekayasa untuk menyelesaikan permasalahan dalam bidang pertambangan dengan mempertimbangkan K3, faktor global, budaya, sosial, ekonomi, lingkungan, dan ekonomi",
            "Mampu berkomunikasi lisan dan tulisan secara efektif dengan berbagai pihak terkait",
            "Mampu bertanggung jawab dan mematuhi etika profesi dalam bidang rekayasa pertambangan serta membuat keputusan dengan mempertimbangkan dampak terhadap sosial, ekonomi dan lingkungan secara global",
            "Mampu bekerja sama dengan tim secara efektif, berjiwa kepemimpinan, menciptakan suasana yang kolaboratif dan inklusif, serta mampu menetapkan target, rencana dan tujuan secara objectif",
            "Mampu mengembangkan dan melakukan eksperimen secara tepat, menganalisis dan menginterpretasikan data serta menarik kesimpulan dan mengambil keputusan secara teknis",
            "Mampu memahani kebutuhan akan pembelajaran sepanjang hayat, termasuk menerapkan pengetahuan kekinian yang relevan sesuai kebutuhan dengan strategi yang tepat"
        ];       

        $cplPwk = [
            "Menguasai dan menerapkan konsep teoritis, prinsip, dan proses dalam bidang perencanaan wilayah, desa, dan kota.",
            "Menguasai dan menerapkan teknik analisis berbasis ipteks yang relevan dalam bidang perencanaan wilayah, desa, dan kota.",
            "Menguasai metode perencanaan dalam alternatif pengambilan keputusan di bidang perencanaan wilayah, desa, dan kota.",
            "Menganalisis potensi dan permasalahan konteks keruangan maupun non keruangan dalam permasalahan perencanaan wilayah, desa, dan kota.",
            "Melakukan penelitian di bidang perencanaan wilayah, desa, dan kota.",
            "Menjelaskan pemanfaatan, pengendalian, dan evaluasi hasil perencanaan.",
            "Memformulasikan alternatif solusi dalam perencanaan wilayah, desa, dan kota.",
            "Mendokumentasikan dan mengkomunikasikan hasil perencanaan wilayah, desa, dan kota.",
            "Menerapkan norma dan nilai di Indonesia dalam praktek perencanaan wilayah, desa, dan kota.",
            "Bekerjasama dengan tim multi displin ilmu.",
        ];

        $cplTi = "";

        if ($data->user_skpi->program_studi == 'Teknik Pertambangan') {
            $templateProcessor->setValue('cpl1', $cplTambang[0]);
            $templateProcessor->setValue('cpl2', $cplTambang[1]);
            $templateProcessor->setValue('cpl3', $cplTambang[2]);
            $templateProcessor->setValue('cpl4', $cplTambang[3]);
            $templateProcessor->setValue('cpl5', $cplTambang[4]);
            $templateProcessor->setValue('cpl6', $cplTambang[5]);
            $templateProcessor->setValue('cpl7', $cplTambang[6]);
        }elseif ($data->user_skpi->program_studi == 'Perencanaan Wilayah dan Kota') {
            $templateProcessor->setValue('cpl1', $cplPwk[0]);
            $templateProcessor->setValue('cpl2', $cplPwk[1]);
            $templateProcessor->setValue('cpl3', $cplPwk[2]);
            $templateProcessor->setValue('cpl4', $cplPwk[3]);
            $templateProcessor->setValue('cpl5', $cplPwk[4]);
            $templateProcessor->setValue('cpl6', $cplPwk[5]);
            $templateProcessor->setValue('cpl7', $cplPwk[6]);
            $templateProcessor->setValue('cpl8', $cplPwk[7]);
            $templateProcessor->setValue('cpl9', $cplPwk[8]);
            $templateProcessor->setValue('cpl10', $cplPwk[9]);
        }elseif ($data->user_skpi->program_studi == 'Teknik Industri') {
            $templateProcessor->setValue('cpl', $cplTi);
        }

        $skemaTambang = "
            Pendidikan Program Sarjana mempunyai beban 146 SKS. Satu SKS beban akademik Program Sarjana setara dengan upaya mahasiswa sebanyak tiga jam seminggu dalam satu semester reguler, yang meliputi satu jam kegiatan interaksi akademik terjadwal dengan staf pengajar, berupa kegiatan tatap muka di kelas satu jam kegiatan terstruktur yang dilakukan dalam rangka kegiatan kuliah, seperti menyelesaikan tugas, menyelesaikan soal, membuat makalah, menelusuri pustaka, serta satu jam kegiatan mandiri untuk mendalami dan mempersiapkan tugas-tugas akademik, misalnya membaca buku referensi. Bagian dari 146 SKS tersebut terdiri dari 91 SKS mata kuliah keahlian berkarya (MKKB), 10 SKS mata kuliah berkehidupan bermasyarakat (MBB), 10 SKS mata kuliah kepribadian (MK), 10 SKS mata kuliah keilmuan dan ketrampilan (MKK) dan 7 SKS mata kuliah wajib institusi unisba (MIU). Terdapat tiga kelompok keahlian pada Program Studi Pertambangan yaitu Kelompok Keahlian Geologi Eksplorasi, Kelompok Keahlian Tambang Umum, dan Kelompok Keahlian Pengolahan.
        ";

        $skemaPwk = "
            Pendidikan Program Sarjana mempunyai beban 144 SKS. Satu SKS beban akademik Program Sarjana setara dengan upaya mahasiswa sebanyak tiga jam seminggu dalam satu semester reguler, yang meliputi satu jam kegiatan interaksi akademik terjadwal dengan staf pengajar, berupa kegiatan tatap muka di kelas satu jam kegiatan terstruktur yangd dilakukan dalam rangka kegiatan kuliah, seperti menyelesaikan tugas, menyelesaikan soal, membuat makalah, menelusuri pustaka, serta satu jam kegiatan mandiri untuk mendalami dan mempersiapkan tugas-tugas akademik, misalnya membaca buku referensi. Bagian dari 144 SKS tersebut merupakan 6 SKS Mata Kuliah Keagamaan dan Pesantren yang dilakukan selama 7 semester. Kuliah Keagamaan dan Pesantren diselenggarakan dengan tujuan untuk memperkokoh pengetahuan tentang materi ilmu agama islam dan menghasilkan lulusan yang berakhlak baik. Pendidikan Program Sarjana Program Studi Perencanaan Wilayah dan Kota terbagi atas 135 SKS mata kuliah pokok dan 9 SKS mata kuliah pilihan. Penentuan 9 SKS mata kuliah   pilihan dilakukan berdasarkan pemilihan kelompok keahlian oleh mahasiswa. Terdapat lima kelompok keahlian pada Program Studi Perencanaan Wilayah dan Kota, yaitu Kelompok Keahlian Kota, Kelompok Keahlian Transportasi, Kelompok Keahlian Lingkungan, Kelompok Keahlian Pariwisata, dan Kelompok Keahlian Rekayasa Perdesaan.
        ";

        $skemaTi = "";

        if ($data->user_skpi->program_studi == 'Teknik Pertambangan') {
            $templateProcessor->setValue('skema', $skemaTambang);
        }elseif ($data->user_skpi->program_studi == 'Perencanaan Wilayah dan Kota') {
            $templateProcessor->setValue('skema', $skemaPwk);
        }elseif ($data->user_skpi->program_studi == 'Teknik Industri') {
            $templateProcessor->setValue('skema', $skemaTi);
        }
        
        /*
        $kegiatanPmb = Kegiatan::where(['category_id'=> $categorySkkft[0], 
                                        'status_skpi'=> 1
                       ])->pluck('nama_kegiatan');
        $templateProcessor->setValue('pmb', $kegiatanPmb);

        $kegiatanNalar = Kegiatan::where([
                                        'category_id'=> $categorySkkft[1], 
                                        'status_skpi'=> 1
                         ])->pluck('nama_kegiatan');
        $templateProcessor->setValue('nalar', $kegiatanNalar);

        $kegiatanBakat = Kegiatan::where([
                                        'category_id'=> $categorySkkft[2], 
                                        'status_skpi'=> 1
                         ])->pluck('nama_kegiatan');
        $templateProcessor->setValue('bakat', $kegiatanBakat);

        $kegiatanPkm = Kegiatan::where([
                                        'category_id'=> $categorySkkft[3], 
                                        'status_skpi'=> 1
                       ])->pluck('nama_kegiatan');
        $templateProcessor->setValue('pkm', $kegiatanPkm);

        $kegiatanKompetensi = Kegiatan::where([
                                        'category_id'=> $categorySkkft[4], 
                                        'status_skpi'=> 1
                              ])->pluck('nama_kegiatan');
        $templateProcessor->setValue('kompetensi', $kegiatanKompetensi);

        $kegiatanIslam = Kegiatan::where([
                                        'category_id'=> $categorySkkft[5], 
                                        'status_skpi'=> 1
                         ])->pluck('nama_kegiatan');
        $templateProcessor->setValue('islam', $kegiatanIslam);
        */
        
        $dataKegiatan = Kegiatan::select('kegiatan.nama_kegiatan', 'category_skkft.category_name')
                        ->where(['user_id' => $data->user_id, 'status_skpi' => 1])
                        ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan.category_id')
                        //->pluck('nama_kegiatan');

                        ->get()->toArray();
        // dd($dataKegiatan);
        
        // $namaKegiatan = [];
        // foreach($dataKegiatan as $keg) {
        //     $namaKegiatan[] = $keg->nama_kegiatan.'('. $keg->category_name. ')';
        // }
        // dd($namaKegiatan);
        // dd($dataKegiatan);
        // foreach($dataKegiatan as $kegiatan){
        //     $templateProcessor->setValue('nama_kegiatan',  $kegiatan);
        // }

        $templateProcessor->cloneBlock('block_kegiatan', 0, true, false, $dataKegiatan);
                      
        $categorySkkft = CategorySkkft::pluck('id');

        $fileName = $data->user_skpi->nik . '_' . $data->user_skpi->nama;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
        
    }
}
