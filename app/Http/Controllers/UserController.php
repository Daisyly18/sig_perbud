<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('pages.users.index', compact('data'));
    }

    public function create() {
        return view('pages.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create([
            'username' => $request->input('username'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),            
            'email_verified_at' => now(),
            'password' => bcrypt($request->input('password')),
            ]);
            
        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    
    public function edit(User $user) 
    {
        return view('pages.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user) 
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|same:password',           
            
        ]);

        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);
    
        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(user $user)
    {
        $user->delete();
        
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }

    public function export()
    {
        $users = User::orderBy('username')->get();
        return Excel::download(new UsersExport($users), 'Daftar Pengguna.xlsx');
    }
}
