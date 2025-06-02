<?php

namespace App\Http\Controllers;

use App\Models\ProfesiAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfesiAlumniController extends Controller
{
    public function index()
    {
        $data = ProfesiAlumni::get();
        return view('profesi_alumni.index', compact('data'));
    }

    public function create()
    {
        return view('profesi_alumni.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_profesi' =>'required'
        ]);

        ProfesiAlumni::create($request->all());

        return redirect()->route('profesi-alumni.index')->with('success', 'Data profesi alumni berhasil ditambahkan!');
    }
}
