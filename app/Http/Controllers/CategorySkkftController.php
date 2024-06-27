<?php

namespace App\Http\Controllers;

use App\Models\CategorySkkft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategorySkkftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'indexCatSkkft');
        $title="Kategori SKKFT";
        $category_skkft=CategorySkkft::get();
        return view('category_skkft.index', compact('title','category_skkft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page', 'indexCatSkkft');
        $title="Tambah data kategori SKKFT";
        return view('category_skkft.create', compact('title'));
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
            'category_name'=>'required',
            'bobot'=>'required|numeric',
        ]);

        CategorySkkft::create($request->all());
        return redirect()->route('category-skkft.index')->with('success', 'Kategori SKKFT berhasil ditambahkan');
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
        Session::put('page', 'indexCatSkkft');
        $title="Edit data kategori SKKFT";
        $category_skkft = CategorySkkft::find($id);
        return view('category_skkft.edit', compact('title','category_skkft'));
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
        $this->validate($request, [
            'category_name'=>'required',
            'bobot'=>'required|numeric',
        ]);

        $category_skkft = CategorySkkft::find($id);
        $category_skkft->update($request->all());
        return redirect()->route('category-skkft.index')->with('success', 'Kategori SKKFT berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategorySkkft::find($id)->delete();
        return redirect()->back()->with('danger', 'Kategori SKKFT berhasil dihapus');
    }
}
