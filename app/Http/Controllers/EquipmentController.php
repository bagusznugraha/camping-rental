<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\PageView;
use Carbon\Carbon;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::with('category')->latest()->get();

        return view('equipment.index', compact('equipments'));
    }
    public function customer()
{
    if (!session()->has('camping_viewed')) {

        PageView::create([
            'page' => 'camping'
        ]);

        session()->put('camping_viewed', true);
    }

    $equipments = Equipment::with('category')->get();

    $reviews = Review::with([
        'user',
        'rental.rentalDetails.equipment'
    ])->latest()->get();

    $averageRating = round(
        Review::avg('rating') ?? 0,
        1
    );

    $totalViews = PageView::where('page', 'camping')->count();

    $todayViews = PageView::whereDate(
    'created_at',
    Carbon::today()
)->count();

$weekViews = PageView::whereBetween(
    'created_at',
    [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek()
    ]
)->count();

$monthViews = PageView::whereMonth(
    'created_at',
    Carbon::now()->month
)
->whereYear(
    'created_at',
    Carbon::now()->year
)
->count();

    return view(
        'customer.equipment',
        compact(
    'equipments',
    'reviews',
    'averageRating',
    'totalViews',
    'todayViews',
    'weekViews',
    'monthViews'
)
    );
}
    public function create()
    {
        $categories = Category::all();

        return view('equipment.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:255',
            'stock' => 'required|integer',
            'total_unit' => 'required|integer',
            'price' => 'required|numeric',
            'specification' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $image);
        }

        Equipment::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'total_unit' => $request->total_unit,
            'price' => $request->price,
            'specification' => $request->specification,
            'image' => $image,
            
        ]);

        return redirect()->route('equipment.index')
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    public function show(Equipment $equipment)
    {
        //
    }

    public function edit(Equipment $equipment)
    {
        $categories = Category::all();

        return view('equipment.edit', compact('equipment', 'categories'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:255',
            'stock' => 'required|integer',
            'total_unit' => 'required|integer',
            'price' => 'required|numeric',
            'specification' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = $equipment->image;

        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $image);
        }

        $equipment->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'total_unit' => $request->total_unit,
            'price' => $request->price,
            'specification' => $request->specification,
            'image' => $image,
        ]);

        return redirect()->route('equipment.index')
            ->with('success', 'Alat berhasil diubah.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipment.index')
            ->with('success', 'Alat berhasil dihapus.');
    }
}