<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.admins.index', [
            'admins' => User::where('role', 'admin')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'password' => ['required', 'confirmed', 'min:8'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        User::create([
            ...collect($validated)->except('password')->all(),
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin user created successfully.');
    }

    public function edit(User $admin)
    {
        abort_unless($admin->isAdmin(), 404);

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        abort_unless($admin->isAdmin(), 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $admin->id],
            'phone' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $payload = [
            ...collect($validated)->except('password')->all(),
            'is_active' => $request->boolean('is_active', false),
        ];

        if (! empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $admin->update($payload);

        return redirect()->route('admin.admins.index')->with('success', 'Admin user updated successfully.');
    }

    public function destroy(User $admin)
    {
        abort_if($admin->id === auth()->id(), 422, 'You cannot delete your own admin account.');
        abort_unless($admin->isAdmin(), 404);

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin user deleted successfully.');
    }
}
