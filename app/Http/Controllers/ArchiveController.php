<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\MyArchive;
use App\Models\CategoryArchive;
use App\Models\Section;
use App\Models\Semester;
use App\Models\SubcategoryArchive;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $title2 = "Delete Arsip!";
        $text = "Anda yakin akan menghapus arsip?";
        confirmDelete($title2, $text);
        $title = "Tambah data Arsip";
        return view('archive.index', compact('title', 'ta', 'smt', 'category', 'subcategory'));
    }

    public function data()
    {
        $data = Archive::with([
            'section',
            'category_archive',
            'subcategory_archive',
            'tahun_ajaran',
            'semester',
            'user_upload'
        ])->orderBy('id', 'desc');

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
            ->addColumn('action', function ($data) {
                $path = asset("/file/archives/$data->file");
                return '
                <a href="' . route('ft-arsip.show', $data->id) . '" target="_blank" class="btn btn-info btn-xs"><i class="fas fa-search"></i></a>
                <a href="' . route('ft-arsip.download', $data->id) . '" class="btn btn-primary btn-xs"><i class="fas fa-download"></i></a>
                <a href="' . route('ft-arsip.edit', $data->id) . '" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                <a href="' . route('ft-arsip.destroy', $data->id) . '" class="btn btn-danger btn-xs" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
            ';
            })
            ->rawColumns(['action', 'file'])
            ->make(true);
    }

    public function indexGeneral()
    {
        // $arsip = Archive::orderBy('section_id')->doesntHave('users');
        // dd($arsip);
        $ta = TahunAjaran::orderBy('tahun_ajaran')->get();
        $smt = Semester::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $title2 = "Delete Arsip!";
        $text = "Anda yakin akan menghapus arsip?";
        confirmDelete($title2, $text);

        Session::put('page', 'generalArsip');
        return view('archive.general', compact('ta', 'smt', 'category', 'subcategory'));
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
            ->addColumn('action', function ($data) {
                $path = asset("/file/archives/$data->file");
                return '
                <a href="' . route('ft-arsip.show', $data->id) . '" target="_blank" class="btn btn-info btn-xs"><i class="fas fa-search"></i></a>
                <a href="' . route('ft-arsip.download', $data->id) . '" class="btn btn-primary btn-xs"><i class="fas fa-download"></i></a>
                <a href="' . route('ft-arsip.edit', $data->id) . '" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                <a href="' . route('ft-arsip.destroy', $data->id) . '" class="btn btn-danger btn-xs" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah data arsip";
        $section = Section::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        $dosenTmb = User::where(['level' => 2, 'program_studi' => 'Teknik Pertambangan'])->get();
        $dosenTi = User::where(['level' => 2, 'program_studi' => 'Teknik Industri'])->get();
        $dosenPwk = User::where(['level' => 2, 'program_studi' => 'Perencanaan Wilayah dan Kota'])->get();
        $dosenPsppi = User::where(['level' => 2, 'program_studi' => 'Program Profesi Insinyur'])->get();
        $dosenMpwk = User::where(['level' => 2, 'program_studi' => 'Magister Perencanaan Wilayah dan Kota'])->get();
        return view('archive.create', compact('title', 'section', 'category', 'subcategory', 'ta', 'smt', 'dosenTmb', 'dosenTi', 'dosenPwk', 'dosenPsppi', 'dosenMpwk'));
    }

    public function saveFile(UploadedFile $file)
    {
        $fileName = 'file_' . date('d-m-YHis') . '_' . $file->getClientOriginalName();
        $path = 'file/archives';
        $file->move($path, $fileName);
        return $fileName;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
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
            'name.max' => 'Nama arsip tidak boleh lebih dari 255 karakter',
        ]);

        // dd($request->all());

        // foreach ($request->file as $file) {
        //     $fileName = 'file_' . date('d-m-YHis') . '_' . $file->getClientOriginalName();
        //     $path = 'file/archives';
        //     $file->move($path, $fileName);
        //     $data = new Archive();
        //     $data->name = $request->name;
        //     $data->section_id = $request->section_id;
        //     $data->category_archive_id = $request->category_archive_id;
        //     $data->subcategory_archive_id = $request->subcategory_archive_id;
        //     $data->tahun_ajaran_id = $request->tahun_ajaran_id;
        //     $data->semester_id = $request->semester_id;
        //     $data->file = $fileName;
        //     $data->save();
        // }

        // $data = $request->only('name', 'section_id', 'category_archive_id', 'subcategory_archive_id', 'tahun_ajaran_id', 'semester_id');

        if ($request->hasFile('file')) {
            $data['file'] = $this->saveFile($request->file('file'));
        }

        $archive = Archive::create([
            'name' => $request['name'],
            'user_upload' => auth()->user()->id,
            'section_id' => $request['section_id'],
            'category_archive_id' => $request['category_archive_id'],
            'subcategory_archive_id' => $request['subcategory_archive_id'],
            'tahun_ajaran_id' => $request['tahun_ajaran_id'],
            'semester_id' => $request['semester_id'],
            'file' => $data['file'],
        ]);
        
        $archive->users()->sync($request['dosen_id']);
        
        return redirect()->route('ft-arsip.index')->with('success', 'Archive has been successfull created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Archive::with('users')->findOrFail($id);
        return view('archive.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Data Arsip";
        $data = Archive::find($id);
        $userArchive = MyArchive::where('archive_id', $id)->pluck('user_id')->toArray();
        // dd($userArchive);
        $userData = $data->users;
        // dd($userData);
        $section = Section::get();
        $category = CategoryArchive::get();
        $subcategory = SubcategoryArchive::get();
        $ta = TahunAjaran::get();
        $smt = Semester::get();
        $dosenTmb = User::where(['level' => 2, 'program_studi' => 'Teknik Pertambangan'])->get();
        $dosenTi = User::where(['level' => 2, 'program_studi' => 'Teknik Industri'])->get();
        $dosenPwk = User::where(['level' => 2, 'program_studi' => 'Perencanaan Wilayah dan Kota'])->get();
        $dosenPsppi = User::where(['level' => 2, 'program_studi' => 'Program Profesi Insinyur'])->get();
        $dosenMpwk = User::where(['level' => 2, 'program_studi' => 'Magister Perencanaan Wilayah dan Kota'])->get();
        return view('archive.edit', compact('data', 'userData', 'userArchive', 'title', 'section', 'category', 'subcategory', 'ta', 'smt', 'dosenTmb', 'dosenTi', 'dosenPwk', 'dosenPsppi', 'dosenMpwk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $archive = Archive::find($id);
        $this->validate($request, [
            'file.*' => 'mimes:pdf,xls,xlxs,doc,docx,csv,jpg,jpeg,png',
            'section_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'semester_id' => 'required',
            'name' => 'required'
        ]);

        // $data = $request->only('name', 'section_id', 'category_archive_id', 'subcategory_archive_id', 'tahun_ajaran_id', 'semester_id');

        if ($request->hasFile('file')) {
            $data['file'] = $this->saveFile($request->file('file'));
            if ($archive->file !== '') $this->deleteFile($archive->file);
        }

        $archive->update([
            'name' => $request['name'],
            'user_upload' => auth()->user()->id,
            'section_id' => $request['section_id'],
            'category_archive_id' => $request['category_archive_id'],
            'subcategory_archive_id' => $request['subcategory_archive_id'],
            'tahun_ajaran_id' => $request['tahun_ajaran_id'],
            'semester_id' => $request['semester_id'],
            'file' => $data['file'] ?? $request->current_file,
        ]);
        
        $archive->users()->sync($request['dosen_id']);
        return redirect()->route('ft-arsip.index')->with('success', 'File archive has been successfull updated!');
    }

    public function deleteFile($fileArsip)
    {
        $path = 'file/archives/' . $fileArsip;
        return File::delete($path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Archive::find($id);
        if ($data->file !== '') $this->deleteFile($data->file);
        $data->delete();
        return redirect()->back()->with('success', 'File Archive successfully deleted!');
    }

    public function downloadFile($id)
    {
        $data = Archive::findOrFail($id);
        $filePath = 'file/archives/' . $data->file;
        return Response::download($filePath);
    }
}
