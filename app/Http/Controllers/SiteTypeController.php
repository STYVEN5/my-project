<?php

namespace App\Http\Controllers;

use App\Models\SiteType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteTypeController extends Controller
{
    public function index(): View
    {
        return view('site-types.index', ['siteTypes' => SiteType::all()]);
    }

    public function create(): View
    {
        return view('site-types.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:site_types',
        ]);

        SiteType::create($data);

        return redirect()->route('site-types.index');
    }

    public function show(SiteType $siteType): View
    {
        return view('site-types.show', ['siteType' => $siteType]);
    }

    public function edit(SiteType $siteType): View
    {
        return view('site-types.edit', ['siteType' => $siteType]);
    }

    public function update(Request $request, SiteType $siteType): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:site_types,name,' . $siteType->id,
        ]);

        $siteType->update($data);

        return redirect()->route('site-types.index');
    }

    public function destroy(SiteType $siteType): RedirectResponse
    {
        $siteType->delete();

        return redirect()->route('site-types.index');
    }
}
