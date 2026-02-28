<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:technologies',
        ]);

        return response()->json(Technology::create($data), 201);
    }

    public function show(Technology $technology): JsonResponse
    {
        return response()->json($technology);
    }

    public function update(Request $request, Technology $technology): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:technologies,name,' . $technology->id,
        ]);

        $technology->update($data);

        return response()->json($technology);
    }

    public function destroy(Technology $technology): JsonResponse
    {
        $technology->delete();

        return response()->json(null, 204);
    }
}
