<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = DataHelper::getUsers();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $users = DataHelper::getUsers();
        foreach ($users as $u) {
            if ($u['email'] === $request->email) {
                return back()->with('error', 'Email sudah terdaftar.');
            }
        }
        $users[] = [
            'id'         => DataHelper::generateId($users),
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => $request->password,
            'role'       => $request->role,
            'phone'      => $request->phone ?? '',
            'avatar'     => null,
            'created_at' => now()->toDateString(),
        ];
        DataHelper::saveUsers($users);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $users = DataHelper::getUsers();
        $user  = null;
        foreach ($users as $u) { if ($u['id'] == $id) { $user = $u; break; } }
        if (!$user) return redirect()->route('admin.pengguna.index');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $users = DataHelper::getUsers();
        foreach ($users as &$u) {
            if ($u['id'] == $id) {
                $u['name']  = $request->name;
                $u['email'] = $request->email;
                $u['role']  = $request->role;
                $u['phone'] = $request->phone ?? '';
                if ($request->filled('password')) $u['password'] = $request->password;
                break;
            }
        }
        DataHelper::saveUsers($users);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $users = array_values(array_filter(DataHelper::getUsers(), fn($u) => $u['id'] != $id));
        DataHelper::saveUsers($users);
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}