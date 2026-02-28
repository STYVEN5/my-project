<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:150|unique:units',
        ]);

        return response()->json(Unit::create($data), 201);
    }

    public function show(Unit $unit): JsonResponse
    {
        return response()->json($unit->load('users', 'sites'));
    }

    public function update(Request $request, Unit $unit): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:150|unique:units,name,' . $unit->id,
        ]);

        $unit->update($data);

        return response()->json($unit);
    }

    public function destroy(Unit $unit): JsonResponse
    {
        $unit->delete();

        return response()->json(null, 204);
    }
}
