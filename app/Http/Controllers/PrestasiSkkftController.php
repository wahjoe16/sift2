<?php

namespace App\Http\Controllers;

use App\Models\PrestasiSkkft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrestasiSkkftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'indexPrestasiSkkft');
        $title="Prestasi SKKFT";
        $prestasi_skkft=PrestasiSkkft::get();
        return view('prestasi_skkft.index', compact('title','prestasi_skkft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page', 'indexPrestasiSkkft');
        $title="Tambah data Prestasi SKKFT";
        return view('prestasi_skkft.create', compact('title'));
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
            'prestasi'=>'required',
        ]);

        PrestasiSkkft::create($request->all());
        return redirect()->route('prestasi-skkft.index')->with('success', 'Prestasi SKKFT berhasil ditambahkan');
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
        Session::put('page', 'indexPrestasiSkkft');
        $title="Edit data Prestasi SKKFT";
        $prestasi_skkft = PrestasiSkkft::find($id);
        return view('prestasi_skkft.edit', compact('title','prestasi_skkft'));
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
            'prestasi'=>'required',
        ]);

        $prestasi_skkft = PrestasiSkkft::find($id);
        $prestasi_skkft->update($request->all());
        return redirect()->route('prestasi-skkft.index')->with('success', 'Prestasi SKKFT berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PrestasiSkkft::find($id)->delete();
        return redirect()->back()->with('danger', 'Prestasi SKKFT berhasil dihapus!');
    }
}
