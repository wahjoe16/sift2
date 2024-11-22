<?php

namespace App\Http\Controllers;

use App\Charts\AngkatanAlumniChart;
use App\Charts\BidangPekerjaanAlumniChart;
use App\Models\Alumni;
use App\Models\JabatanProfesi;
use App\Models\JobsAlumni;
use App\Models\KeahlianAlumni;
use App\Models\Posisi;
use App\Models\PostAlumni;
use App\Models\ProfesiAlumni;
use App\Models\ProfilLulusanAlumni;
use App\Models\SkillAlumni;
use App\Models\SubPosisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    public function portal(AngkatanAlumniChart $angkatanAlumniChart, BidangPekerjaanAlumniChart $bidangPekerjaanAlumniChart)
    {
        $data = ProfilLulusanAlumni::with('users')->where('jenjang', '=', 'S1')->get()->toArray();
        $alumni = Alumni::get();
        $jobs = Alumni::get();
        // dd($alumni);
        return view('frontend.home', [
            'data' => $data, 'jobs' => $jobs, 'alumni' => $alumni,
            'angkatanAlumniChart' => $angkatanAlumniChart->build(),
            'bidangPekerjaanAlumniChart' => $bidangPekerjaanAlumniChart->build()
        ]);
    }

    public function register(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            // 'nik' => 'unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $customMessage = [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            // 'nik.unique' => 'NPM sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal memiliki 6 karakter',
            'password.confirmed' => 'Password harus sama dengan konfirmasi password'
        ];

        $this->validate($request, $rules, $customMessage);

        if ($request->isMethod('POST')) {
            // $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $data = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'nik' => $request->nik,
                'password' => bcrypt($request->password),
                'level' => 3,
                'status_aktif' => 0,
            ]);

            Alumni::create(['user_id' => $data->id]);

            // if (Auth::attempt([
            //     'email' => $request->email,
            //     'password' => $request->password
            // ])) {
            //     $redirectTo = url('/alumni-page/dashboard');
            //     return response()->json(['url' => $redirectTo]);
            // }

            if (!$data) {
                return redirect()->back()->with('error', 'Registrasi gagal, silahkan coba lagi');
            }

            return redirect()->back()->with('success', 'Registrasi berhasil, anda sudah terdaftar! Silahkan Sign-in untuk melanjutkan');
            }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            if (Auth::guard('alumni')->attempt([
                'email' => $data['email'],
                'password' => $data['password'],
                'level' => 3,
                'status_aktif' => 0,
            ])) {
                return redirect()->route('dashboardFrontend.index');
            } else {
                return redirect()->back()->with('error', 'Email/Password salah');
            }
        }
    }

    public function dashboard()
    {
        $dataUser = Auth::guard('alumni')->user();
        $dataAlumni = ProfilLulusanAlumni::where('user_id', $dataUser->id)->first();
        $profilLulusan = ProfilLulusanAlumni::where('user_id', $dataUser->id)->get();
        $alumni = Alumni::where('user_id', $dataUser->id)->first();
        $listAlumni = User::where([
            'level' => 3, 
            'status_aktif' => 0
        ])->where('id', '!=', Auth::guard('alumni')->user()->id)->orderBy('id', 'desc')->paginate(5);
        $postingan = PostAlumni::with('users')->orderBy('id', 'desc')->get()->toArray();
        // dd($dataAlumni);
        return view('frontend.dashboard', compact('dataUser', 'dataAlumni', 'alumni', 'listAlumni', 'postingan', 'profilLulusan'));
    }

    public function profileUpdate($slug, Request $request)
    {
        $user = User::where('id', Auth::guard('alumni')->user()->id)->first();
        // dd($user);

        if ($slug == 'profil') {
            
        }
        elseif ($slug == 'personal') {

            if ($request->isMethod('POST')) {

                // $rules = [
                //     'nama' => 'required',
                //     'email' => 'required|email',
                //     'alamat' => 'required',
                //     'no_hp' => 'required'
                // ];

                // $customMessage = [
                //     'nama.required' => 'Nama harus diisi',
                //     'email.required' => 'Email harus diisi',
                //     'email.email' => 'Email harus valid',
                //     // 'email.unique' => 'Email sudah terdaftar',
                //     'alamat.required' => 'Alamat harus diisi',
                //     'no_hp.required' => 'No. Hand Phone harus diisi'
                // ];

                // $this->validate($request, $rules, $customMessage);

                User::where('id', Auth::guard('alumni')->user()->id)->update([
                    'nama' => $request->nama,
                    'email' => $request->email
                ]);

                Alumni::where('user_id', Auth::guard('alumni')->user()->id)->update([
                    'user_id' => Auth::guard('alumni')->user()->id,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp,
                    'allow_view_alamat' => $request->allow_alamat,
                    'allow_view_no_hp' => $request->allow_telepon,
                    'pekerjaan_sekarang' => $request->pekerjaan_sekarang,
                    'perusahaan_sekarang' => $request->perusahaan_sekarang,
                ]);

                return redirect()->back()->with('success', 'Data profil alumni berhasil diperbaharui');
            }
            
        } elseif ($slug == 'lulusan') {

            if ($request->isMethod('POST')) {
                    $rules = [
                    'program_studi' =>'required',
                    'tahun_lulus' =>'required',
                    'angkatan' =>'required',
                    'perguruan_tinggi' => 'required',
                ];

                $customMessage = [
                    'program_studi.required' => 'Program studi harus diisi',
                    'tahun_lulus.required' => 'Tahun lulus harus diisi',
                    'angkatan.required' => 'Angkatan harus diisi',
                    'perguruan_tinggi.required' => 'Perguruan Tinggi harus diisi',
                ];

                $this->validate($request, $rules, $customMessage);

                $lulusan = new ProfilLulusanAlumni();
                $lulusan->user_id = Auth::guard('alumni')->user()->id;
                $lulusan->angkatan = $request->angkatan;
                $lulusan->tahun_lulus = $request->tahun_lulus;
                $lulusan->jenjang = $request->jenjang;
                $lulusan->npm = $request->npm;
                $lulusan->program_studi = $request->program_studi;
                $lulusan->perguruan_tinggi = $request->perguruan_tinggi;
                $lulusan->save();

                return redirect()->back()->with('success', 'Data profil lulusan alumni berhasil diperbaharui');
            }

        } elseif ($slug == 'jobs') {          

            if ($request->isMethod('POST')) {

                foreach ($request['tahun_masuk_bekerja'] as $key => $value) {
                    if (!empty($value)) {
                        $jobs = new JobsAlumni();
                        $jobs->user_id = $user->id;
                        $jobs->tahun_masuk_bekerja = $value;
                        $jobs->tahun_berhenti_bekerja = $request['tahun_berhenti_bekerja'][$key];
                        // $jobs->jenis_pekerjaan = $request['jenis_pekerjaan'][$key];
                        $jobs->bidang_pekerjaan = $request['bidang_pekerjaan'][$key];
                        $jobs->profesi_id = $request['profesi_id'][$key];
                        $jobs->posisi = $request['posisi'][$key];

                        if ($request['jabatan_id'] != '') {
                            $jobs->jabatan_id = $request['jabatan_id'][$key];
                        } else {
                            $jobs->jabatan_id = null;
                        }
                        
                        $jobs->nama_perusahaan = $request['nama_perusahaan'][$key];
                        $jobs->lokasi_perusahaan = $request['alamat'][$key];
                        $jobs->save();
                    }
                }

                return redirect()->back()->with('success', 'Data Riwayat Pekerjaan alumni Berhasil Diperbarui');

            }
        } elseif ($slug == 'kompetensi') {
            if ($request->isMethod('POST')) {
                // upload sertifikat kompetensi
                $file = $request->file('sertifikat');
                $fileName = time() . '_' . Auth::guard('alumni')->user()->nama . '_' . $file->getClientOriginalName();
                $filePath = public_path('alumni/sertifikat');
                $file->move($filePath, $fileName);

                $kompetensi = new SkillAlumni();
                $kompetensi->user_id = $user->id;
                $kompetensi->kompetensi = $request->kompetensi;
                $kompetensi->sertifikat_kompetensi = $fileName;
                $kompetensi->save();

                return redirect()->back()->with('success', 'Data kompetensi berhasil diperbarui');

                /*
                    foreach ($request['kompetensi'] as $key => $value) {
                        if (!empty($value)) {
                            $kompetensi = new SkillAlumni();
                            $kompetensi->user_id = $user->id;
                            $kompetensi->kompetensi = $value;
                            
                            // upload sertifikat kompetensi
                            $files = $request->file('sertifikat');
                            foreach($files as $file){
                                $fileName = time() . '_' . Auth::guard('alumni')->user()->nama . '_' . $file->getClientOriginalName();
                                $filePath = public_path('alumni/sertifikat');
                                $file->move($filePath, $fileName);
                                $kompetensi->sertifikat_kompetensi = $fileName;
                            }

                            $kompetensi->save();
                        }
                    } 
                */
            }
        } elseif ($slug == 'keahlian') {
            if ($request->isMethod('POST')) {
                foreach ($request['keahlian'] as $key => $value) {
                    if (!empty($value)) {
                        $keahlian = new KeahlianAlumni();
                        $keahlian->user_id = $user->id;
                        $keahlian->keahlian = $value;
                        $keahlian->save();
                    }
                }

                return redirect()->back()->with('success', 'Data keahlian berhasil diperbarui');
            }
        } elseif ($slug == 'password') {
            if ($request->isMethod('POST')) {
                $rules = [
                    'old_password' => 'required',
                    'password' => 'required|min:6|confirmed',
                ];

                $customMessage = [
                    'old_password.required' => 'Password lama harus diisi',
                    'password.required' => 'Password harus diisi',
                    'password.min' => 'Password minimal memiliki 6 karakter',
                    'password.confirmed' => 'Konfirmasi password tidak sesuai'
                ];

                $this->validate($request, $rules, $customMessage);

                $user = Auth::guard('alumni')->user();
                // dd($user);

                // update password
                if ($request->has('password') && $request->password != "") {
                    if (Hash::check($request->old_password, $user->password)) {
                        if ($request->password == $request->password_confirmation) {
                            $user->password = bcrypt($request->password);
                        } else {
                            return redirect()->back()->with('error', 'Konfirmasi password tidak sesuai!');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Password lama anda salah!');
                    }
                    $user->save();
                    return redirect()->back()->with('success', 'Password user berhasil diubah!');
                }
            }
        }

        $dataAlumni = Alumni::where('user_id', Auth::guard('alumni')->user()->id)->first();
        $profilAlumni = ProfilLulusanAlumni::where('user_id', Auth::guard('alumni')->user()->id)->first();
        $jobsAlumni = JobsAlumni::with('user_jobs_alumni', 'profesi_alumni', 'jabatan_profesi_alumni')->where('user_id', Auth::guard('alumni')->user()->id)->get()->toArray();
        $skillAlumni = SkillAlumni::with('user_skill_alumni')->where('user_id', Auth::guard('alumni')->user()->id)->get();
        $keahlianAlumni = KeahlianAlumni::with('user_keahlian_alumni')->where('user_id', Auth::guard('alumni')->user()->id)->get();
        $profilLulusan = ProfilLulusanAlumni::with('users')->where('user_id', Auth::guard('alumni')->user()->id)->get()->toArray();
        $profesi = ProfesiAlumni::get();
        $jabatan = JabatanProfesi::get();
        // dd($jobsAlumni);

        return view('frontend.profile', compact('slug', 'dataAlumni', 'jobsAlumni', 'skillAlumni', 'keahlianAlumni','profilLulusan', 'profilAlumni', 'profesi', 'jabatan'));
    }

    public function profileEditLulusan(Request $request, $id)
    {
        $data = ProfilLulusanAlumni::find($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data riwayat pendidikan berhasil diperbarui');    
    }

    public function getJabatan($id)
    {
        $data = JabatanProfesi::where('profesi_id', $id)->pluck('nama_jabatan', 'id');
        return response()->json($data);
    }

    public function changeProfilePhoto(Request $request)
    {
        $user = Auth::guard('alumni')->user();

        if ($request->isMethod('post')) {

            $rules = [
                'foto' => 'required|mimes:png,jpg',
            ];
            
            $customMessage = [
                'foto.required' => 'Foto harus diisi',
                'foto.mimes' => 'Format file yang diperbolehkan hanya PNG dan JPG'
            ];

            $this->validate($request, $rules, $customMessage);

            // upload profile photo
            if($request->hasFile('foto')){
                $file = $request->file('foto');

                if (!is_null($file)) {
                    File::delete(public_path('/user/foto/' . $user->foto));
                    $fileName = $user->nama . '_' . time() . '_' . $file->getClientOriginalName();
                    $filePath = public_path('/user/foto');
                    $file->move($filePath, $fileName);
                }
            }

            User::where('id', Auth::guard('alumni')->user()->id)->update([
                'foto' => $fileName
            ]);            

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui');

        }
    }

    public function changeImageBannner(Request $request)
    {
        $user = Auth::guard('alumni')->user();

        if ($request->isMethod('post')) {

            $rules = [
                'banner' => 'required|mimes:png,jpg',
            ];
            
            $customMessage = [
                'banner.required' => 'Banner harus diisi',
                'banner.mimes' => 'Format file yang diperbolehkan hanya PNG dan JPG'
            ];

            $this->validate($request, $rules, $customMessage);

            // upload banner
            if($request->hasFile('banner')){
                $file = $request->file('banner');

                if (!is_null($file)) {
                    File::delete(public_path('/user/banner/' . $user->banner_img));
                    $fileName = $user->nama . '_' . time() . '_' . $file->getClientOriginalName();
                    $filePath = public_path('/user/banner');
                    $file->move($filePath, $fileName);
                }
            }

            Alumni::where('user_id', $user->id)->update([
                'banner_img' => $fileName
            ]);

            return redirect()->back()->with('success', 'Gambar banner berhasil diperbarui');
        }
    }

    public function createPost(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'post_content' =>'required',
                'post_image' =>'mimes:png,jpg,jpeg',
            ];
            
            $customMessage = [
                'post_content.required' => 'Isi postingan harus diisi',
                'image.mimes' => 'Format file yang diperbolehkan hanya PNG, JPG, dan JPEG'
            ];

            $this->validate($request, $rules, $customMessage);
            
            $post = new PostAlumni();
            $post->user_id = Auth::guard('alumni')->user()->id;
            $post->deskripsi = $request->post_content;

            if ($request->hasFile('post_image')) {
                $file = $request->post_image;
                $fileName = time() . '_postingan.' . $file->getClientOriginalExtension();
                $filePath = public_path('/alumni/postingan');
                $file->move($filePath, $fileName);
                $post->media = $fileName;
            }

            $post->save();

            return redirect()->back()->with('success', 'Postingan sukses ditambahkan!');
        }
    }

    public function listFriendAlumni()
    {
        $friends = User::where([
            'level' => 3, 
            'status_aktif' => 0
        ])->where('id', '!=', Auth::guard('alumni')->user()->id)->get()->toArray();
        $alumniFriends = Alumni::with('user_alumni')->where('user_id', '!=', Auth::guard('alumni')->user()->id)->get()->toArray();
        // $listFriends = Alumni::with('user_alumni')->where('user_id', '!=', Auth::guard('alumni')->user()->id)->get()->toArray();
        $dataUser = Auth::guard('alumni')->user();
        $alumni = Alumni::where('user_id', $dataUser->id)->first();
        $dataAlumni = ProfilLulusanAlumni::where('user_id', $dataUser->id)->first();
        $profilLulusan = ProfilLulusanAlumni::where('user_id', $dataUser->id)->get(); 
        // dd($alumniFriends);
        return view('frontend.list_friend', compact('friends', 'dataUser', 'alumni', 'dataAlumni', 'alumniFriends', 'profilLulusan'));
    }

    public function dataFriendAlumni()
    {
        $data = ProfilLulusanAlumni::with('users')->where('jenjang', '=', 'S1')->get()->toArray();

        return datatables()
            ->of($data)
            ->addColumn('foto', function($data){
                return '<img src="'.url('user/foto/'. $data['users']['foto']).'" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover" alt="Foto">';
            })
            ->addColumn('aksi', function($data){
                return '
                    <a target="_blank" href="'.route('frontend.alumniDetail', $data['user_id']).'"><i class="bi bi-search"></i></a>
                ';
                // return '
                //     <button onclick="viewAlumni(`' . route('frontend.alumniDetail', $data['user_id']) . '`)" class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button>
                // ';
            })
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function showFriendAlumni($id)
    {
        // $data = User::select('users.id', 'users.nama', 'users.email', 'users.foto', 'alumni.alamat', 'alumni.no_hp', 'alumni.banner_img', 'alumni.pekerjaan_sekarang', 'jobs_alumni.posisi', 'jobs_alumni.nama_perusahaan', 'jobs_alumni.tahun_masuk_bekerja', 'jobs_alumni.tahun_berhenti_bekerja')
        // ->leftJoin('alumni', 'alumni.user_id', 'users.id')
        // ->leftJoin('jobs_alumni', 'jobs_alumni.user_id', 'users.id')
        // ->find($id);
        
        // return response()->json($data);

        $data = User::find($id);
        $dataAlumni = Alumni::where('user_id', $id)->first();
        $profilLulusan = ProfilLulusanAlumni::where('user_id', $id)->first();
        $riwayatKerja = JobsAlumni::where('user_id', $id)->get();
        $pendidikan = ProfilLulusanAlumni::where('user_id', $id)->orderBy('angkatan', 'asc')->get();
        $kompetensi = SkillAlumni::where('user_id', $id)->get();
        $keahlian = KeahlianAlumni::where('user_id', $id)->get();
        $postingan = PostAlumni::where('user_id', $id)->get();

        return view('frontend.show_detail_alumni', compact('data', 'dataAlumni', 'profilLulusan', 'riwayatKerja', 'pendidikan', 'kompetensi', 'keahlian', 'postingan'));
    }

    public function viewFriendAlumni($id)
    {
        $data = User::find($id);
        $dataAlumni = Alumni::where('user_id', $id)->first();
        $profilLulusan = ProfilLulusanAlumni::where('user_id', $id)->first();
        $riwayatKerja = JobsAlumni::where('user_id', $id)->get();
        $pendidikan = ProfilLulusanAlumni::where('user_id', $id)->orderBy('angkatan', 'asc')->get();
        $kompetensi = SkillAlumni::where('user_id', $id)->get();
        $keahlian = KeahlianAlumni::where('user_id', $id)->get();
        $postingan = PostAlumni::where('user_id', $id)->get();
        // dd($pendidikan);
        return view('frontend.view_detail_alumni', compact('data', 'dataAlumni', 'profilLulusan', 'riwayatKerja', 'pendidikan', 'kompetensi', 'keahlian', 'postingan'));
    }

    public function logout()
    {
        Auth::guard('alumni')->logout();
        return redirect()->route('frontend.portal');
    }
}
