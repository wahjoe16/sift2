<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\JobsAlumni;
use App\Models\KeahlianAlumni;
use App\Models\Posisi;
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
    public function portal()
    {
        return view('frontend.home');
    }

    public function register(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'nik' => 'unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $customMessage = [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'nik.unique' => 'NPM sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal memiliki 6 karakter',
            'password.confirmed' => 'Password harus sama dengan konfirmasi password'
        ];

        $this->validate($request, $rules, $customMessage);

        if ($request->ajax()) {
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

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $redirectTo = url('/alumni-page/dashboard');
                return response()->json(['url' => $redirectTo]);
            }
        }
        

        // if (!$data) {
        //     return redirect()->back()->with('error', 'Registrasi gagal, silahkan coba lagi');
        // }

        // return redirect()->route('dashboardFrontend.index')->with('success', 'Registrasi berhasil!');
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
        // dd($dataUser);
        $dataAlumni = Alumni::where('user_id', $dataUser->id)->first();
        return view('frontend.dashboard', compact('dataUser', 'dataAlumni'));
    }

    public function profileUpdate($slug, Request $request)
    {
        $user = User::where('id', Auth::guard('alumni')->user()->id)->first();
        // dd($user);

        if ($slug == 'personal') {

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
                ];

                $customMessage = [
                    'program_studi.required' => 'Program studi harus diisi',
                    'tahun_lulus.required' => 'Tahun lulus harus diisi',
                    'angkatan.required' => 'Angkatan harus diisi',
                ];

                $this->validate($request, $rules, $customMessage);

                User::where('id', Auth::guard('alumni')->user()->id)->update([
                    'nik' => $request->nik,
                    'program_studi' => $request->program_studi
                ]);

                Alumni::where('user_id', Auth::guard('alumni')->user()->id)->update([
                    'tahun_lulus' => $request->tahun_lulus,
                    'angkatan' => $request->angkatan
                ]);

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
                        $jobs->jenis_pekerjaan = $request['jenis_pekerjaan'][$key];
                        $jobs->bidang_pekerjaan = $request['bidang_pekerjaan'][$key];
                        $jobs->posisi_id = $request['posisi'][$key];
                        $jobs->subposisi_id = $request['subposisi'][$key];
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
        $jobsAlumni = JobsAlumni::with('user_jobs_alumni', 'posisi')->where('user_id', Auth::guard('alumni')->user()->id)->get()->toArray();
        $skillAlumni = SkillAlumni::with('user_skill_alumni')->where('user_id', Auth::guard('alumni')->user()->id)->get();
        $keahlianAlumni = KeahlianAlumni::with('user_keahlian_alumni')->where('user_id', Auth::guard('alumni')->user()->id)->get();
        $posisi = Posisi::get();
        $subposisi = SubPosisi::get();
        // dd($jobsAlumni);

        return view('frontend.profile', compact('slug', 'dataAlumni', 'jobsAlumni', 'skillAlumni', 'keahlianAlumni', 'posisi', 'subposisi'));
    }

    public function getSubposisi($id)
    {
        $data = SubPosisi::where('posisi_id', $id)->pluck('nama_posisi', 'id');
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
                    File::delete(public_path('/user/banner/' . $user->banner));
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

    public function logout()
    {
        Auth::guard('alumni')->logout();
        return redirect()->route('frontend.portal');
    }
}
