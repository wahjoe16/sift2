<?php

namespace App\Http\Controllers;

use App\Models\Posisi;
use App\Models\SubPosisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubPosisiPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'indexSubPosisi');
        $data = SubPosisi::all();
        return view('subposisi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Posisi::get();
        $title = "Tambah data sub posisi pekerjaan";
        return view('subposisi.create', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = ['nama_posisi' => 'required', 'nama_subposisi' => 'required'];
            $customMessage = ['nama_posisi.required' => 'Nama posisi tidak boleh kosong', 'nama_subposisi.required' => 'Nama Subposisi tidak boleh kosong'];
            $this->validate($request, $rules, $customMessage);

            SubPosisi::create([
                'posisi_id' => $request->nama_posisi,
                'nama_posisi' => $request->nama_subposisi,
            ]);

            return redirect()->route('subposisi-pekerjaan.index')->with(['success' => 'Data sub posisi berhasil ditambahkan']);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
