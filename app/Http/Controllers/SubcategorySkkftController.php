<?php

namespace App\Http\Controllers;

use App\Models\CategorySkkft;
use App\Models\PoinSkkft;
use App\Models\SubcategorySkkft;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Point;

class SubcategorySkkftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'indexSubcatSkkft');
        $title="Sub Kategori SKKFT";
        $subcategory_skkft=SubcategorySkkft::get();
        return view('subcategory_skkft.index', compact('title','subcategory_skkft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page', 'indexSubcatSkkft');
        $title="Tambah data sub kategori SKKFT";
        $category=CategorySkkft::get();
        return view('subcategory_skkft.create', compact('title', 'category'));
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
            'subcategory_name' =>'required',
            'category_id' =>'required'
        ]);

        SubcategorySkkft::create($request->all());
        return redirect()->route('subcategory-skkft.index')->with('success', 'Data Sub Kategori SKKFT berhasil ditambahkan!');
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
        Session::put('page', 'indexSubcatSkkft');
        $title="Edit data sub kategori SKKFT";
        $category=CategorySkkft::get();
        $subcategory_skkft = SubcategorySkkft::find($id);
        return view('subcategory_skkft.edit', compact('title','category','subcategory_skkft'));
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
            'subcategory_name'=>'required',
            'category_id'=>'required',
        ]);

        $subcategory_skkft = SubcategorySkkft::find($id);
        $subcategory_skkft->update($request->all());
        return redirect()->route('subcategory-skkft.index')->with('success', 'Sub Kategori SKKFT berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubcategorySkkft::find($id)->delete();
        return redirect()->back()->with('danger', 'Sub Kategori SKKFT berhasil dihapus!');
    }

    
}
