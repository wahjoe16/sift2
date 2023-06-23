<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SemesterController extends Controller
{
    public function index()
    {
        $title = "Hapus data semester!";
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        return view('semester.index');
    }

    public function data()
    {
        $data = Semester::get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                    <div class="btn-group">
                        <a href="' . route('semester.edit', $data->id) . '" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></a>
                        <a href="' . route('semester.destroy', $data->id) . '" class="btn btn-xs btn-danger btn-flat" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
                    </div>
            ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $data  = new Semester();
        $data->semester = $request->semester;
        $data->save();

        return redirect()->route('semester.index')->with('success', 'Data semester berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = Semester::find($id);
        return view('semester.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Semester::find($id);
        $data->semester = $request->semester;
        $data->save();

        return redirect()->route('semester.index')->with('success', 'Data semester berhasil diubah!');
    }

    public function delete($id)
    {
        $data = Semester::find($id);
        $data->delete();

        return redirect()->route('semester.index')->with('success', 'Data semester berhasil dihapus!');
    }
}
