<?php

namespace App\Http\Controllers;

use App\Models\SiteType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteTypeController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:site_types',
        ]);

        return response()->json(SiteType::create($data), 201);
    }

    public function show(SiteType $siteType): JsonResponse
    {
        return response()->json($siteType);
    }

    public function update(Request $request, SiteType $siteType): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:site_types,name,' . $siteType->id,
        ]);

        $siteType->update($data);

        return response()->json($siteType);
    }

    public function destroy(SiteType $siteType): JsonResponse
    {
        $siteType->delete();

        return response()->json(null, 204);
    }
}
