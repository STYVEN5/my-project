<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Server::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($provider = $request->input('provider')) {
            $query->where('provider', 'like', "%{$provider}%");
        }

        $servers = $query->paginate(20)->withQueryString();

        return view('servers.index', [
            'servers' => $servers,
            'filters' => $request->only(['search', 'type', 'status', 'provider']),
        ]);
    }

    public function create(): View
    {
        return view('servers.create');
    }

    public function store(Request $request): RedirectResponse
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

        Server::create($data);

        return redirect()->route('servers.index');
    }

    public function show(Server $server): View
    {
        return view('servers.show', ['server' => $server]);
    }

    public function edit(Server $server): View
    {
        return view('servers.edit', ['server' => $server]);
    }

    public function update(Request $request, Server $server): RedirectResponse
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

        return redirect()->route('servers.index');
    }

    public function destroy(Server $server): RedirectResponse
    {
        $server->delete();

        return redirect()->route('servers.index');
    }
}
