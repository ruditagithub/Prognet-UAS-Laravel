<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Username dan password harus diisi.');
        }

        $username = trim($request->username);
        $password = $request->password;

        // Check user dari database
        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);

            // Set session
            session([
                'user_logged_in' => true,
                'user_id' => $user->id,
                'is_admin' => $user->role === 'admin' // Set admin flag
            ]);

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Login berhasil! Selamat datang Admin.');
            } else {
                return redirect()->route('home')->with('success', 'Login berhasil!');
            }
        }

        return back()->with('error', 'Username atau password salah.')->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3|max:100',
            'username' => 'required|string|min:3|max:50|unique:users,username',
            'phone' => 'required|string|regex:/^[0-9]{10,14}$/',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'nama.required' => 'Nama lengkap harus diisi.',
            'nama.min' => 'Nama lengkap harus minimal 3 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username harus minimal 3 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'phone.regex' => 'Nomor telepon harus 10-14 digit.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password harus minimal 6 karakter.',
            'confirm_password.same' => 'Password dan konfirmasi password tidak sama.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Generate user ID
        $totalUsers = User::count() + 1;
        $userId = 'USR' . $totalUsers;

        User::create([
            'id' => $userId,
            'nama' => $request->nama,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role adalah user
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
