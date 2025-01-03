<?php

namespace App\Http\Controllers;

use App\Imports\AlumniImport;
use App\Models\Alumni;
use App\Models\JobsAlumni;
use App\Models\KeahlianAlumni;
use App\Models\MasukanAlumni;
use App\Models\MediaSosialAlumni;
use App\Models\ProfilLulusanAlumni;
use App\Models\SkillAlumni;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    public function index()
    {
        return view('alumni.index');
    }

    public function data()
    {
        $data = User::select('users.id', 'users.nama', 'users.email', 'alumni.alamat', 'alumni.no_hp')
        ->leftjoin('alumni', 'alumni.user_id', 'users.id')
        ->where([
            'level' => 3,
            'status_aktif' => 0
        ]);

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data){
                return '
                    <div class="btn-group">
                        <a href="'.route('alumni.show', $data->id).'" class="btn btn-sm btn-info"><i class="fa fa-search"></i></a>
                        <a href="'.route('alumni.edit', $data->id).'" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="'.route('alumni.destroy', $data->id).'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <a href="'.route('alumni.reset-password', $data->id).'" class="btn btn-sm btn-primary"><i class="fa fa-unlock-alt"></i></a>
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
        $data->program_studi = $request->program_studi;
        $data->email = $request->email;
        $data->telepon = $request->telepon;
        $data->password =  bcrypt($data->nik);
        $data->level = 3;
        $data->status_aktif = 0;
        $data->tahun_lulus = $request->tahun_lulus;
        $data->alamat_kerja = $request->alamat_kerja;
        $data->pekerjaan_sekarang = $request->pekerjaan_sekarang;
        $data->perusahaan_sekarang = $request->perusahaan_sekarang;
        $data->save();

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil disimpan!');
    }

    public function show($id)
    {
        $data = User::select(
            'users.id', 'users.nama', 'users.email', 'users.foto', 
            'alumni.alamat', 'alumni.no_hp', 'alumni.pekerjaan_sekarang', 'alumni.perusahaan_sekarang',
        )
        ->leftjoin('alumni', 'alumni.user_id', 'users.id')
        ->find($id);

        $dataPendidikan = ProfilLulusanAlumni::where('user_id', $id)->get();
        $dataPekerjaan = JobsAlumni::where('user_id', $id)->get();
        $dataKompetensi = SkillAlumni::where('user_id', $id)->get();
        $dataKeahlian = KeahlianAlumni::where('user_id', $id)->get();
        $dataMedsos = MediaSosialAlumni::where('user_id', $id)->first();
        // dd($dataMedsos);
        // $alumni = Alumni::where('user_id', $id)->first();
        return view('alumni.show', compact('data', 'dataPendidikan', 'dataPekerjaan', 'dataKompetensi', 'dataKeahlian', 'dataMedsos'));
    }

    public function indexMasukan()
    {
        $data = MasukanAlumni::get();
        return view('alumni.index_masukan', compact('data'));
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('alumni.edit', compact('data'));
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
        $data->tahun_lulus = $request->tahun_lulus;
        $data->alamat_kerja = $request->alamat_kerja;
        $data->pekerjaan_sekarang = $request->pekerjaan_sekarang;
        $data->perusahaan_sekarang = $request->perusahaan_sekarang;
        $data->save();

        return redirect()->route('alumni.index')->with('success', 'Data Alumni Berhasil Diubah');
    }

    public function importPageAlumni()
    {
        return view('alumni.import');
    }

    public function importAlumni()
    {
        $alumni = new AlumniImport();
        Excel::import($alumni, request()->file('file'));

        if ($alumni->failures()->isNotEmpty()) {
            return redirect()->route('alumni.index')->withFailures($alumni->failures());
        }

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diimport!');
    }

    /* ===
    public function resetPwd($id)
    {
        $data = User::find($id);
        $data->password = bcrypt($data->nik);
        $data->save();

        return redirect()->route('alumni.index')->with('success', 'Password alumni berhasil diubah!');
    }
    === */

    public function showEdit(Request $request)
    {
        $data = auth()->user();

        if($request->isMethod('POST')){

            $request->validate([
                'nama' => 'required',
                'program_studi' => 'required_if:level, 2, 3',
                'email' => 'required',
                'telepon' => 'required',
                'foto' => 'required|mimes:png,jpg',
                'alamat_kerja' => 'required',
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
                'alamat_kerja.required' => 'Alamat Kerja tidak boleh kosong',
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
            $data->alamat_kerja = $request->alamat_kerja;
            $data->tahun_lulus = $request->tahun_lulus;
            $data->pekerjaan_sekarang = $request->pekerjaan_sekarang;
            $data->perusahaan_sekarang = $request->perusahaan_sekarang;
            $data->save();

            return redirect()->route('alumni.show-edit')->with('success', 'Data alumni berhasil diubah!');
        }

        return view('alumni.show-edit', compact('data'));
    }
}
