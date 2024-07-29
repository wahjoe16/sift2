<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Archive;
use App\Models\CategoryArchive;
use App\Models\MyArchive;
use App\Models\Section;
use App\Models\Semester;
use App\Models\SubcategoryArchive;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ZipArchive;

class MyArchiveController extends Controller
{
    public function indexArchive()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $title2 = "Delete Arsip!";
        $text = "Anda yakin akan menghapus arsip?";
        confirmDelete($title2, $text);
        Session::put('page', 'allArchive');
        return view('all-archive.index', compact('ta', 'smt', 'category', 'subcategory'));
    }

    public function indexDataArchive()
    {
        $data = Archive::with([
            'section',
            'category_archive',
            'subcategory_archive',
            'tahun_ajaran',
            'semester',
            'user_upload'
        ])->orderBy('section_id', 'asc');

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        if (request('category_archive_id')) {
            $data->whereRelation('category_archive', 'id', request('category_archive_id'));
        }

        if (request('subcategory_archive_id')) {
            $data->whereRelation('subcategory_archive', 'id', request('subcategory_archive_id'));
        }

        return datatables()
            ->of($data)
            ->filterColumn('tahun_ajaran.tahun_ajaran', function ($query, $keyword) {
                $query->whereRelation('tahun_ajaran', 'id', $keyword);
            })
            ->filterColumn('semester.semester', function ($query, $keyword) {
                $query->whereRelation('semester', 'id', $keyword);
            })
            ->filterColumn('category_archives.name', function ($query, $keyword) {
                $query->whereRelation('category_archive', 'id', $keyword);
            })
            ->filterColumn('subcategory_archives.name', function ($query, $keyword) {
                $query->whereRelation('subcategory_archive', 'id', $keyword);
            })
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '
                <a href="' . route('my-archive.show', $data->id) . '" target="_blank" class="btn btn-info btn-flat btn-sm"><i class="fa fa-search"></i></a>
                <a href="' . route('my-archive.download', $data->id) . '" class="btn btn-primary btn-flat btn-sm" target="_blank"><i class="fa fa-download"></i></a>
                <a href="' . route('my-archive.add', $data->id) . '" class="btn btn-success btn-flat btn-sm"><i class="fa fa-plus"></i></a>
            ';
            })
            ->rawColumns(['action', 'file'])
            ->make(true);
    }

    public function addArchive($id)
    {
        $data = new MyArchive();
        $data->user_id = auth()->user()->id;
        $data->archive_id = $id;
        $data->save();
        return redirect()->back()->with('success', 'Sukses menambahkan arsip ke Arsip Saya');
    }

    public function myArchive()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        // $user = auth()->user();
        // $myarchive = $user->archives;
        // dd($myarchive);
        Session::put('page', 'myArchive');
        return view('my-archive.index', compact('ta', 'smt', 'category', 'subcategory'));
    }

    public function myDataArchive()
    {
        $user = auth()->user();
        $myarchive = Archive::select('archives.id', 'archives.name as a_name', 'users.nama as uu', 'sections.name as s_name', 'category_archives.name as c_name', 'subcategory_archives.name as sa_name', 'tahun_ajaran.tahun_ajaran as ta', 'semester.semester as smt', )
            ->leftJoin('my_archives', 'my_archives.archive_id', 'archives.id')
            ->leftJoin('sections', 'sections.id', 'archives.section_id')
            ->leftJoin('category_archives', 'category_archives.id', 'archives.category_archive_id')
            ->leftJoin('subcategory_archives', 'subcategory_archives.id', 'archives.subcategory_archive_id')
            ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'archives.tahun_ajaran_id')
            ->leftJoin('semester', 'semester.id', 'archives.semester_id')
            ->leftJoin('users', 'users.id', 'archives.user_upload')
            ->where('my_archives.user_id', $user->id);

        if (request('tahun_ajaran_id')) {
            $myarchive->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $myarchive->whereRelation('semester', 'id', request('semester_id'));
        }

        if (request('category_archive_id')) {
            $myarchive->whereRelation('category_archive', 'id', request('category_archive_id'));
        }

        if (request('subcategory_archive_id')) {
            $myarchive->whereRelation('subcategory_archive', 'id', request('subcategory_archive_id'));
        }

        return datatables()
            ->of($myarchive)
            ->filterColumn('tahun_ajaran.tahun_ajaran', function ($query, $keyword) {
                $query->whereRelation('tahun_ajaran',  'id', $keyword);
            })
            ->filterColumn('semester.semester', function ($query, $keyword) {
                $query->whereRelation('semester', 'id', $keyword);
            })
            ->filterColumn('category_archives.name', function ($query, $keyword) {
                $query->whereRelation('category_archives', 'id', $keyword);
            })
            ->filterColumn('subcategory_archives.name', function ($query, $keyword) {
                $query->whereRelation('subcategory_archives', 'id', $keyword);
            })
            ->addIndexColumn()
            ->addColumn('select_all', function ($myarchive) {
                return '
                    <input class="indi_check" type="checkbox" name="archive_id[]" value="' . $myarchive->id . '">
                ';
            })
            ->addColumn('aksi', function ($myarchive) {
                $path = asset("/file/archives/$myarchive->file");
                return '
                <a href="' . route('my-archive.show', $myarchive->id) . '" target="_blank" class="btn btn-info btn-flat btn-sm"><i class="fa fa-search"></i></a>
                <a href="' . route('my-archive.download', $myarchive->id) . '" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-download"></i></a>
                <a href="' . route('my-archive.edit', $myarchive->id) . '" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i></a>
                <a href="' . route('my-archive.destroy', $myarchive->id) . '" class="btn btn-danger btn-flat btn-sm" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['select_all', 'aksi'])
            ->make(true);
    }

    public function createArchive()
    {
        $title = "Tambah Data Arsip";
        $section = Section::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $ta = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();
        $smt = Semester::get();

        return view('my-archive.create', compact('subcategory', 'ta', 'smt', 'category', 'section', 'title'));
    }

    public function storeArchive(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|max:255',
            'file.*' => 'mimes:pdf,xls,xlxs,doc,docx,csv,jpg,jpeg,png',
            'section_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'category_archive_id' => 'required',
            'subcategory_archive_id' => 'required',
            'semester_id' => 'required',
            'name' => 'required|max:255',
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'Format file harus pdf,xls,xlxs,doc,docx,csv,jpg,jpeg,png',
            'section_id.required' => 'Bidang tidak boleh kosong',
            'tahun_ajaran_id' => 'Tahun akademik tidak boleh kosong',
            'semester_id' => 'Semester tidak boleh kosong',
            'category_archive_id' => 'Kategori arsip tidak boleh kosong',
            'subcategory_archive_id' => 'Sub Kategori arsip tidak boleh kosong',
            'name.required' => 'Nama arsip tidak boleh kosong',
            'file.max' => 'Nama file arsip tidak boleh lebih dari 255 karakter',
            'name.max' => 'Nama arsip tidak boleh lebih dari 255 karakter',
        ]);

        foreach ($request->file as $file) {
            $fileName = 'file_' . date('d-m-YHis') . '_' . $file->getClientOriginalName();
            $path = 'file/archives';
            $file->move($path, $fileName);
            $data = new Archive();
            $data->name = $request->name;
            $data->section_id = $request->section_id;
            $data->category_archive_id = $request->category_archive_id;
            $data->subcategory_archive_id = $request->subcategory_archive_id;
            $data->tahun_ajaran_id = $request->tahun_ajaran_id;
            $data->semester_id = $request->semester_id;
            $data->file = $fileName;
            $user = auth()->user();
            $data->save();
            $data->users()->sync($user->id);
        }
        return redirect()->route('my-archive.index')->with('success', 'Archive has been successfull created!');
    }

    public function showArchive($id)
    {
        $data = Archive::with('users')->findOrFail($id);
        $users = User::get();
        return view('my-archive.show', compact('data', 'users'));
    }

    public function editArchive($id)
    {
        $title = "Edit Data Arsip";
        $data = Archive::find($id);
        $section = Section::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $ta = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();
        $smt = Semester::get();
        return view('my-archive.edit', compact('data', 'title', 'section', 'category', 'subcategory', 'ta', 'smt'));
    }

    public function updateArchive(Request $request, $id)
    {
        $archive = Archive::find($id);
        $user = auth()->user();
        $this->validate($request, [
            'file.*' => 'mimes:pdf,xls,xlxs,doc,docx,csv,jpg,jpeg,png',
            'section_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'semester_id' => 'required',
            'name' => 'required'
        ]);

        $data = $request->only('name', 'section_id', 'category_archive_id', 'subcategory_archive_id', 'tahun_ajaran_id', 'semester_id');

        if ($request->hasFile('file')) {
            $data['file'] = $this->saveFile($request->file('file'));
            if ($archive->file !== '') $this->deleteFile($archive->file);
        }

        $archive->update($data);
        $archive->users()->sync($user->id);
        return redirect()->route('my-archive.index')->with('success', 'Archive updated successfully!');
    }

    public function saveFile(UploadedFile $file)
    {
        $fileName = 'file_' . date('d-m-YHis') . '_' . $file->getClientOriginalName();
        $path = 'file/archives';
        $file->move($path, $fileName);
        return $fileName;
    }

    public function deleteFile($fileArsip)
    {
        $path = 'file/archives/' . $fileArsip;
        return File::delete($path);
    }

    public function deleteArchive($id)
    {
        $data = Archive::find($id);
        if ($data->file !== '') $this->deleteFile($data->file);
        $data->delete();
        return redirect()->back()->with('success', 'Archive deleted successfully!');
    }

    public function indexGeneral()
    {
        $ta = TahunAjaran::orderBy('tahun_ajaran')->get();
        $smt = Semester::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $title2 = "Delete Arsip!";
        $text = "Anda yakin akan menghapus arsip?";
        confirmDelete($title2, $text);

        Session::put('page', 'generalArsip');
        return view('my-archive.general', compact('ta', 'smt', 'category', 'subcategory'));
    }

    public function dataGeneral()
    {
        $data = Archive::with([
            'section',
            'category_archive',
            'subcategory_archive',
            'tahun_ajaran',
            'semester',
            'user_upload'
        ])->doesntHave('users');

        if (request('tahun_ajaran_id')) {
            $data->whereRelation('tahun_ajaran', 'id', request('tahun_ajaran_id'));
        }

        if (request('semester_id')) {
            $data->whereRelation('semester', 'id', request('semester_id'));
        }

        if (request('category_archive_id')) {
            $data->whereRelation('category_archive', 'id', request('category_archive_id'));
        }

        if (request('subcategory_archive_id')) {
            $data->whereRelation('subcategory_archive', 'id', request('subcategory_archive_id'));
        }

        return datatables()
            ->of($data)
            ->filterColumn('tahun_ajaran.tahun_ajaran', function ($query, $keyword) {
                $query->whereRelation('tahun_ajaran', 'id', $keyword);
            })
            ->filterColumn('semester.semester', function ($query, $keyword) {
                $query->whereRelation('semester', 'id', $keyword);
            })
            ->filterColumn('category_archives.name', function ($query, $keyword) {
                $query->whereRelation('category', 'id', $keyword);
            })
            ->filterColumn('subcategory_archives.name', function ($query, $keyword) {
                $query->whereRelation('subcategory', 'id', $keyword);
            })
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '
                    <a href="' . route('my-archive.show', $data->id) . '" target="_blank" class="btn btn-info btn-flat btn-sm"><i class="fa fa-search"></i></a>
                    <a href="' . route('my-archive.download', $data->id) . '" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-download"></i></a>
                    ';
            })
            ->rawColumns(['select_all', 'action'])
            ->make(true);
    }

    public function downloadFile($id)
    {
        $data = Archive::findOrFail($id);
        $filePath = 'file/archives/' . $data->file;
        return Response::download($filePath);
    }

    public function downloadSelected(Request $request)
    {
        foreach ($request->archive_id as $id) {
            $archive = Archive::find($id);
            $archiveFile = 'file/archives/' . $archive->file;
            // return $archiveFile;

        }
        return Response::download($archiveFile);
        // return redirect()->back();

        // $user = auth()->user();
        // $myarchive = $user->archives;
        // // dd($myarchive);
        // foreach ($myarchive as $ma => $value) {
        //     $archiveFile = $value->file;
        // }

        // $zip = new ZipArchive;
        // $fileName = 'myFileArchive.zip';

        // if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
        //     $files = File::files('file/archives/');

        //     foreach ($files as $key => $value) {
        //         $relativeName = basename($value);
        //         $zip->addFile($value, $relativeName);
        //     }

        //     $zip->close();
        // }

        // return response()->download(public_path($fileName));
    }
}
