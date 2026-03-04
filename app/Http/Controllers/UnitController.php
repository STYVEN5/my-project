<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitController extends Controller
{
    public function index(): View
    {
        return view('units.index', ['units' => Unit::all()]);
    }

    public function create(): View
    {
        return view('units.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:150|unique:units',
        ]);

        Unit::create($data);

        return redirect()->route('units.index');
    }

    public function show(Unit $unit): View
    {
        return view('units.show', ['unit' => $unit->load('users', 'sites')]);
    }

    public function edit(Unit $unit): View
    {
        return view('units.edit', ['unit' => $unit]);
    }

    public function update(Request $request, Unit $unit): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:150|unique:units,name,' . $unit->id,
        ]);

        $unit->update($data);

        return redirect()->route('units.index');
    }

    public function destroy(Unit $unit): RedirectResponse
    {
        $unit->delete();

        return redirect()->route('units.index');
    }
}
