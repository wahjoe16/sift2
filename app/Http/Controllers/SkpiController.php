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
        /* $dataKegiatan = Kegiatan::select('kegiatan.*', 'users.nik', 'users.nama', 'category_skkft.category_name', 'subcategory_skkft.subcategory_name', 'tingkat.tingkat', 'jabatan.jabatan', 'prestasi_skkft.prestasi')
                        ->where(['user_id' => $data->user_id, 'status_skpi' => 1])
                        ->leftJoin('users', 'users.id', '=', 'kegiatan.user_id')
                        ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan.category_id')
                        ->leftJoin('subcategory_skkft', 'subcategory_skkft.id', '=', 'kegiatan.subcategory_id')
                        ->leftJoin('tingkat', 'tingkat.id', '=', 'kegiatan.tingkat_id')
                        ->leftJoin('prestasi_skkft', 'prestasi_skkft.id', '=', 'kegiatan.prestasi_id')
                        ->leftJoin('jabatan', 'jabatan.id', '=', 'kegiatan.jabatan_id')
                        ->get(); */
        return view('skpi.show', compact('data'));
    }

    public function showData($id)
    {
        $data = SertifikatSkkft::find($id);
        $dataKegiatan = Kegiatan::with([
            'user_skkft', 'categories_skkft', 'subcategories_skkft', 'tingkat_skkft', 'prestasi_skkft', 'jabatan_skkft'
            ])->where([
                'user_id' => $data->user_id, 'status_skpi' => 1])->get();
        
        return datatables()
            ->of($dataKegiatan)
            ->addIndexColumn()
            ->addColumn('bukti_fisik', function($dataKegiatan){
                return '
                    <a href="' . asset('storage/', $dataKegiatan->bukti_fisik) . '" target="_blank"><i class="fa fa-link"></i></a>
                ';
            })
            ->addColumn('select_all', function($dataKegiatan){
                return '
                    <input type="checkbox" name="kegiatan_id[]" id="select_item" class="select_item" value="'.$dataKegiatan->id.'">
                ';
            })
            ->addColumn('aksi', function($dataKegiatan){
                return view('skpi.delete-item.form-delete', ['dataKegiatan' => $dataKegiatan]);
            })
            ->rawColumns(['bukti_fisik', 'select_all', 'aksi'])
            ->make(true);
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

    public function deleteSelectedKegiatan(Request $request)
    {
        // dd($request->all());
        foreach ($request->kegiatan_id as $id) {
            $data = Kegiatan::find($id);
            $data->status_skpi = 0;
            $data->save();
        }

        return redirect()->back()->with('success', 'Kegiatan SKKFT berhasil dihapus!');
    }

    public function list()
    {
        return view('skpi.list');
    }

    public function datalist()
    {
        $data = Skpi::with('user_skpi')->where(['status' => 1, 'status_cetak' => 0])->orderBy('id', 'desc')->get();
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function($data){
                return tanggal_indonesia($data->tanggal, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="'.route('skpi.edit', $data->id).'" class="btn btn-warning text-black btn-flat btn-xs"><i class="fas fa-pen"></i></a>
                ';
            })
            ->rawColumns(['tanggal','aksi'])
            ->make(true);
    }

    public function datalistAccept()
    {
        $data = Skpi::with('user_skpi')->where(['status' => 1, 'status_cetak' => 1])->orderBy('id', 'desc')->get();
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function($data){
                return tanggal_indonesia($data->tanggal, false);
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="'.route('skpi.edit', $data->id).'" class="btn btn-warning text-black btn-flat btn-xs"><i class="fas fa-pen"></i></a>
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

        $rules = [
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'tanggal_masuk' => 'required',
            'tanggal_lulus' => 'required',
            'no_ijazah' =>'required',
            'no_skpi' =>'required',
            'akre_prodi' =>'required'
        ];

        $customMessage = [
            'tempat_lahir.required' => 'Tempat Lahir Harus Diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir Harus Diisi',
            'tanggal_masuk.required' => 'Tanggal Masuk Perkuliahan Harus Diisi',
            'tanggal_lulus.required' => 'Tanggal Lulus Perkuliahan Harus Diisi',
            'no_ijazah.required' => 'No Ijazah Harus Diisi',
            'no_skpi.required' => 'No SKPI Harus Diisi',
            'akre_prodi.required' => 'Akreditasi Program Studi Harus Diisi'
        ];

        $this->validate($request, $rules, $customMessage);
        
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
                                                'pathOnDisk' => storage_path('app/' . $data->user_skpi->foto),
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
            "Menunjukkan sikap ketakwaan kepada Allah SWT dalam kehidupan bermasyarakat yang menjunjung tinggi nasionalisme dan nilai kemanusiaan.",
            "Menunjukkan sikap tanggung jawab terhadap pekerjaan baik mandiri maupun bekerja sama dengan menginternalisasikan nilai, norma, etika akademik, semangat kejuangan, dan kewirausahaan.",
            "Mempraktikkan teknologi informasi dan ipteks dalam penyelesaian masalah dan penyusunan deskripsi saintifik yang ditunjang dengan kemampuan mendokumentasikan data berdasarkan pemikiran logis, kritis, sistematis dan inovatif, serta menegakkan integritas akademik.",
            "Membangun jejaring kerja untuk menghasilkan kinerja yang bermutu dan terukur yang didukung kemampuan komunikasi lisan dan tertulis serta kemampuan mengevaluasinya.",
            "Menguasai konsep teoritik, serta norma dan nilai-nilai yang relevan digunakan dalam bidang perencanaan wilayah dan kota.",
            "Menguasai prinsip dan proses, serta teknik analisis berbasis ipteks yang relevan digunakan dalam bidang perencanaan wilayah dan kota.",
            "Menguasai metode perencanaan dalam alternatif pengambilan keputusan di bidang perencanaan wilayah dan kota.",
            "Menerapkan konsep umum maupun teoretis, serta norma dan nilai yang relevan untuk menyelesaikan masalah di dalam praktek perencanaan wilayah dan kota.",
            "Menerapkan prinsip dan proses serta teknik-teknik formulasi rencana berdasarkan analisis potensi dan permasalahan dalam konteks keruangan dan non keruangan di bidang perencanaan wilayah dan kota.",
            "Memformulasikan alternatif solusi dalam perencanaan wilayah dan kota dengan mempertimbangkan pemanfaatan, pengendalian, dan evaluasi hasil perencanaan, serta mampu mendokumentasikan dan mengkomunikasikan hasilnya.",
        ];

        $cplTi = [
            "Menunjukkan keimanan dan ketakwaan kepada Allah SWT dan internalisasi nilai mujahid, mujtahid, dan mujaddid serta norma dan etika akademik",
            "Menunjukkan kontribusi dalam peningkatan mutu kehidupan masyarakat untuk kepentingan bangsa dan social kemasyarakatan yang dijiwai sikap nasionalisme, toleransi, kepekaan sosial, dan kepedulian berdasarkan Pancasila.",
            "Mampu menegakkan baqiyatush-shalihat (produk amal shalih yang berkekalan dunia sampai akhirat) dan berakhlaq karimah.",
            "Mampu menerapkan pemikiran logis, kritis, sistematis, dan inovatif dalam pengembangan ilmu pengetahuan dan teknologi, serta iman dan taqwa.",
            "Mampu menunjukkan kinerja mandiri, pengembangan jaringan kerja, dan berinovasi dalam menerapkan ilmu pengetahuan, serta iman dan taqwa.",
            "Mampu menggunakan teknologi informasi dalam konteks pencegahan plagiasi.",
            "Kemampuan untuk berkomunikasi lisan dan tulisan secara efektif.",
            "Kemampuan untuk merencanakan, menyelesaikan, dan mengevaluasi tugas dengan memperhatikan batasan yang diberikan.",
            "Kemampuan untuk bekerja dalam tim.",
            "Kemampuan untuk terlibat dalam pembelajaran sepanjang hayat, termasuk akses terhadap pengetahuan yang relevan dari isu-isu terkini.",
            "Kemampuan untuk menerapkan pengetahuan matematika, ilmu alam dan/atau material, teknologi informasi dan keteknikan untuk memperoleh pemahaman menyeluruh dari prinsip-prinsip keteknikindustrian.",
            "Kemampuan untuk merancang sistem terintegrasi dengan memenuhi standar yang diperlukan dan berbagai batasan multi aspek yang realistis (misal: teknis, aspek hukum, ekonomi, lingkungan, sosial, politik, kesehatan dan keselamatan, keberlanjutan), serta melibatkan berbagai pemangku kepentingan, dan mengidentifikasi dan/atau memanfaatkan potensi sumber daya lokal dan nasional dengan pandangan global di bidang teknik industri.",
            "Kemampuan untuk merancang dan melakukan eksperimen laboratorium dan/atau lapangan dan menganalisis dan menerjemahkan data untuk mendukung proses pengambilan keputusan keteknikindustrian.",
            "Kemampuan untuk mengidentifikasi, merumuskan, menganalisis dan menyelesaikan permasalahan kompleks di bidang teknik industri.",
            "Kemampuan untuk menerapkan metode, keterampilan, dan peralatan teknik modern yang diperlukan dalam praktik keteknikindustrian.",
            "Kemampuan untuk bertanggungjawab kepada masyarakat, akuntabel, dan menjalankan etika profesi dalam menyelesaikan permasalahan keteknikindustrian.",
            "Mampu merancang dan memperbaiki model bisnis dalam penciptaan nilai tambah pada industri yang sudah mapan atau pada perintisan usaha baru.",
        ];

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
            $templateProcessor->setValue('cpl1', $cplTi[0]);
            $templateProcessor->setValue('cpl2', $cplTi[1]);
            $templateProcessor->setValue('cpl3', $cplTi[2]);
            $templateProcessor->setValue('cpl4', $cplTi[3]);
            $templateProcessor->setValue('cpl5', $cplTi[4]);
            $templateProcessor->setValue('cpl6', $cplTi[5]);
            $templateProcessor->setValue('cpl7', $cplTi[6]);
            $templateProcessor->setValue('cpl8', $cplTi[7]);
            $templateProcessor->setValue('cpl9', $cplTi[8]);
            $templateProcessor->setValue('cpl10', $cplTi[9]);
            $templateProcessor->setValue('cpl11', $cplTi[10]);
            $templateProcessor->setValue('cpl12', $cplTi[11]);
            $templateProcessor->setValue('cpl13', $cplTi[12]);
            $templateProcessor->setValue('cpl14', $cplTi[13]);
            $templateProcessor->setValue('cpl15', $cplTi[14]);
            $templateProcessor->setValue('cpl16', $cplTi[15]);
            $templateProcessor->setValue('cpl17', $cplTi[16]);
        }

        $skemaTambang = "
            Pendidikan Program Sarjana mempunyai beban 146 SKS. Satu SKS beban akademik Program Sarjana setara dengan upaya mahasiswa sebanyak tiga jam seminggu dalam satu semester reguler, yang meliputi satu jam kegiatan interaksi akademik terjadwal dengan staf pengajar, berupa kegiatan tatap muka di kelas satu jam kegiatan terstruktur yang dilakukan dalam rangka kegiatan kuliah, seperti menyelesaikan tugas, menyelesaikan soal, membuat makalah, menelusuri pustaka, serta satu jam kegiatan mandiri untuk mendalami dan mempersiapkan tugas-tugas akademik, misalnya membaca buku referensi. Bagian dari 146 SKS tersebut terdiri dari 91 SKS mata kuliah keahlian berkarya (MKKB), 10 SKS mata kuliah berkehidupan bermasyarakat (MBB), 10 SKS mata kuliah kepribadian (MK), 10 SKS mata kuliah keilmuan dan ketrampilan (MKK) dan 7 SKS mata kuliah wajib institusi unisba (MIU). Terdapat tiga kelompok keahlian pada Program Studi Tekni Pertambangan yaitu Kelompok Keahlian Geologi Eksplorasi, Kelompok Keahlian Tambang Umum, dan Kelompok Keahlian Pengolahan.
        ";

        $skemaPwk = "
            Pendidikan Program Sarjana mempunyai beban 144 SKS. Satu SKS beban akademik Program Sarjana setara dengan upaya mahasiswa sebanyak tiga jam seminggu dalam satu semester reguler, yang meliputi satu jam kegiatan interaksi akademik terjadwal dengan staf pengajar, berupa kegiatan tatap muka di kelas satu jam kegiatan terstruktur yang dilakukan dalam rangka kegiatan kuliah, seperti menyelesaikan tugas, menyelesaikan soal, membuat makalah, menelusuri pustaka, serta satu jam kegiatan mandiri untuk mendalami dan mempersiapkan tugas-tugas akademik, misalnya membaca buku referensi. Bagian dari 144 SKS tersebut merupakan 6 SKS Mata Kuliah Keagamaan dan Pesantren yang dilakukan selama 7 semester. Kuliah Keagamaan dan Pesantren diselenggarakan dengan tujuan untuk memperkokoh pengetahuan tentang materi ilmu agama islam dan menghasilkan lulusan yang berakhlak baik. Pendidikan Program Sarjana Program Studi Perencanaan Wilayah dan Kota terbagi atas 135 SKS mata kuliah pokok dan 9 SKS mata kuliah pilihan. Penentuan 9 SKS mata kuliah   pilihan dilakukan berdasarkan pemilihan kelompok keahlian oleh mahasiswa. Terdapat lima kelompok keahlian pada Program Studi Perencanaan Wilayah dan Kota, yaitu Kelompok Keahlian Kota, Kelompok Keahlian Transportasi, Kelompok Keahlian Lingkungan, Kelompok Keahlian Pariwisata, dan Kelompok Keahlian Rekayasa Perdesaan.
        ";

        $skemaTi = "
            Pendidikan Program Sarjana mempunyai beban 144 SKS. Satu SKS beban akademik Program Sarjana setara dengan upaya mahasiswa sebanyak tiga jam seminggu dalam satu semester reguler, yang meliputi satu jam kegiatan interaksi akademik terjadwal dengan staf pengajar, berupa kegiatan tatap muka di kelas satu jam kegiatan terstruktur yang dilakukan dalam rangka kegiatan kuliah, seperti menyelesaikan tugas, menyelesaikan soal, membuat makalah, menelusuri pustaka, serta satu jam kegiatan mandiri untuk mendalami dan mempersiapkan tugas-tugas akademik, misalnya membaca buku referensi. Bagian dari 144 SKS tersebut merupakan 6 SKS Mata Kuliah Keagamaan dan Pesantren yang dilakukan selama 7 semester. Kuliah Keagamaan dan Pesantren diselenggarakan dengan tujuan untuk memperkokoh pengetahuan tentang materi ilmu agama islam dan menghasilkan lulusan yang berakhlak baik. Pendidikan Program Studi Teknik Industri terbagi atas 135 SKS mata kuliah pokok dan 9 SKS mata kuliah pilihan. Penentuan 9 SKS mata kuliah   pilihan dilakukan berdasarkan pemilihan kelompok keahlian oleh mahasiswa. Terdapat lima kelompok keahlian pada Program Studi Teknik Industri, yaitu Sistem Manufaktur, Ergonomi dan Rekayasa Kerja, Manajemen Industri, Sistem Informasi dan Keputusan, serta Sistem Industri dan Tekno-ekonomi.
        ";

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
