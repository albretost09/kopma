<?php

namespace App\Http\Controllers\Pengurus\Auth;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class RecoverPasswordController extends Controller
{
    public function index()
    {
        return view('pages.pengurus.auth.recovery-password');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $user = Pengguna::query()
            ->where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        $token = Password::createToken($user);

        $user->sendPasswordResetNotification($token);

        return redirect()->route('pengurus.login')->with('success', 'Silahkan cek email anda untuk mereset password');
    }

    public function reset($token)
    {
        $user = Pengguna::query()
            ->where('email', request()->email)
            ->first();
        $email = $user->email;

        if (!Password::tokenExists($user, $token)) {
            return redirect()->route('pengurus.login')->with('error', 'Token tidak valid');
        }

        return view('pages.pengurus.auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $user = Pengguna::query()
            ->where('email', $request->email)
            ->first();

        if (!Password::tokenExists($user, $request->token)) {
            return redirect()->route('pengurus.login')->with('error', 'Token tidak valid');
        }

        $result = $user->update([
            'password' => bcrypt($request->password)
        ]);

        if ($result) {
            return redirect()->route('pengurus.login')->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->route('pengurus.login')->with('error', 'Password gagal diubah');
        }
    }
}
