<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'                => 'required|string|max:150',
            'url'                 => 'required|url|max:255|unique:sites',
            'type_id'             => 'nullable|exists:site_types,id',
            'unit_id'             => 'nullable|exists:units,id',
            'responsible_user_id' => 'nullable|exists:users,id',
            'web_server_id'       => 'nullable|exists:servers,id',
            'db_server_id'        => 'nullable|exists:servers,id',
            'server_username'     => 'nullable|string|max:100',
            'server_path'         => 'nullable|string|max:255',
            'database_name'       => 'nullable|string|max:100',
            'database_username'   => 'nullable|string|max:100',
            'technology_ids'      => 'nullable|array',
            'technology_ids.*'    => 'exists:technologies,id',
        ]);

        $site = Site::create($data);

        if (!empty($data['technology_ids'])) {
            $site->technologies()->sync($data['technology_ids']);
        }

        return response()->json($site->load('technologies'), 201);
    }

    public function show(Site $site): JsonResponse
    {
        return response()->json(
            $site->load(['type', 'unit', 'responsibleUser', 'webServer', 'dbServer', 'technologies'])
        );
    }

    public function update(Request $request, Site $site): JsonResponse
    {
        $data = $request->validate([
            'name'                => 'sometimes|string|max:150',
            'url'                 => 'sometimes|url|max:255|unique:sites,url,' . $site->id,
            'type_id'             => 'nullable|exists:site_types,id',
            'unit_id'             => 'nullable|exists:units,id',
            'responsible_user_id' => 'nullable|exists:users,id',
            'web_server_id'       => 'nullable|exists:servers,id',
            'db_server_id'        => 'nullable|exists:servers,id',
            'server_username'     => 'nullable|string|max:100',
            'server_path'         => 'nullable|string|max:255',
            'database_name'       => 'nullable|string|max:100',
            'database_username'   => 'nullable|string|max:100',
            'technology_ids'      => 'nullable|array',
            'technology_ids.*'    => 'exists:technologies,id',
        ]);

        $site->update($data);

        if (array_key_exists('technology_ids', $data)) {
            $site->technologies()->sync($data['technology_ids'] ?? []);
        }

        return response()->json($site->load('technologies'));
    }

    public function destroy(Site $site): JsonResponse
    {
        $site->delete();

        return response()->json(null, 204);
    }
}
