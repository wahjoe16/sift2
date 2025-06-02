<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title2 = "Delete Bidang!";
        $text = "Anda yakin akan menghapus bidang arsip?";
        confirmDelete($title2, $text);
        $title = "Tambah data bidang arsip";
        return view('section.index', compact('title'));
    }

    public function data()
    {
        $data = Section::get();
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '
                <a href="' . route('sections.edit', $data->id) . '" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                <a href="' . route('sections.destroy', $data->id) . '" class="btn btn-danger btn-xs" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
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
        $title = "Tambah data bidang arsip";
        return view('section.create', compact('title'));
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
        ]);

        Section::create($request->all());
        return redirect()->route('sections.index')->with('success', 'Bidang arsip sukses ditambah!');
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
        $title = "Edit data bidang arsip";
        $data = Section::find($id);
        return view('section.edit', compact('data', 'title'));
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
        $data = Section::find($id);
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:sections',
        ]);

        $data->update($request->all());
        return redirect()->route('sections.index')->with('success', 'Bidang arsip sukses diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Section::find($id)->delete();
        return redirect()->back()->with('success', 'Bidang arsip sukses dihapus!');
    }
}
