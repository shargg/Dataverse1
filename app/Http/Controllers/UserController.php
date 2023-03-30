<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page') ?? 10;
        $users = User::with('roles')->paginate($perPage);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $is_active = $request->has('is_active') ? $request->input('is_active') : 0;

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:dv_users',
            'email' => 'required|email|unique:dv_users|max:255',
            'password' => 'required|confirmed|min:8',
            'roles.*' => 'required|exists:dv_users_roles,name',
        ]);
   
        DB::transaction(function () use ($validatedData, $is_active) {
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'is_active' => $is_active,
                'wp_users_ID' => 0,  
            ]);

            $roleNames = $validatedData['roles'] ?? [];
            $roleIds = Role::whereIn('name', $validatedData['roles'])->pluck('id');
        
            // Sync the roles using the role IDs
            $user->roles()->sync($roleIds);
        });   

        return response()->json(['message' => 'User created successfully', 'success' => true]);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        
        $is_active = $request->has('is_active') ? $request->input('is_active') : 0;

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:dv_users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:dv_users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles.*' => 'required|exists:dv_users_roles,name',
        ]);

        DB::transaction(function () use ($validatedData, $user, $is_active) {
            $user->update([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
                'is_active' => $is_active,
            ]);

            $roleIds = Role::whereIn('name', $validatedData['roles'])->pluck('id');

            $user->roles()->sync($roleIds);
        });

        return response()->json(['message' => 'User updated successfully']);
;
    }

    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            $user->roles()->detach();
            $user->delete();
        });

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
