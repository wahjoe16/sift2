<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JabatanSkkftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="Jabatan SKKFT";
        $jabatan_skkft=Jabatan::get();
        return view('jabatan_skkft.index', compact('title','jabatan_skkft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Tambah data Jabatan SKKFT";
        return view('jabatan_skkft.create', compact('title'));
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
            'jabatan'=>'required',
        ]);

        Jabatan::create($request->all());
        return redirect()->route('jabatan-skkft.index')->with('success', 'Jabatan SKKFT berhasil ditambahkan');
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
        $title="Edit data Jabatan SKKFT";
        $jabatan_skkft = Jabatan::find($id);
        return view('jabatan_skkft.edit', compact('title','jabatan_skkft'));
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
            'jabatan'=>'required',
        ]);

        $jabatan_skkft = Jabatan::find($id);
        $jabatan_skkft->update($request->all());
        return redirect()->route('jabatan-skkft.index')->with('success', 'Jabatan SKKFT berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jabatan::find($id)->delete();
        return redirect()->back()->with('danger', 'Jabatan SKKFT berhasil dihapus!');
    }
}
