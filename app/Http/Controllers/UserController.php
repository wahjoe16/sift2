<?php

namespace App\Http\Controllers;

use App\Imports\DosenImport;
use App\Imports\MahasiswaImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function profile()
    {
        $data = auth()->user();
        return view('profile.index', compact('data'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama' => 'required',
            'program_studi' => 'required_if:level, 3',
            'email' => 'required',
            'telepon' => 'required',
            'foto' => 'mimes:png,jpg',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'program_studi.required' => 'Program Studi tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'telepon.required' => 'Telepon tidak boleh kosong',
            // 'foto.required' => 'Foto tidak boleh kosong',
            'foto.mimes' => 'Foto harus mempunyai format jpg atau png'
        ]);

        // update foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // if (!is_null($file)) {
            //     File::delete(public_path('/user/foto/'. $user->foto));
            //     $nama = 'user-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('/user/foto'), $nama);
            //     $user->foto = $nama;
            // } else if (empty($file)) {
            //     $user->foto = $request->current_user_foto;
            // } else {
            //     $user->foto = '';
            // }

            if (!is_null($file)) {
                File::delete(public_path('/user/foto/'. $user->foto));
                $nama = 'user-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/user/foto'), $nama);
            }
        }

        // $user->update([
        //     'nama' => $request->nama,
        //     'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'email' => $request->email,
        //     'telepon' => $request->telepon,
        //     'program_studi' => $request->program_studi,
        //     'tipe_dosen' => $request->tipe_dosen,
        //     'jabatan' => $request->jabatan,
        //     'foto' => $nama ?? $request->current_user_foto
        // ]);

        $user->nama = $request->nama;
        $user->tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
        $user->tempat_lahir = $request->tempat_lahir;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        $user->program_studi = $request->program_studi;
        $user->tipe_dosen = $request->tipe_dosen;
        $user->jabatan = $request->jabatan;
        $user->foto = $nama ?? $request->current_user_foto;

        $user->save();
        return redirect()->back()->with('success', 'Profil berhasil diubah!','success');
    }

    public function password()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        // update password
        if ($request->has('password') && $request->password != "") {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = bcrypt($request->password);
                } else {
                    return redirect()->back()->with('error_message', 'Konfirmasi password tidak sesuai!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Password lama anda salah!');
            }
            $user->save();
            return redirect()->route('dashboard')->with('success', 'Password user berhasil diubah!');
        }
    }

    public function indexAdmin()
    {
        Session::put('page', 'indexAdmin');
        $title = "Hapus data admin!";
        $text = "Apakah anda Yakin?";
        confirmDelete($title, $text);
        return view('admin.index');
    }

    public function dataAdmin()
    {
        $admin = User::where('level', 1)->get();

        return datatables()
            ->of($admin)
            ->addIndexColumn()
            ->addColumn('select_all', function ($admin) {
                return '<input type="checkbox" name="id[]" value="' . $admin->id . '" />';
            })
            ->addColumn('foto', function ($admin) {
                $path = asset("/user/foto/$admin->foto");
                return '
                    <div class="avatar-lg text-center">
                        <img src=' . $path . ' class="avatar-img rounded-circle" />
                    </div>
                ';
            })
            ->addColumn('status_superadmin', function ($admin) {
                if ($admin->status_superadmin == 1) {
                    $status = 'Ya';
                } else
                    $status = 'Tidak';
                return '<span>' . $status . '</span>';
            })
            ->editColumn('aksi', function ($admin) {
                return '
                    <a href="' . route('admin.edit', $admin->id) . '" class="btn btn-xs btn-warning"><i class="fas fa-pen"></i></a>
                    <a href="' . route('admin.destroy', $admin->id) . '" class="btn btn-xs btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['aksi', 'select_all', 'foto', 'status_superadmin'])
            ->make(true);
    }

    public function storeAdmin(Request $request)
    {
        $admin = new User();
        $data = $request->all();

        $admin->nik = $data['nik'];
        $admin->nama = $data['nama'];
        $admin->email = $data['email'];
        $admin->telepon = $data['telepon'];
        $admin->program_studi = $data['program_studi'];
        $admin->level = 1;
        $admin->status_superadmin = $data['status_superadmin'];
        $admin->password = bcrypt($admin->nik);

        $admin->save();
        return redirect()->back()->with('success', 'Data admin berhasil disimpan!');
    }

    public function showAdmin($id)
    {
        $admin = User::find($id);
        return response()->json($admin);
    }

    public function editAdmin($id)
    {
        $admin = User::find($id);
        return view('admin.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::find($id);
        $data = $request->all();

        $admin->nik = $data['nik'];
        $admin->nama = $data['nama'];
        $admin->email = $data['email'];
        $admin->telepon = $data['telepon'];
        $admin->program_studi = $data['program_studi'];
        $admin->level = 1;
        $admin->status_superadmin = $data['status_superadmin'];
        $admin->password = bcrypt($admin->nik);

        $admin->save();
        return redirect()->route('admin.index')->with('success', 'Data admin berhasil diubah!');
    }

    public function deleteAdmin($id)
    {
        $admin = User::find($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Data admin berhasil dihapus!');
    }

    public function deleteSelectedAdmin(Request $request)
    {
        foreach ($request->id as $id) {
            $admin = User::find($id);
            $admin->delete();
        }

        return redirect()->back()->with('success', 'Data admin berhasil dihapus!');
    }

    public function indexMahasiswa()
    {
        // $title = "Hapus data mahasiswa?";
        // $text = "Apakah anda yakin?";
        // confirmDelete($title, $text);
        Session::put('page', 'indexMhs');
        return view('mahasiswa.index');
    }

    public function dataMahasiswa()
    {
        $mahasiswa = User::where('level', 3)->get();
        return datatables()
            ->of($mahasiswa)
            ->addColumn('select_all', function ($mahasiswa) {
                return '<input type="checkbox" name="id[]" value="' . $mahasiswa->id . '" />';
            })
            ->addColumn('foto', function ($mahasiswa) {
                $path = asset("/user/foto/$mahasiswa->foto");
                return '
                    <div class="avatar-lg text-center">
                        <img src=' . $path . ' class="avatar-img rounded-circle" />
                    </div>
                ';
            })
            ->addColumn('aksi', function ($mahasiswa) {
                return '
                    <a href="' . route('dashboardMahasiswa.show', $mahasiswa->id) . '" class="btn btn-xs btn-info"><i class="fas fa-search"></i></a>
                    <a href="' . route('mahasiswa.edit', $mahasiswa->id) . '" class="btn btn-xs btn-warning"><i class="fas fa-pen"></i></a>
                    <a href="' . route('mahasiswa.destroy', $mahasiswa->id) . '" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['aksi', 'select_all', 'foto'])
            ->make(true);
    }

    public function storeMahasiswa(Request $request)
    {
        $mahasiswa = new User();
        $data = $request->all();

        $mahasiswa->nik = $data['nik'];
        $mahasiswa->nama = $data['nama'];
        $mahasiswa->email = $data['email'];
        $mahasiswa->telepon = $data['telepon'];
        $mahasiswa->level = 3;
        $mahasiswa->password = bcrypt($mahasiswa['nik']);
        $mahasiswa->program_studi = $data['program_studi'];

        $mahasiswa->save();
        return redirect()->back()->with('success_message', 'Data mahasiswa berhasil disimpan!');
    }

    public function importPageMhs()
    {
        return view('mahasiswa.import');
    }

    public function importMhs()
    {
        $mahasiswa = new MahasiswaImport();
        Excel::import($mahasiswa, request()->file('file'));

        if ($mahasiswa->failures()->isNotEmpty()) {
            return redirect()->route('mahasiswa.index')->withFailures($mahasiswa->failures());
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diimport!');
    }

    public function editMahasiswa($id)
    {
        $mahasiswa = User::find($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $mahasiswa = User::find($id);
        $mahasiswa->nik = $request->nik;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->program_studi = $request->program_studi;
        $mahasiswa->email = $request->email;
        $mahasiswa->telepon = $request->telepon;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diubah!');
    }

    public function deleteMahasiswa($id)
    {
        $mahasiswa = User::find($id);
        File::delete('/user/foto', $mahasiswa->foto);
        // dd($mahasiswa);
        $mahasiswa->delete();
        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus!');
    }

    public function deleteSelectedMahasiswa(Request $request)
    {
        foreach ($request->id as $id) {
            $dosen = User::find($id);
            $dosen->delete();
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }

    public function indexDosen()
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('dosen.index');
    }

    public function dataDosen()
    {
        $dosen = User::where('level', 2)->orderBy('nik', 'asc')->get();

        return datatables()
            ->of($dosen)
            ->addColumn('select_all', function ($dosen) {
                return '<input type="checkbox" name="id[]" value="' . $dosen->id . '" />';
            })
            ->addColumn('foto', function ($dosen) {
                $path = asset("/user/foto/$dosen->foto");
                return '
                    <div class="avatar-lg text-center">
                        <img src=' . $path . ' class="avatar-img rounded-circle" />
                    </div>
                ';
            })
            ->addColumn('aksi', function ($dosen) {
                return '
                    <a href="' . route('dashboardDosen.show', $dosen->id) . '" class="btn btn-xs btn-info btn-flat"><i class="fas fa-search"></i></a>
                    <a href="' . route('dosen.edit', $dosen->id) . '" class="btn btn-xs btn-warning btn-flat"><i class="fas fa-pen"></i></a>
                    <a href="' . route('dosen.destroy', $dosen->id) . '" class="btn btn-xs btn-danger btn-flat" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
                ';
            })
            ->rawColumns(['aksi', 'select_all', 'foto'])
            ->make(true);
    }

    public function storeDosen(Request $request)
    {
        $admin = new User();
        $data = $request->all();

        $admin->nik = $data['nik'];
        $admin->nama = $data['nama'];
        $admin->program_studi = $request->program_studi;
        $admin->email = $data['email'];
        $admin->telepon = $data['telepon'];
        $admin->level = 2;
        $admin->password = bcrypt($admin->nik);

        $admin->save();
        return redirect()->route('dosen.index')->with('success_message', 'Data dosen berhasil disimpan!');
    }

    public function editdosen($id)
    {
        $dosen = User::find($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function updatedosen(Request $request, $id)
    {
        $dosen = User::find($id);
        $dosen->nik = $request->nik;
        $dosen->nama = $request->nama;
        $dosen->program_studi = $request->program_studi;
        $dosen->email = $request->email;
        $dosen->telepon = $request->telepon;
        $dosen->status_koordinator_skripsi = $request->status_koordinator_skripsi;
        $dosen->status_kaprodi = $request->status_kaprodi;
        $dosen->status_sekprodi = $request->status_sekprodi;
        $dosen->status_dekanat = $request->status_dekanat;
        $dosen->class_pendidikan = $request->class_pendidikan;
        $dosen->class_jabfung = $request->class_jabfung;
        $dosen->kelompok_keahlian = $request->kelompok_keahlian;
        $dosen->save();

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diubah!');
    }

    public function editAllDosen()
    {
        $dosen = User::where('level', 2)->get();
        // echo "<pre>"; print_r($dosen); die;
        return view('dosen.edit_all', compact('dosen'));
    }

    // public function editDataDosen()
    // {
    //     $dosen = User::where('level', 2)->orderBy('program_studi', 'desc')->get();

    //     return datatables()
    //     ->of($dosen)
    //     ->addIndexColumn()
    //     ->addColumn('class_pendidikan', function(){
    //         $options ='';
    //         foreach(["S2"=>"S2", "S3"=>"S3"] as $pendidikan => $pendidikanLabel){
    //             $options .= '<option value="' . $pendidikan . '")>' . $pendidikanLabel . '</option>';
    //         }

    //         $return = '
    //             <select name="class_pendidikan[]" id="class_pendidikan" class="form-control">
    //                 <option value="">Select</option>
    //                 '.$options.'
    //             </select>
    //         ';
    //         return $return ;
    //     })
    //     ->addColumn('class_jabfung', function(){
    //         $options='';
    //         foreach([
    //             "Asisten Ahli"=>"Asisten Ahli", 
    //             "Lektor"=>"Lektor", 
    //             "Lektor Kepala"=>"Lektor Kepala", 
    //             "Guru Besar/Professor"=>"Guru Besar/Professor"
    //             ] as $jabfung=>$jabfungLabel){
    //                 $options .= '<option value="' . $jabfung . '">' . $jabfungLabel . '</option>';
    //         }

    //         $return = '
    //             <select name="class_jabfung[]" id="class_Jabfung" class="form-control">
    //                 <option value="">Select</option>
    //                 '.$options.'
    //             </select>
    //         ';
    //         return $return;
    //     })
    //     ->addColumn('kelompok_keahlian', function(){
    //         $optionsTambang='';
    //         foreach([
    //             "Geologi Eksplorasi"=>"Geologi Eksplorasi", 
    //             "Tambang Umum"=>"Tambang Umum", 
    //             "Pengolahan Bahan Galian"=>"Pengolahan Bahan Galian"
    //             ] as $kelompok_keahlian_tmb=>$kelompok_keahlian_tmbLabel){
    //                 $optionsTambang .= '<option value="' . $kelompok_keahlian_tmb . '">' . $kelompok_keahlian_tmbLabel . '</option>';
    //         }

    //         $optionsTi='';
    //         foreach([
    //             "Keahlian Ergonomi dan Rekayasa Kerja"=>"Keahlian Ergonomi dan Rekayasa Kerja", 
    //             "Manajemen Industri"=>"Manajemen Industri", 
    //             "Sistem Industri dan Tekno-Ekonomi"=>"Sistem Industri dan Tekno-Ekonomi",
    //             "Sistem Manufaktur"=>"Sistem Manufaktur"
    //             ] as $kelompok_keahlian_ti=>$kelompok_keahlian_tiLabel){
    //                 $optionsTi .= '<option value="' . $kelompok_keahlian_ti . '">' . $kelompok_keahlian_tiLabel . '</option>';
    //         }

    //         $optionsPwk='';
    //         foreach([
    //             "Kota"=>"Kota", 
    //             "Transportasi"=>"Transportasi", 
    //             "Lingkungan"=>"Lingkungan",
    //             "Pariwisata"=>"Pariwisata",
    //             "Rekayasa Pedesaan"=>"Rekayasa Pedesaan"
    //             ] as $kelompok_keahlian_pwk=>$kelompok_keahlian_pwkLabel){
    //                 $optionsPwk .= '<option value="' . $kelompok_keahlian_pwk . '">' . $kelompok_keahlian_pwkLabel . '</option>';
    //         }

    //         $return = '
    //             <select name="kelompok_keahlian[]" id="kelompok_keahlian" class="form-control">
    //                 <option value="">Select</option>
    //                 <optgroup label="Teknik Pertambangan">
    //                 '.$optionsTambang.'
    //                 </optgroup>
    //                 <optgroup label="Teknik Industri">
    //                 '.$optionsTi.'
    //                 </optgroup>
    //                 <optgroup label="Perencanaan Wilayah dan Kota">
    //                 '.$optionsPwk.'
    //                 </optgroup>
    //             </select>
    //         ';

    //         return $return;
    //     })
    //     ->rawColumns(['class_pendidikan','class_jabfung','kelompok_keahlian'])
    //     ->make(true);
    // }

    public function updateAllDosen(Request $request)
    {
        // $dosen = User::where('level', 2)->get();
        // // dd($dosen);
        // foreach($dosen as $d){
        //     $d->class_pendidikan = $request->class_pendidikan;
        //     $d->class_jabfung = $request->class_jabfung;
        //     $d->kelompok_keahlian = $request->kelompok_keahlian;
        //     // dd($d);
        //     $d->save();
        // }
        
        // $dataDosen = array();

        // foreach($request->dosen_id as $id){
        //     $dosen = User::find($id);
        //     $dataDosen[] = $dosen;
        // }
       
        // $data=[];
        // $error = 1;

        // for ($i=0; $i < count($request->get('dosen_id')) ; $i++) { 
        //     $dosenId = 0;

        //     if (!empty($request->get('dosen_id')[$i])) {
        //         $dosenId=$request->get('dosen_id')[$i];
        //     }

        //     $data[]=[
        //         'class_pendidikan'=>$request->get('class_pendidikan')[$i],
        //         'class_jabfung'=>$request->get('class_jabfung')[$i],
        //         'kelompok_keahlian'=>$request->get('kelompok_keahlian')[$i]
        //     ];
        // }

        // dd($data);

        // if (count($data) > 0) {
        //     $error='';
        // }

        // User::upsert($data, ['class_pendidikan', 'class_jabfung', 'kelompok_keahlian']);
        User::whereIn('id', $request->dosen_id)->update([
            'class_pendidikan' =>$request->class_pendidikan,
            'class_jabfung' =>$request->class_jabfung,
            'kelompok_keahlian' =>$request->kelompok_keahlian,
        ]);
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diubah!');
    }

    public function deleteDosen($id)
    {
        $dosen = User::where('id', $id)->first();
        File::delete('user/foto/' . $dosen->foto);

        User::where('id', $id)->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
    }

    public function deleteSelectedDosen(Request $request)
    {
        foreach ($request->id as $id) {
            $dosen = User::find($id);
            $dosen->delete();
        }

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dihapus!');
    }

    public function importPageDosen()
    {
        return view('dosen.import');
    }

    public function importDosen()
    {
        $dosen = new DosenImport();
        Excel::import($dosen, request()->file('file'));

        if ($dosen->failures()->isNotEmpty()) {
            return redirect()->route('dosen.index')->withFailures($dosen->failures());
        }

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diimport!');
    }

    public function indexUsers()
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        Session::put('page', 'indexUsers');
        return view('users.index');
    }

    public function dataUsers()
    {
        $data = User::orderBy('level')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('foto', function ($data) {
                $path = asset("/user/foto/$data->foto");
                return '
                    <div class="avatar-lg text-center">
                        <img src=' . $path . ' class="avatar-img rounded-circle" />
                    </div>
                ';
            })
            ->addColumn('level', function ($data) {
                if ($data->level == 1) {
                    return 'Tenaga Kependidikan';
                } else if ($data->level == 2) {
                    return 'Dosen';
                } else if ($data->level == 3) {
                    return 'Mahasiswa';
                }
            })
            ->addColumn('aksi', function ($data) {
                return '
                        <a href="' . route('users.show', $data->id) . '"><i class="fa fa-search"></i></a>
                    ';
            })
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function showUsers($id)
    {
        $data = User::find($id);
        return view('users.show', compact('data'));
    }

    public function tendikMahasiswa()
    {
        return view('mahasiswa.tendik');
    }

    public function tendikDataMahasiswa()
    {
        $mahasiswa = User::where(['level' => 3, 'status_aktif' => 1])->orderBy('nik', 'asc')->get();

        return datatables()
            ->of($mahasiswa)
            ->addIndexColumn()
            ->addColumn('foto', function ($mahasiswa) {
                $path = asset("/user/foto/$mahasiswa->foto");
                return '
                    <div class="avatar-lg text-center">
                        <img src=' . $path . ' class="avatar-img rounded-circle" />
                    </div>
                ';
            })
            ->addColumn('aksi', function ($mahasiswa) {
                return '
                    <a href="' . route('dashboardMahasiswa.show', $mahasiswa->id) . '"><i class="fa fa-search"></i></a>
                ';
            })
            ->rawColumns(['aksi', 'foto'])
            ->make(true);
    }

    public function tendikDosen()
    {
        return view('dosen.tendik');
    }

    public function tendikDataDosen()
    {
        $dosen = User::where('level', 2)->orderBy('nik', 'asc')->get();

        return datatables()
            ->of($dosen)
            ->addIndexColumn()
            ->addColumn('foto', function ($dosen) {
                $path = asset("/user/foto/$dosen->foto");
                return '
                    <div class="avatar-lg text-center">
                        <img src=' . $path . ' class="avatar-img rounded-circle" />
                    </div>
                ';
            })
            ->addColumn('aksi', function ($dosen) {
                return '
                    <a href="' . route('dashboardDosen.show', $dosen->id) . '"><i class="fa fa-search"></i></a>
                    ';
            })
            ->rawColumns(['aksi', 'foto'])
            ->make(true);
    }

    public function tendikAdmin()
    {
        return view('admin.tendik');
    }

    public function tendikDataAdmin()
    {
        $admin = User::where('level', 1)->orderBy('nik', 'asc')->get();

        return datatables()
            ->of($admin)
            ->addIndexColumn()
            ->addColumn('foto', function ($admin) {
                $path = asset("/user/foto/$admin->foto");
                return '
                    <div class="avatar-lg text-center">
                        <img src=' . $path . ' class="avatar-img rounded-circle" />
                    </div>
                ';
            })
            ->addColumn('status_superadmin', function ($admin) {
                if ($admin->status_superadmin == 1) {
                    return '<span class="badge badge-success">Aktif</span>';
                } else if ($admin->status_superadmin == 0) {
                    return '<span class="badge badge-danger">Tidak Aktif</span>';
                }
            })
            ->addColumn('aksi', function ($admin) {
                return '
                    <a href="' . route('dashboardAdmin.show', $admin->id) . '"><i class="fa fa-search"></i></a>
                    ';
            })
            ->rawColumns(['aksi', 'foto', 'status_superadmin'])
            ->make(true);
    }

    public function resetPassword($id)
    {
        $data = User::find($id);
        $data->password = bcrypt($data->nik);
        $data->save();
        return redirect()->route('users.index')->with('success', 'Password user berhasil direset!');
    }
}
