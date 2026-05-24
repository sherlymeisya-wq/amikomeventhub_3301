<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $partners = Partner::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        })
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
            'logo_url' => 'nullable|url|max:1024',
            'logo_file' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($request->hasFile('logo_file')) {

            $path = $request->file('logo_file')
                ->store('partners', 'public');

            $data['logo_url'] = Storage::url($path);
        }

        Partner::create([
            'name'=>$data['name'],
            'logo_url'=>$data['logo_url']
        ]);

        return redirect()
            ->route('admin.partners.index')
            ->with('success','Partner berhasil ditambahkan');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:1024',
            'logo_file' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($request->hasFile('logo_file')) {

            if ($partner->logo_url &&
                str_contains($partner->logo_url,'storage')) {

                $oldFile = str_replace('/storage/','',$partner->logo_url);

                Storage::disk('public')
                    ->delete($oldFile);
            }

            $path = $request->file('logo_file')
                ->store('partners','public');

            $data['logo_url']=Storage::url($path);
        }

        $partner->update($data);

        return redirect()
            ->route('admin.partners.index')
            ->with('success','Partner berhasil diperbarui');
    }

    public function destroy(Partner $partner)
    {
        if (
            $partner->logo_url &&
            str_contains($partner->logo_url,'storage')
        ) {

            $oldFile = str_replace('/storage/','',$partner->logo_url);

            Storage::disk('public')
                ->delete($oldFile);
        }

        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('success','Partner berhasil dihapus');
    }
}