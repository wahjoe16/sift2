<?php

namespace App\Http\Controllers;

use App\Models\CategorySkkft;
use App\Models\Jabatan;
use App\Models\PoinSkkft;
use App\Models\PrestasiSkkft;
use App\Models\SubcategorySkkft;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PointSkkftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'indexPoinSkkft');
        $title="Poin SKKFT";
        $poin_skkft=PoinSkkft::get();
        return view('poin_skkft.index', compact('title','poin_skkft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page', 'indexPoinSkkft');
        $title="Tambah data Poin SKKFT";
        $category=CategorySkkft::get();
        $subcategory=SubcategorySkkft::get();
        $tingkat=Tingkat::get();
        $prestasi=PrestasiSkkft::get();
        $jabatan=Jabatan::get();
        return view('poin_skkft.create', compact('title', 'category', 'subcategory', 'tingkat', 'prestasi', 'jabatan'));
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
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'point'=>'required'
        ], [
            'category_id.required' => 'Kategori SKKFT Tidak Boleh Kosong',
            'subcategory_id.required' => 'Sub Kateggori SKKFT Tidak Boleh Kosong',
            'point.required' => 'Poin Tidak Boleh Kosong',
        ]);
        
        PoinSkkft::create($request->all());
        return redirect()->route('poin-skkft.index')->with('success', 'Poin SKKFT berhasil ditambahkan');
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
        Session::put('page', 'indexPoinSkkft');
        $title="Edit data Poin SKKFT";
        $category=CategorySkkft::get();
        $subcategory=SubcategorySkkft::get();
        $tingkat=Tingkat::get();
        $prestasi=PrestasiSkkft::get();
        $jabatan=Jabatan::get();
        $point=PoinSkkft::find($id);
        return view('poin_skkft.edit', compact('title', 'category', 'subcategory', 'tingkat', 'prestasi', 'jabatan', 'point'));
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
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'point'=>'required'
        ], [
            'category_id.required' => 'Kategori SKKFT Tidak Boleh Kosong',
            'subcategory_id.required' => 'Sub Kateggori SKKFT Tidak Boleh Kosong',
            'point.required' => 'Poin Tidak Boleh Kosong',
        ]);

        $point = PoinSkkft::find($id);
        $point->update($request->all());
        return redirect()->route('poin-skkft.index')->with('success', 'Poin SKKFT berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PoinSkkft::find($id)->delete();
        return redirect()->back()->with('danger', 'Poin SKKFT berhasil dihapus!');
    }
}
