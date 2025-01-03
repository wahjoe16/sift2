<?php

namespace App\Http\Controllers;

use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('users.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
                'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(10);

        DB::table('reset_password')->insert([
            'email' => $request->email,
            'token' => $token
        ]);

        /* ===
        $actionLink = route('reset.password.form', compact('email', 'token'));
        $body = "We have received a request to reset the password for your App Name account associated with " . $request->email . ". You can reset passwor by clicking the link below.";

        Mail::send('email-forgot', compact('actionLink', 'body'), function($message) use ($request) {
            $message->from('no_repply@example.com', 'Alumni FT');
            $message->to($request->email, 'FT alumni Team')
                    ->subject("RESET PASSWORD");
        });
        === */

        return redirect()->route('frontend.portal')->with('success_reset', 'Permintaan reset password telah berhasil dan akan kami proses, silahkan cek email yang didaftarkan secara berkala. Terima Kasih.');
    }

    public function indexResetPassword()
    {
        $data = ResetPassword::orderBy('id', 'DESC')->get();
        return view('alumni.index_reset_password', compact('data'));
    }

    public function viewResetPwd($id)
    {
        $data = User::find($id);
        return view('alumni.show-reset-password', compact('data'));
    }

    public function storeResetPwd(Request $request, $id)
    {
        $data = User::find($id);

        $request->validate([
            'new_password' => 'required|min:6'
        ]);

        $data->password = bcrypt($request->new_password);
        $data->save();

        return redirect()->route('alumni.index')->with('success', 'Password alumni berhasil direset!');
    }

    // public function forgotPassword(Request $request)
    // {
    //     if ($request->isMethod('POST')) {

    //         $request->validate([
    //             'email' => 'required|email|exists:users'
    //         ]);

    //         $token = Str::random(16);

    //         DB::table('password_resets')->insert([
    //             'email' => $request->email,
    //             'token' => $token,
    //             'created_at' => Carbon::now(),
    //         ]);

    //         $actionLink = route('reset.password.form', ['token' => $token, 'email' => $request->email]);
    //         $body = "We have received a request to reset the password for your App Name account associated with " . $request->email . ". You can reset passwor by clicking the link below.";

    //         Mail::send('emails.forgot-password', ['actionLink,' => $actionLink, 'body' => $body], function($message) use ($request) {
    //             $message->from('no_repply@example.com', 'Alumni FT');
    //             $message->to($request->email, 'FT alumni Team')
    //                     ->subject("RESET PASSWORD");
    //         });

    //         return redirect()->back()->with('success_message', 'Link untuk merubah password telah kami kirimkan ke email terdaftar, silahkan cek email!');
    //     } 
            
    //     return view('users.forgot-password');
    // }

    public function showResetForm(Request $request, $token = null)
    {
        return view('emails.forgot-password')->with(['token' => $token, 'email' => $request->email]);
    }
}
