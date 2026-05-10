<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Admin;

class AuthController extends Controller
{

    // ==============================
    // TAMPILKAN HALAMAN LOGIN
    // ==============================
    public function showLogin()
    {
        return view('login');
    }


    // ==============================
    // REGISTER SISWA
    // ==============================
    public function register(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas',
            'nisn' => 'required|unique:siswas',
            'nama' => 'required',
            'kelas' => 'required',
            'gmail' => 'required|email|unique:siswas',
            'password' => 'required|min:6'
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'gmail' => $request->gmail,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }


    // ==============================
    // LOGIN (ADMIN + SISWA)
    // ==============================
    public function login(Request $request)
    {
        $request->validate([
            'gmail' => 'required',
            'password' => 'required'
        ]);


        // ==============================
        // CEK LOGIN ADMIN / SUPERADMIN
        // ==============================
        $admin = Admin::where('username', $request->gmail)->first();

       if ($admin && Hash::check($request->password, $admin->password)) {
    // WAJIB pakai guard('admin')
    Auth::guard('admin')->login($admin); 

    session(['role' => $admin->role]);
    return redirect('/admin/dashboard');
}


        // ==============================
        // CEK LOGIN SISWA
        // ==============================
        $siswa = Siswa::where('gmail', $request->gmail)->first();

        if ($siswa && Hash::check($request->password, $siswa->password)) {

            Auth::login($siswa);

            session([
                'role' => 'siswa'
            ]);

            return redirect('/dashboard');
        }


        return back()->with('error', 'Akun tidak ditemukan atau password salah!');
    }



    // ==============================
    // LOGOUT
    // ==============================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}