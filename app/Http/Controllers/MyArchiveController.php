<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\CategoryArchive;
use App\Models\MyArchive;
use App\Models\Section;
use App\Models\Semester;
use App\Models\SubcategoryArchive;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            'semester'
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
                $path = asset("/file/archives/$data->file");
                return '
                <a href="' . $path . '" class="btn btn-primary btn-flat btn-sm" target="_blank"><i class="fa fa-download"></i></a>
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
        $myarchive = $user->archives;

        return datatables()
            ->of($myarchive)
            ->addIndexColumn()
            ->addColumn('select_all', function ($myarchive) {
                return '
                    <input type="checkbox" name="archive_id[]" value="' . $myarchive->id . '">
                ';
            })
            ->addColumn('a_name', function ($myarchive) {
                return $myarchive->name;
            })
            ->addColumn('s_name', function ($myarchive) {
                return $myarchive->section->name;
            })
            ->addColumn('c_name', function ($myarchive) {
                return $myarchive->category_archive->name;
            })
            ->addColumn('sa_name', function ($myarchive) {
                return $myarchive->subcategory_archive->name;
            })
            ->addColumn('ta', function ($myarchive) {
                return $myarchive->tahun_ajaran->tahun_ajaran;
            })
            ->addColumn('smt', function ($myarchive) {
                return $myarchive->semester->semester;
            })
            ->addColumn('aksi', function ($myarchive) {
                $path = asset("/file/archives/$myarchive->file");
                return '
                <a href="' . route('my-archive.show', $myarchive->id) . '" target="_blank" class="btn btn-info btn-flat"><i class="fa fa-search"></i></a>
                <a href="' . $path . '" class="btn btn-primary btn-flat" target="_blank"><i class="fa fa-download"></i></a>
                <a href="' . route('my-archive.edit', $myarchive->id) . '" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                <a href="' . route('my-archive.destroy', $myarchive->id) . '" class="btn btn-danger btn-flat" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
                ';
            })
            ->rawColumns(['select_all', 'a_name', 's_name', 'c_name', 'sa_name', 'ta', 'smt', 'aksi'])
            ->make(true);
    }

    public function createArchive()
    {
        $title = "Tambah Data Arsip";
        $section = Section::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $ta = TahunAjaran::get();
        $smt = Semester::get();

        return view('my-archive.create', compact('subcategory', 'ta', 'smt', 'category', 'section', 'title'));
    }

    public function storeArchive(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'file.*' => 'mimes:pdf,xls,xlxs,doc,docx,csv,jpg,jpeg,png',
            'section_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'semester_id' => 'required',
            'name' => 'required',
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
        $data = Archive::findOrFail($id);
        return view('my-archive.show', compact('data'));
    }

    public function editArchive($id)
    {
        $title = "Edit Data Arsip";
        $data = Archive::find($id);
        $section = Section::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        return view('my-archive.edit', compact('data', 'title', 'section', 'category', 'subcategory', 'ta', 'smt'));
    }

    public function updateArchive(Request $request, $id)
    {
        $archive = Archive::find($id);
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

    public function downloadSelected(Request $request)
    {
        foreach ($request->input('archive_id', []) as $id) {
            $archive = Archive::find($id);
            $archiveFile = 'file/archives/' . $archive->file;
            // return $archiveFile;
            return response()->download($archiveFile);
        }

        return redirect()->back();

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
