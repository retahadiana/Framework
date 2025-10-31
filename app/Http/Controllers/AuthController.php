<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Ambil user berdasarkan email dan status aktif
    $user = User::with(['roleUser' => function ($query) {
        $query->where('status', 1);
    }, 'roleUser.role'])
        ->where('email', $request->input('email'))
        ->first();

    if (!$user) {
        return redirect()->back()
            ->withErrors(['email' => 'Email tidak ditemukan.'])
            ->withInput();
    }

    // Cek password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()
            ->withErrors(['password' => 'Password salah.'])
            ->withInput();
    }

    // Ambil role
    $namaRole = Role::where('idrole', $user->roleUser[0]->idrole ?? null)->first();

    // Login ke session Laravel
    Auth::login($user);

    // Simpan data user ke session manual
    $request->session()->put([
        'user_id'     => $user->iduser,
        'user_name'   => $user->nama,
        'user_email'  => $user->email,
        'user_role'   => $user->roleUser[0]->idrole ?? 'user',
        'user_role_name' => $namaRole->nama_role ?? 'User',
        'user_status' => $user->roleUser[0]->status ?? 'active',
    ]);

    // After manual login we simply redirect to the general dashboard.
    // Role-specific redirects are handled centrally by Auth\LoginController::authenticated()
    return redirect('/dashboard')->with('success', 'Login berhasil!');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }


}
    