<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


//
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
   public function index() {
        if (!Schema::hasTable('events')) {
            return view('admin.events.index', ['events' => collect()]);
        }

        $this->seedDefaultEventsIfEmpty();
        $events = Event::with('category')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    protected function seedDefaultEventsIfEmpty(): void
    {
        if (!Schema::hasTable('events') || !Schema::hasTable('categories')) {
            return;
        }

        if (Event::count() > 0) {
            return;
        }

        $categorySeminar = Category::firstOrCreate(
            ['slug' => 'seminar-it'],
            ['name' => 'Seminar IT']
        );

        $categoryEntertainment = Category::firstOrCreate(
            ['slug' => 'entertaiment'],
            ['name' => 'Entertaiment']
        );

        Event::updateOrCreate(
            ['title' => 'Jazz Night 2025'],
            [
                'category_id' => $categoryEntertainment->id,
                'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu.',
                'date' => '2026-05-10 19:00:00',
                'location' => 'Amikom Baru',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'assets/concert.png',
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Hackaton - Unleash Your Inner Developer'],
            [
                'category_id' => $categorySeminar->id,
                'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
                'date' => '2026-05-05 10:00:00',
                'location' => 'Inkubator Amikom',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'assets/hackathon.png',
            ]
        );

        Event::updateOrCreate(
            ['title' => 'AI & FUTURE TECH SUMMIT 2026'],
            [
                'category_id' => $categorySeminar->id,
                'description' => 'Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan bersama para ahli di bidangnya.',
                'date' => '2026-05-01 13:00:00',
                'location' => 'Cinema Unit 6',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'assets/workshop.png',
            ]
        );
    }


    public function create() {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }


    public function store(Request $request) {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'date'        => 'required|date',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'poster'      => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }


        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
    }


    public function edit(Event $event) {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }


    public function update(Request $request, Event $event) {
        $data = $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'description' => 'required',
            'date'        => 'required',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
            'poster'      => 'nullable|image|max:2048',
        ]);


        if ($request->hasFile('poster')) {
            if ($event->poster_path) Storage::disk('public')->delete($event->poster_path);
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }


        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }


    public function destroy(Event $event) {
        if ($event->poster_path) Storage::disk('public')->delete($event->poster_path);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }


}


