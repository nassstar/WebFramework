<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // <--- TAMBAHKAN INI (Untuk Hash::make)
use App\Models\UserModel;            // <--- TAMBAHKAN INI (Untuk UserModel::create)

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    // Memproses pendaftaran user baru
    public function proses_register(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'username' => 'required|string|min:4|unique:m_user,username',
            'password' => 'required|min:5|confirmed', // field konfirmasi password harus bernama password_confirmation di view
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Simpan Data ke Database
        UserModel::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password di-hash
            'level_id' => 3 // Pastikan level ID 3 (Member/Staf) ada di tabel m_level
        ]);

        // 3. Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silahkan login.');
    }

    public function login()
    {
        if (Auth::check()) { // Jika sudah login, redirect ke home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
