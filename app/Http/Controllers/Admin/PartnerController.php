<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $partners = Partner::when($search, fn($query) => $query->where('name', 'LIKE', "%{$search}%"))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.partners.index', compact('partners', 'search'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required_without:logo_file|url|max:1024',
            'logo_file' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);

        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('partners', 'public');
            $data['logo_url'] = Storage::url($path);
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required_without:logo_file|url|max:1024',
            'logo_file' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);

        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('partners', 'public');
            $data['logo_url'] = Storage::url($path);
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus.');
    }
}
