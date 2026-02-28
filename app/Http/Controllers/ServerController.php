<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'ip_address'  => 'required|string|max:45',
            'type'        => 'required|in:WEB,DATABASE',
            'os_name'     => 'nullable|string|max:100',
            'provider'    => 'nullable|string|max:100',
            'location'    => 'nullable|string|max:100',
            'cpu_cores'   => 'nullable|integer|min:1',
            'ram_gb'      => 'nullable|integer|min:1',
            'storage_gb'  => 'nullable|integer|min:1',
            'status'      => 'nullable|in:ACTIVE,MAINTENANCE,DECOMMISSIONED',
            'description' => 'nullable|string',
        ]);

        return response()->json(Server::create($data), 201);
    }

    public function show(Server $server): JsonResponse
    {
        return response()->json($server);
    }

    public function update(Request $request, Server $server): JsonResponse
    {
        $data = $request->validate([
            'name'        => 'sometimes|string|max:150',
            'ip_address'  => 'sometimes|string|max:45',
            'type'        => 'sometimes|in:WEB,DATABASE',
            'os_name'     => 'nullable|string|max:100',
            'provider'    => 'nullable|string|max:100',
            'location'    => 'nullable|string|max:100',
            'cpu_cores'   => 'nullable|integer|min:1',
            'ram_gb'      => 'nullable|integer|min:1',
            'storage_gb'  => 'nullable|integer|min:1',
            'status'      => 'sometimes|in:ACTIVE,MAINTENANCE,DECOMMISSIONED',
            'description' => 'nullable|string',
        ]);

        $server->update($data);

        return response()->json($server);
    }

    public function destroy(Server $server): JsonResponse
    {
        $server->delete();

        return response()->json(null, 204);
    }
}
