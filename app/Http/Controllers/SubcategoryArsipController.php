<?php

namespace App\Http\Controllers;

use App\Models\CategoryArchive;
use App\Models\Section;
use App\Models\SubcategoryArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubcategoryArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title2 = "Delete Sub Kategori Arsip!";
        $text = "Anda yakin akan menghapus sub kategori arsip?";
        confirmDelete($title2, $text);
        $title = "Tambah Data Sub Kategori Arsip";
        Session::put('page', 'indexSubCatArsip');
        return view('subcategory_archive.index', compact('title'));
    }

    public function data()
    {
        $data = SubcategoryArchive::with('section_id')->with('category_archive_id');
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '
                <a href="' . route('sub-category-archive.edit', $data->id) . '" class="btn btn-warning btn-flat btn-xs"><i class="fa fa-edit"></i></a>
                <a href="' . route('sub-category-archive.destroy', $data->id) . '" class="btn btn-danger btn-flat btn-xs" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
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
        $title = "Tambah data sub kategori arsip";
        $section = Section::get();
        $category = CategoryArchive::get();
        return view('subcategory_archive.create', compact('title', 'section', 'category'));
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
            'name' => 'required|string|max:255|unique:sections',
            'section_id' => 'required',
            'category_archive_id' => 'required',
        ]);

        SubcategoryArchive::create($request->all());
        return redirect()->route('sub-category-archive.index')->with('success', 'Sub Category archive has been successfull created!');
    }

    public function getDataSubcategory($id)
    {
        $data = SubcategoryArchive::where('category_archive_id', $id)->pluck('name', 'id');
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit data kategori arsip";
        $data = SubcategoryArchive::find($id);
        $section = Section::get();
        $category = CategoryArchive::get();
        return view('subcategory_archive.edit', compact('data', 'title', 'section', 'category'));
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
        $data = SubcategoryArchive::find($id);
        $this->validate($request, [
            'name' => 'required|string|max:150|unique:sections',
            'section_id' => 'required',
            'category_archive_id' => 'required'
        ]);

        $data->update($request->all());
        return redirect()->route('sub-category-archive.index')->with('success', 'Sub Category archive has been successfull updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubcategoryArchive::find($id)->delete();
        return redirect()->back()->with('success', 'Sub Category archive successfully deleted!');
    }
}
