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
                    <a href="'.route('skpi.print', $data->id).'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-download"></i> Cetak</a>
                ';
            })
            ->rawColumns(['tanggal','aksi'])
            ->make(true);
    }

    public function print($id)
    {
        $data = Skpi::find($id);
        
        $dataKegiatan = Kegiatan::select('kegiatan.*', 'category_skkft.category_name')
                        ->where(['user_id' => $data->user_id, 'status_skpi' => 1])
                        ->leftJoin('category_skkft', 'category_skkft.id', '=', 'kegiatan.category_id')
                        ->get();
        
        $categorySkkft = CategorySkkft::pluck('id');
        

        $templateProcessor = new TemplateProcessor('skpi-template/skpi.docx');
        $templateProcessor->setValue('nama', $data->user_skpi->nama);
        $templateProcessor->setValue('npm', $data->user_skpi->nik);
        $templateProcessor->setValue('program_studi', $data->user_skpi->program_studi);
        $templateProcessor->setImageValue('foto', 
                                            array(
                                                'pathOnDisk' => public_path('user/foto/'.$data->user_skpi->foto),
                                                'width' => 200,
                                                'height' => 200,
                                                'align' => 'center',
                                                'vertical' => 'center'
                                            )
                                        );

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
          
        
        $fileName = $data->user_skpi->nik . '_' . $data->user_skpi->nama;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
        
    }
}
