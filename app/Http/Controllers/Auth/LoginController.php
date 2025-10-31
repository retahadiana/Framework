<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\RoleUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Handle post-authentication redirect based on the user's active role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user): RedirectResponse
    {
        // Find the first active role assignment for this user
        $roleUser = $user->roleUser()->where('status', 1)->with('role')->first();

        // store useful session values for later use in the app
        $request->session()->put([
            'user_id' => $user->iduser ?? $user->id,
            'user_name' => $user->nama ?? $user->name ?? null,
            'user_email' => $user->email ?? null,
            'user_role' => $roleUser->idrole ?? null,
            'user_role_name' => $roleUser->role->nama_role ?? null,
            'user_status' => $roleUser->status ?? null,
        ]);

        $roleName = strtolower($roleUser->role->nama_role ?? '');

        switch ($roleName) {
            case 'administrator':
                // Route name in routes/web.php is 'dashboard.admin'
                return redirect()->route('dashboard.admin')->with('success', 'Login berhasil sebagai Administrator!');
            case 'dokter':
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil sebagai Dokter!');
            case 'perawat':
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil sebagai Perawat!');
            case 'resepsionis':
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil sebagai Resepsionis!');
            case 'pemilik':
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil sebagai Pemilik!');
            default:
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
