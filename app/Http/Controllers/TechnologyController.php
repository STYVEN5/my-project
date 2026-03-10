<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TechnologyController extends Controller
{
    public function index(): View
    {
        return view('technologies.index', ['technologies' => Technology::all()]);
    }

    public function create(): View
    {
        return view('technologies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:technologies',
        ]);

        Technology::create($data);

        return redirect()->route('technologies.index');
    }

    public function show(Technology $technology): View
    {
        return view('technologies.show', ['technology' => $technology]);
    }

    public function edit(Technology $technology): View
    {
        return view('technologies.edit', ['technology' => $technology]);
    }

    public function update(Request $request, Technology $technology): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:technologies,name,' . $technology->id,
        ]);

        $technology->update($data);

        return redirect()->route('technologies.index');
    }

    public function destroy(Technology $technology): RedirectResponse
    {
        $technology->delete();

        return redirect()->route('technologies.index');
    }
}
