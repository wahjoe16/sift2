<?php

namespace App\Http\Controllers;

use App\Models\CategoryArchive;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title2 = "Delete Kategori Arsip!";
        $text = "Anda yakin akan menghapus kategori arsip?";
        confirmDelete($title2, $text);
        $title = "Tambah data Kategori Arsip";
        return view('category_archive.index', compact('title'));
    }

    public function data()
    {
        $data = CategoryArchive::with('section_id')->get();
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '
                <a href="' . route('category-archive.edit', $data->id) . '" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                <a href="' . route('category-archive.destroy', $data->id) . '" class="btn btn-danger btn-xs" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
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
        $title = "Tambah Data";
        $section = Section::get();
        return view('category_archive.create', compact('title', 'section'));
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
            'name' => 'required|string|max:50|unique:sections',
            'section_id' => 'required'
        ]);

        CategoryArchive::create($request->all());
        return redirect()->route('category-archive.index')->with('success', 'Category archive has been successfull created!');
    }

    public function getDataCategory($id)
    {
        $data = CategoryArchive::where('section_id', $id)->pluck('name', 'id');
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
        $title = "Edit Data";
        $data = CategoryArchive::find($id);
        $section = Section::get();
        return view('category_archive.edit', compact('data', 'title', 'section'));
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
        $data = CategoryArchive::find($id);
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:sections',
            'section_id' => 'required'
        ]);

        $data->update($request->all());
        return redirect()->route('category-archive.index')->with('success', 'Category archive has been successfull updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryArchive::find($id)->delete();
        return redirect()->back()->with('success', 'Category archive successfully deleted!');
    }
}
