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
        return view('units.index', ['units' => Unit::paginate(20)]);
    }

    public function create(): View
    {
        $allUnits = Unit::orderBy('name')->get();
        return view('units.create', ['allUnits' => $allUnits]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'      => 'required|string|max:150|unique:units',
            'parent_id' => 'nullable|integer|exists:units,id',
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
        $allUnits = Unit::where('id', '!=', $unit->id)->orderBy('name')->get();
        return view('units.edit', ['unit' => $unit, 'allUnits' => $allUnits]);
    }

    public function update(Request $request, Unit $unit): RedirectResponse
    {
        $data = $request->validate([
            'name'      => 'required|string|max:150|unique:units,name,' . $unit->id,
            'parent_id' => 'nullable|integer|exists:units,id',
        ]);

        $unit->update($data);

        return redirect()->route('units.index');
    }

    public function destroy(Unit $unit): RedirectResponse
    {
        $unit->delete();

        return redirect()->route('units.index');
    }

    public function structure(): View
    {
        $roots = Unit::with('children.children.children.children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('units.structure', ['roots' => $roots]);
    }
}
