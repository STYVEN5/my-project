<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServerController extends Controller
{
    public function index(): View
    {
        return view('servers.index', ['servers' => Server::paginate(20)]);
    }

    public function pdf(): Response
    {
        $servers = Server::all();

        return Pdf::loadView('pdf.servers', compact('servers'))
            ->setPaper('a4', 'landscape')
            ->download('servers_' . now()->format('Y-m-d') . '.pdf');
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
