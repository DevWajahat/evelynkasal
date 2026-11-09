<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CmsManagmentController extends Controller
{
    public function index(Request $request)
    {
        $cmsList = Cms::withCount('meta')->latest()->get();
        $editItem = null;

        if ($request->has('edit')) {
            $editItem = Cms::find($request->get('edit'));
        }

        return view('screens.admin.cms.pages.index', compact('cmsList', 'editItem'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:100',
            'type' => 'required|string|max:100',
        ]);

        $validated['page'] = Str::slug($validated['page']);
        $validated['type'] = Str::snake($validated['type']);

        $exists = Cms::where('page', $validated['page'])
            ->where('type', $validated['type'])
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'A section with this type already exists for the selected page.');
        }

        Cms::create($validated);

        return redirect()->route('admin.cms.index')->with('success', 'Page section registered successfully.');
    }

    public function update(Request $request, Cms $cms)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:100',
            'type' => 'required|string|max:100',
        ]);

        $validated['page'] = Str::slug($validated['page']);
        $validated['type'] = Str::snake($validated['type']);

        $exists = Cms::where('page', $validated['page'])
            ->where('type', $validated['type'])
            ->where('id', '!=', $cms->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Another section already uses this page and section type.');
        }

        $cms->update($validated);

        return redirect()->route('admin.cms.index')->with('success', 'Page section updated successfully.');
    }

    public function destroy(Cms $cms)
    {
        $cms->meta()->delete();
        $cms->delete();

        return redirect()->route('admin.cms.index')->with('success', 'Page section and associated meta removed.');
    }
}
