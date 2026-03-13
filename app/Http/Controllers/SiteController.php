<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Site;
use App\Models\SiteType;
use App\Models\Technology;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        return view('sites.index', [
            'sites' => Site::with(['type', 'unit', 'responsibleUser', 'webServer', 'dbServer'])->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('sites.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
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

        return redirect()->route('sites.index');
    }

    public function show(Site $site): View
    {
        return view('sites.show', [
            'site' => $site->load(['type', 'unit', 'responsibleUser', 'webServer', 'dbServer', 'technologies']),
        ]);
    }

    public function edit(Site $site): View
    {
        return view('sites.edit', array_merge(['site' => $site], $this->formData()));
    }

    public function update(Request $request, Site $site): RedirectResponse
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

        return redirect()->route('sites.index');
    }

    public function destroy(Site $site): RedirectResponse
    {
        $site->delete();

        return redirect()->route('sites.index');
    }

    private function formData(): array
    {
        return [
            'siteTypes'    => SiteType::all(),
            'units'        => Unit::all(),
            'users'        => User::all(),
            'servers'      => Server::all(),
            'technologies' => Technology::all(),
        ];
    }
}
