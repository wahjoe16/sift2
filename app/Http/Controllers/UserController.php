<?php

namespace App\Http\Controllers;

use App\Imports\DosenImport;
use App\Imports\MahasiswaImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;


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
            'program_studi' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'foto' => 'required|mimes:png,jpg',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'program_studi.required' => 'Program Studi tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'foto.required' => 'Foto tidak boleh kosong',
            'foto.mimes' => 'Foto harus mempunyai format jpg atau png'
        ]);

        // update foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            if ($file->isValid()) {
                $nama = 'user-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/user/foto'), $nama);
                $user->foto = $nama;
            } else if (!empty($request['current_user_foto'])) {
                $nama = $request['current_user_foto'];
            } else {
                $nama = '';
            }
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        $user->program_studi = $request->program_studi;
        $user->tipe_dosen = $request->tipe_dosen;
        $user->jabatan = $request->jabatan;

        $user->save();
        return redirect()->back()->with('success', 'Profil berhasil diubah!');
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
                $path = asset("$admin->foto");
                return '<img src=' . $path . ' class="img-circle img-bordered-sm" width="40"/>';
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
                    <div class="btn-group">
                        <a href="' . route('admin.edit', $admin->id) . '" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></a>
                        <a href="' . route('admin.destroy', $admin->id) . '" class="btn btn-xs btn-danger btn-flat" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
                    </div>
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
        return view('mahasiswa.index');
    }

    public function dataMahasiswa()
    {
        $mahasiswa = User::where('level', 3)->get();
        return datatables()
            ->of($mahasiswa)
            ->addIndexColumn()
            ->addColumn('select_all', function ($mahasiswa) {
                return '<input type="checkbox" name="id[]" value="' . $mahasiswa->id . '" />';
            })
            ->addColumn('foto', function ($mahasiswa) {
                $path = asset("$mahasiswa->foto");
                return '<img src=' . $path . ' class="img-circle img-bordered-sm" width="40"/>';
            })
            ->addColumn('aksi', function ($mahasiswa) {
                return '
                    <div class="btn-group">
                        <a href="' . route('mahasiswa.edit', $mahasiswa->id) . '" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></a>
                        <a href="' . route('mahasiswa.destroy', $mahasiswa->id) . '" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                    </div>
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
            ->addIndexColumn()
            ->addColumn('select_all', function ($dosen) {
                return '<input type="checkbox" name="id[]" value="' . $dosen->id . '" />';
            })
            ->addColumn('foto', function ($dosen) {
                $path = asset("$dosen->foto");
                return '<img src=' . $path . ' class="img-circle img-bordered-sm" width="40"/>';
            })
            ->addColumn('aksi', function ($dosen) {
                return '
                <div class="btn-group">
                    <a href="' . route('dosen.edit', $dosen->id) . '" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></a>
                    <a href="' . route('dosen.destroy', $dosen->id) . '" class="btn btn-xs btn-danger btn-flat" data-confirm-delete="true"><i class="fa fa-trash"></i></a>
                </div>
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
        $dosen->save();

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diubah!');
    }

    public function deleteDosen($id)
    {
        $dosen = User::where('id', $id)->first();
        File::delete('user/foto/' . $dosen->foto);

        User::where('id', $id)->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
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
}
