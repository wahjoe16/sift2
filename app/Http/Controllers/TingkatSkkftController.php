<?php

namespace App\Http\Controllers;

use App\Models\Tingkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TingkatSkkftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'indexTingkatSkkft');
        $title="Tingkat SKKFT";
        $tingkat_skkft=Tingkat::get();
        return view('tingkat_skkft.index', compact('title','tingkat_skkft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page', 'indexTingkatSkkft');
        $title="Tambah data Tingkat SKKFT";
        return view('tingkat_skkft.create', compact('title'));
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
            'tingkat'=>'required',
        ]);

        Tingkat::create($request->all());
        return redirect()->route('tingkat-skkft.index')->with('success', 'Tingkat SKKFT berhasil ditambahkan');
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
        Session::put('page', 'indexTingkatSkkft');
        $title="Edit data Tingkat SKKFT";
        $tingkat_skkft = Tingkat::find($id);
        return view('tingkat_skkft.edit', compact('title','tingkat_skkft'));
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
            'tingkat'=>'required',
        ]);

        $tingkat_skkft = Tingkat::find($id);
        $tingkat_skkft->update($request->all());
        return redirect()->route('tingkat-skkft.index')->with('success', 'Tingkat SKKFT berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tingkat::find($id)->delete();
        return redirect()->back()->with('danger', 'Tingkat SKKFT berhasil dihapus!');
    }
}
