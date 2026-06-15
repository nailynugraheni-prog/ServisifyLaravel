<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\DataHelper;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user')) {
            return $this->redirectByRole(session('user')['role']);
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email    = $request->input('email');
        $password = $request->input('password');
        $users    = DataHelper::getUsers();

        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                session(['user' => $user]);
                session(['cart'  => []]);
                return $this->redirectByRole($user['role']);
            }
        }
        return back()->with('error', 'Email atau password salah.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $users = DataHelper::getUsers();
        foreach ($users as $u) {
            if ($u['email'] === $request->email) {
                return back()->with('error', 'Email sudah terdaftar.');
            }
        }
        $newUser = [
            'id'         => DataHelper::generateId($users),
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => $request->password,
            'role'       => 'user',
            'phone'      => $request->phone ?? '',
            'avatar'     => null,
            'created_at' => now()->toDateString(),
        ];
        $users[] = $newUser;
        DataHelper::saveUsers($users);
        session(['user' => $newUser]);
        return redirect()->route('user.beranda')->with('success', 'Registrasi berhasil! Selamat datang di Servisify.');
    }

    public function logout()
    {
        session()->forget(['user', 'cart']);
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    private function redirectByRole(string $role)
    {
        return $role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.katalog.index');
    }
}