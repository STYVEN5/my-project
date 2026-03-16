<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        $users = $query->paginate(20)->withQueryString();

        $roles = User::select('role')->distinct()->whereNotNull('role')->orderBy('role')->pluck('role');

        return view('users.index', [
            'users'   => $users,
            'roles'   => $roles,
            'filters' => $request->only(['search', 'role']),
        ]);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'  => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users',
            'role'  => 'required|string|max:50',
        ]);

        User::create($data);

        return redirect()->route('users.index');
    }

    public function show(User $user): View
    {
        return view('users.show', ['user' => $user->load('units')]);
    }

    public function edit(User $user): View
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name'  => 'sometimes|string|max:150',
            'email' => 'sometimes|email|max:150|unique:users,email,' . $user->id,
            'role'  => 'sometimes|string|max:50',
        ]);

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
