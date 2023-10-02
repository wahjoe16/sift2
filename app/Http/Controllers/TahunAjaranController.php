<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $title = 'Hapus Tahun Akademik!';
        $text = "Apakah anda yakin?";
        Session::put('page', 'indexTa');
        confirmDelete($title, $text);

        return view('tahun_ajaran.index');
    }

    public function data()
    {
        $data = TahunAjaran::get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="' . route('tahunajaran.edit', $data->id) . '" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></a>
                    <a href="' . route('tahunajaran.destroy', $data->id) . '" class="btn btn-xs btn-danger btn-flat" data-confirm-delete="true"><i class="fa fa-trash"></i></a>  
            ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $data  = new TahunAjaran();
        $data->tahun_ajaran = $request->tahun_ajaran;
        $data->save();

        return redirect()->route('tahunajaran.index')->with('success', 'Data tahun akademik berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = TahunAjaran::find($id);
        return view('tahun_ajaran.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TahunAjaran::find($id);
        $data->tahun_ajaran = $request->tahun_ajaran;
        $data->save();

        return redirect()->route('tahunajaran.index')->with('success', 'Data tahun akademik berhasil diubah!');
    }

    public function destroy($id)
    {
        $data = TahunAjaran::find($id);
        $data->delete();

        return redirect()->route('tahunajaran.index')->with('success', 'Data tahun akademik berhasil dihapus!');
    }
}
