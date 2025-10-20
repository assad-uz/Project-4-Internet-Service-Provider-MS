<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource (packages.index).
     * Show the list of packages.
     */
    public function index()
    {
        // Fetch packages ordered by ID ascending so new packages appear at the bottom.
        $packages = Package::orderBy('id', 'asc')->paginate(10);

        // Assumes view path is resources/views/pages/admin/packages/index.blade.php
        return view('pages.admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource (packages.create).
     */
    public function create()
    {
        // Assumes view path is resources/views/pages/admin/packages/create.blade.php
        return view('pages.admin.packages.create');
    }

    /**
     * Store a newly created resource in storage (packages.store).
     */
    public function store(Request $request)
    {
        // Validation rules based on the 'packages' table structure
        $validatedData = $request->validate([
            'package_code' => 'required|string|max:10|unique:packages,package_code',
            'package_name' => 'required|string|max:100',
            'speed' => 'required|string|max:50',
            'price' => 'required|numeric|min:0', // Price must be a number >= 0
        ]);

        Package::create($validatedData);

        return redirect()->route('packages.index')
            ->with('success', 'Package created successfully.');
    }

    /**
     * Show the form for editing the specified resource (packages.edit).
     */
    public function edit(Package $package)
    {
        // Route Model Binding automatically fetches the Package based on ID
        return view('pages.admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage (packages.update).
     */
    public function update(Request $request, Package $package)
    {
        $validatedData = $request->validate([
            // Package code must be unique, ignoring the current package's ID
            'package_code' => ['required', 'string', 'max:10', Rule::unique('packages')->ignore($package->id)],
            'package_name' => 'required|string|max:100',
            'speed' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        $package->update($validatedData);

        return redirect()->route('packages.index')
            ->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage (packages.destroy).
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}
