<?php

namespace App\Http\Controllers;

use App\Models\CategorySkkft;
use App\Models\Jabatan;
use App\Models\Kegiatan;
use App\Models\PrestasiSkkft;
use App\Models\SertifikatSkkft;
use App\Models\Skpi;
use App\Models\SubcategorySkkft;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile as FileUploadedFile;

class KegiatanSkkftController extends Controller
{
    public function index()
    {
        $title = 'Hapus Kegiatan!';
        $text = "Apakah anda yakin?";
        Session::put('page', 'indexKegiatanSkkft');
        $user = auth()->user()->id;
        $kegiatan = Kegiatan::where('user_id', $user)->get();
        return view('kegiatan_skkft.index', compact('title', 'text', 'kegiatan'));
    }

    public function create()
    {
        Session::put('page', 'indexKegiatanSkkft');
        $title='Tambah Data Kegiatan SKKFT';
        $category=CategorySkkft::get();
        $subcategory=SubcategorySkkft::get();
        $tingkat=Tingkat::get();
        $prestasi=PrestasiSkkft::get();
        $jabatan=Jabatan::get();
        return view('kegiatan_skkft.create', compact('title', 'prestasi', 'jabatan', 'category', 'subcategory', 'tingkat'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' =>'required',
            'subcategory_id' =>'required',
            'nama_kegiatan' =>'required',
            'tanggal' =>'required',
            'bukti_fisik' =>'required|mimes:pdf|max:1000'
        ],[
            'category_id.required' => 'Kategori Harus Diisi',
            'subcategory_id.required' => 'Subkategori Harus Diisi',
            'nama_kegiatan.required' => 'Nama Kegiatan Harus Diisi',
            'tanggal.required' => 'Tanggal Kegiatan Harus Diisi',
            'bukti_fisik.required' => 'Bukti Fisik Harus Diisi',
            'bukti_fisik.mimes' => 'File Bukti Fisik Harus Format PDF',
            'bukti_fisik.max' => 'File Bukti Fisik Maximal 1MB',
        ]);

        $npm = auth()->user()->nik;
        $data = new Kegiatan();
        $data->user_id = auth()->user()->id;
        $data->nama_kegiatan = $request->nama_kegiatan;
        $date = $request->tanggal;
        $data->tanggal = date('Y-m-d', strtotime($date));
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->tingkat_id = $request->tingkat_id;
        $data->prestasi_id = $request->prestasi_id;
        $data->jabatan_id = $request->jabatan_id;

        // store bukti fisik
        $bukti_fisik = $request->file('bukti_fisik');
        $fileName = $npm . '_' . time() . '_' . $bukti_fisik->getClientOriginalName();
        $filePath = 'mahasiswa/skkft';
        $bukti_fisik->move($filePath, $fileName);

        $data->bukti_fisik = $fileName;

        $data->save();

        // $data = $request->only('nama_kegiatan', 'category_id', 'subcategory_id', 'tingkat_id', 'prestasi_id', 'jabatan_id');
        // if ($request->hasFile('file')) {
        //     $data['file'] = $this->saveBuktiFisik($request->file('file'));
        // }

        // // $data['user']

        // $saveData = Kegiatan::create($data);
        // $saveData['user_id'] = auth()->user()->id;
        // dd($saveData);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan SKKFT Berhasil Ditambahkan');
    }

    public function saveBuktiFisik(FileUploadedFile $file)
    {
        $fileName = 'sertifikat_'.auth()->user()->nik.'_'.date('Y-m-d H:i:s').'_'.$file->getClientOriginalName();
        $path='mahasiswa/skkft';
        $file->move($path, $fileName);
        return $fileName;
    }

    public function show($id)
    {
        Session::put('page', 'indexKegiatanSkkft');
        $kegiatan = Kegiatan::find($id);
        return view('kegiatan_skkft.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        Session::put('page', 'indexKegiatanSkkft');
        $title="Edit data Kegiatan SKKFT";
        $kegiatan = Kegiatan::find($id);
        $category=CategorySkkft::get();
        $subcategory=SubcategorySkkft::get();
        $tingkat=Tingkat::get();
        $prestasi=PrestasiSkkft::get();
        $jabatan=Jabatan::get();
        return view('kegiatan_skkft.edit', compact('title','kegiatan','prestasi', 'jabatan', 'category', 'subcategory', 'tingkat'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' =>'required',
            'subcategory_id' =>'required',
            'nama_kegiatan' =>'required',
            'tanggal' =>'required',
            'bukti_fisik' =>'required|mimes:pdf|max:1000'
        ],[
            'category_id.required' => 'Kategori Harus Diisi',
            'subcategory_id.required' => 'Subkategori Harus Diisi',
            'nama_kegiatan.required' => 'Nama Kegiatan Harus Diisi',
            'tanggal.required' => 'Tanggal Kegiatan Harus Diisi',
            'bukti_fisik.required' => 'Bukti Fisik Harus Diisi',
            'bukti_fisik.mimes' => 'File Bukti Fisik Harus Format PDF',
            'bukti_fisik.max' => 'File Bukti Fisik Tidak Boleh Lebih dari 1MB',
        ]);

        $npm = auth()->user()->nik;
        $data = Kegiatan::find($id);
        $data->user_id = auth()->user()->id;
        $data->nama_kegiatan = $request->nama_kegiatan;
        $date = $request->tanggal;
        $data->tanggal = date('Y-m-d', strtotime($date));
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->tingkat_id = $request->tingkat_id;
        $data->prestasi_id = $request->prestasi_id;
        $data->jabatan_id = $request->jabatan_id;
        $data->status_skkft = 0;

        // update bukti fisik
        if($data->bukti_fisik !== ''){
            $this->deleteFile($data->bukti_fisik);
            $bukti_fisik = $request->file('bukti_fisik');
            $fileName = $npm. '_'. time(). '_'. $bukti_fisik->getClientOriginalName();
            $filePath ='mahasiswa/skkft';
            $bukti_fisik->move($filePath, $fileName);
            $data->bukti_fisik = $fileName;
        }

        $data->save();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan SKKFT Berhasil Diubah');
    }

    public function deleteFile($buktiFisik)
    {
        $path = 'mahasiswa/skkft/' . $buktiFisik;
        return File::delete($path);
    }

    public function destroy($id)
    {
        $data = Kegiatan::find($id);
        if ($data->bukti_fisik !== '') $this->deleteFile($data->bukti_fisik);
        $data->delete();
        return redirect()->back()->with('success', 'Kegiatan SKKFT Berhasil Dihapus');
    }

     public function summary()
    {
        Session::put('page', 'summaryKegiatanSkkft');
        // $title = "Ajukan Sertifikat SKKFT!";
        // $text = "Apakah anda Yakin?";
        // confirmDelete($title, $text);
        $data = Kegiatan::where('user_id', auth()->user()->id)->get();
        $dataSertifikat = SertifikatSkkft::where('user_id', auth()->user()->id)->first();
        $dataSkpi = Skpi::where('user_id', auth()->user()->id)->first();

        $poinPerKategori = "
                            select category_skkft.id, category_skkft.category_name, sum(kegiatan.point) as poin from kegiatan
                            left join category_skkft on category_skkft.id = kegiatan.category_id
                            where kegiatan.user_id =? and kegiatan.status_skkft = 1
                            group by category_skkft.category_name, category_skkft.id
                            order by category_skkft.id
                        ";

        $category = CategorySkkft::get();
        $dataPoin = DB::select($poinPerKategori, [auth()->user()->id]);
        // dd($dataPoin);
        $poinMhs = [];
        $totalPoin = 0;

        foreach ($dataPoin as $dp) {
            $poinMhs[$dp->category_name] = $dp->poin;
            $totalPoin += $dp->poin;
        }

        $poinKategori = [];
        foreach ($category as $c) {
            if (array_key_exists($c->category_name, $poinMhs)) {
                $poinnya = $poinMhs[$c->category_name];
                $persennya = ($poinnya/150)*100;
            }else {
                $poinnya = 0;
                $persennya = 0;
            }

            $poinKategori[$c->id] = [
                'id' => $c->id,
                'category' => $c->category_name,
                'poin'=> $poinnya,
                'persennya' => $persennya,
                'lolos' => $persennya >= $c->bobot,
                'bobotnya' => $c->bobot
            ];
        }

        return view('kegiatan_skkft.summary', compact('data', 'dataSertifikat', 'dataSkpi' ,'dataPoin', 'poinKategori', 'totalPoin'));
    }

    public function dataSkkft()
    {
        $dataKegiatan = Kegiatan::where('user_id', auth()->user()->id)->get();

        return datatables()
            ->of($dataKegiatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dataKegiatan) {
                return '
                    <a href="' . route('kegiatan.show', $dataKegiatan->id) . '"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
