<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required|min:8|confirmed',
        ];

        $customMessage = [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'nik.unique' => 'NPM sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus setidaknya 8 karakter',
            'password.confirmed' => 'Password harus sama dengan konfirmasi password'
        ];

        $this->validate($request, $rules, $customMessage);

        // $data = new User();
        // $data->nama = $request->nama;
        // $data->email = $request->email;
        // $data->nik = $request->nik;
        // $data->password = bcrypt($request->password);
        // $data->level = 3;
        // $data->status_aktif = 0;
        // $data->save();
        $data = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => bcrypt($request->password),
            'level' => 3,
            'status_aktif' => 0,
        ]);

        if (!$data) {
            return redirect()->back()->with('error', 'Registrasi gagal, silahkan coba lagi');
        }

        return redirect()->back()->with('success', 'Registrasi berhasil!');
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
        return view('frontend.dashboard');
    }

    public function logout()
    {
        Auth::guard('alumni')->logout();
        return redirect()->route('frontend.portal');
    }
}
