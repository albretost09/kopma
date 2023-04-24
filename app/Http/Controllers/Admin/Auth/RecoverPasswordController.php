<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class RecoverPasswordController extends Controller
{
    public function index()
    {
        return view('pages.admin.auth.recovery-password');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $user = Admin::query()
            ->where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        $token = Password::createToken($user);

        $user->sendPasswordResetNotification($token, $user->email);

        return redirect()->route('admin.login')->with('success', 'Silahkan cek email anda untuk mereset password');
    }

    public function reset($token)
    {
        $user = Admin::query()
            ->where('email', request()->email)
            ->first();
        $email = $user->email;

        if (!Password::tokenExists($user, $token)) {
            return redirect()->route('admin.login')->with('error', 'Token tidak valid');
        }

        return view('pages.admin.auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $user = Admin::query()
            ->where('email', $request->email)
            ->first();

        if (!Password::tokenExists($user, $request->token)) {
            return redirect()->route('admin.login')->with('error', 'Token tidak valid');
        }

        $result = $user->update([
            'password' => bcrypt($request->password)
        ]);

        if ($result) {
            return redirect()->route('admin.login')->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->route('admin.login')->with('error', 'Password gagal diubah');
        }
    }
}
