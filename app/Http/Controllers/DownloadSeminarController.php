<?php

namespace App\Http\Controllers;

use App\Models\DaftarSeminar;
use Composer\Util\Zip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use ZipArchive;

class DownloadSeminarController extends Controller
{
    public function indexPwk()
    {
        return view('download_seminar.pwk.index');
    }

    public function dataPwk()
    {
        $data = DaftarSeminar::select('daftar_seminar.*', 'users.nik', 'users.nama', 'tahun_ajaran.tahun_ajaran', 'semester.semester')
            ->leftJoin('users', 'users.id', 'daftar_seminar.mahasiswa_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'daftar_seminar.semester_id')
            ->where([
                'program_studi' => 'Perencanaan Wilayah dan Kota',
                'status' => 1
            ]);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('select_all_syarat1', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat1" value="' . $data->syarat_1 . '" />';
            })
            ->addColumn('select_all_syarat2', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat2" value="' . $data->syarat_2 . '" />';
            })
            ->addColumn('select_all_syarat3', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat3" value="' . $data->syarat_3 . '" />';
            })
            ->addColumn('select_all_syarat4', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat4" value="' . $data->syarat_4 . '" />';
            })
            ->addColumn('select_all_syarat5', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat5" value="' . $data->syarat_5 . '" />';
            })
            ->addColumn('select_all_syarat6', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat6" value="' . $data->syarat_6 . '" />';
            })
            ->addColumn('select_all_syarat7', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat7" value="' . $data->syarat_7 . '" />';
            })
            ->addColumn('select_all_syarat8', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat8" value="' . $data->syarat_8 . '" />';
            })
            ->addColumn('select_all_syarat9', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat9" value="' . $data->syarat_9 . '" />';
            })
            ->addColumn('select_all_syarat10', function ($data) {
                return '<input type="checkbox" name="syarat[]" class="syarat10" value="' . $data->syarat_10 . '" />';
            })
            ->rawColumns([
                'select_all_syarat1',
                'select_all_syarat2',
                'select_all_syarat3',
                'select_all_syarat4',
                'select_all_syarat5',
                'select_all_syarat6',
                'select_all_syarat7',
                'select_all_syarat8',
                'select_all_syarat9',
                'select_all_syarat10',
            ])
            ->make(true);
    }

    public function downloadSelected(Request $request)
    {

        // $files = $request->syarat;
        // $zip = new ZipArchive;
        // $fileName = 'sidang_pembahasan.zip';

        // if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
        //     foreach ($files as $file) {
        //         $path = File::files(asset('public/mahasiswa/seminar/' . $file));
        //         $relativeName = basename($path);
        //         $zip->addFile($path, $relativeName);
        //     }
        //     $zip->close();
        // }

        // return Response::download(public_path($fileName));
    }
}
