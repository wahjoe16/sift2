<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        return view('alumni.index');
    }

    public function data()
    {
        $data = User::where([
            'level' => 3,
            'status_aktif' => 0
        ]);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data){
                return '
                    <div class="btn-group">
                        <a href="'.route('alumni.show', $data->id).'" class="btn btn-flat btn-info"><i class="fa fa-search"></i></a>
                        <a href="'.route('alumni.edit', $data->id).'" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="'.route('alumni.destroy', $data->id).'" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('alumni.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' =>'required',
            'nik' =>'required|unique:users',
            'program_studi' =>'required',
            'tahun_lulus' =>'required',
        ]);

        $data = new User();
        $data->nama = $request->nama;
        $data->nik = $request->nik;
        $data->email = $request->email;
        $data->password =  bcrypt($data->nik);
        $data->level = 3;
        $data->status_aktif = 0;
        $data->save();

        $alumni = new Alumni();
        $alumni->user_id = $data->id;
        $alumni->tahun_lulus = $request->tahun_lulus;
        $alumni->alamat = $request->alamat;
        $alumni->pekerjaan_sekarang = $request->pekerjaan_sekarang;
        $alumni->perusahaan_sekarang = $request->perusahaan_sekarang;
        $alumni->save();

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil disimpan!');
    }

    public function show($id)
    {
        $data = User::find($id);
        $alumni = Alumni::where('user_id', $id)->first();
        return view('alumni.show', compact('data', 'alumni'));
    }

    public function edit($id)
    {
        $data = User::find($id);
        $alumni = Alumni::where('user_id', $id)->first();
        return view('alumni.edit', compact('data', 'alumni'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' =>'required',
            'nik' =>'required',
            'program_studi' =>'required',
            'tahun_lulus' =>'required',
        ]);

        $data = User::find($id);
        $data->nama = $request->nama;
        $data->nik = $request->nik;
        $data->program_studi = $request->program_studi;
        $data->email = $request->email;
        $data->telepon = $request->telepon;
        $data->save();

        $alumni = Alumni::where('user_id', $id)->first();
        $alumni->tahun_lulus = $request->tahun_lulus;
        $alumni->alamat = $request->alamat;
        $alumni->pekerjaan_sekarang = $request->pekerjaan_sekarang;
        $alumni->perusahaan_sekarang = $request->perusahaan_sekarang;
        $alumni->save();

        return redirect()->route('alumni.index')->with('success', 'Data Alumni Berhasil Diubah');
    }

    public function resetPwd($id)
    {
        $data = User::find($id);
        $data->password = bcrypt($data->nik);
        $data->save();

        return redirect()->route('alumni.index')->with('success', 'Password alumni berhasil diubah!');
    }

    public function showEdit(Request $request)
    {
        $data = auth()->user();
        $alumni = Alumni::where('user_id', $data->id)->first();

        if($request->isMethod('POST')){

            $request->validate([
                'nama' => 'required',
                'program_studi' => 'required_if:level, 2, 3',
                'email' => 'required',
                'telepon' => 'required',
                'foto' => 'required|mimes:png,jpg',
                'alamat' => 'required',
                'tahun_lulus' => 'required',
                'pekerjaan_sekarang' => 'required',
                'perusahaan_sekarang' => 'required'
            ],[
                'nama.required' => 'Nama tidak boleh kosong',
                'program_studi.required' => 'Program Studi tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'telepon.required' => 'Telepon tidak boleh kosong',
                'foto.required' => 'Foto tidak boleh kosong',
                'foto.mimes' => 'Foto harus mempunyai format jpg atau png',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'tahun_lulus.required' => 'Program Studi tidak boleh kosong',
                'pekerjaan_sekarang.required' => 'Pekerjaan Sekarang tidak boleh kosong',
                'perusahaan_sekarang.required' => 'Perusahaan Sekarang tidak boleh kosong',
            ]);

            // update foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');

                if ($file->isValid()) {
                    $nama = 'user-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('/user/foto'), $nama);
                    $data->foto = $nama;
                } else if (!empty($request['current_user_foto'])) {
                    $nama = $request['current_user_foto'];
                } else {
                    $nama = '';
                }
            }

            $data->nama = $request->nama;
            $data->email = $request->email;
            $data->telepon = $request->telepon;
            $data->nik = $request->nik;
            $data->program_studi = $request->program_studi;
            $data->save();

            $alumni->alamat = $request->alamat;
            $alumni->tahun_lulus = $request->tahun_lulus;
            $alumni->pekerjaan_sekarang = $request->pekerjaan_sekarang;
            $alumni->perusahaan_sekarang = $request->perusahaan_sekarang;
            $alumni->save();

            return redirect()->route('alumni.show-edit')->with('success', 'Data alumni berhasil diubah!');
        }

        return view('alumni.show-edit', compact('data', 'alumni'));
    }
}
