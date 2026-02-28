<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'  => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users',
            'role'  => 'required|string|max:50',
        ]);

        return response()->json(User::create($data), 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user->load('units'));
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $data = $request->validate([
            'name'  => 'sometimes|string|max:150',
            'email' => 'sometimes|email|max:150|unique:users,email,' . $user->id,
            'role'  => 'sometimes|string|max:50',
        ]);

        $user->update($data);

        return response()->json($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
