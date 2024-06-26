<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\History;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanBarController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        $data = Item::with('categorie')->whereHas('categorie', function ($query) {
            $query->where('category_name', 'Bahan Bar');
        })->get();
        $showcaseCategory = Categorie::where('category_name', 'Bahan Bar')->first();

        if (!$showcaseCategory) {
            return view('pages.bar.bahan-bar', compact('categories'))->with('errors', 'Bahan Bar category not found');
        }

        $showcaseCategoryId = $showcaseCategory->id;

        $items = Item::where('category_id', $showcaseCategoryId)->get();

        $today = Carbon::today();

        $histories = History::select(
            'items.name as item_name',
            DB::raw('SUM(CASE WHEN action = "Add" THEN after_change - before_change ELSE 0 END) as total_masuk'),
            DB::raw('SUM(CASE WHEN action = "Out" THEN before_change - after_change ELSE 0 END) as total_keluar')
        )
            ->join('items', 'historys.item_id', '=', 'items.id')
            ->where('items.category_id', $showcaseCategoryId)
            ->whereDate('historys.created_at', $today)
            ->groupBy('items.name')
            ->get();

        $monthHistories = History::select(
            'items.name as item_name',
            DB::raw('SUM(CASE WHEN action = "Add" THEN after_change - before_change ELSE 0 END) as total_masuk'),
            DB::raw('SUM(CASE WHEN action = "Out" THEN before_change - after_change ELSE 0 END) as total_keluar')
        )
            ->join('items', 'historys.item_id', '=', 'items.id')
            ->where('items.category_id', $showcaseCategoryId)
            ->whereBetween('historys.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('items.name')
            ->get();

        $itemNames = $data->pluck('name');
        $itemQuantities = $data->pluck('quantity');

        $riwayat = History::where('action_category', 'Bahan Bar')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orderBy('created_at', 'desc')->get();


        return view('pages.bar.bahan-bar', compact('data', 'categories', 'items', 'monthHistories', 'histories', 'itemNames', 'itemQuantities', 'riwayat'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);


        $item = new Item();
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->quantity = $request->quantity;
        $item->date_in = now();
        $item->price = $request->price;
        $item->save();

        History::create([
            'user_id' => auth()->user()->id,
            'action' => "Create",
            'action_category' => 'Bahan Bar',
            'item_id' => $item->id,
            'description' => "Menambah item $item->name sebagai item baru sebanyak $request->quantity",
            'after_change' => json_encode($item->attributesToArray()), 'user' => auth()->user()->name


        ]);

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
        ]);

        $item = Item::findOrFail($id);
        $before = [
            'name' => $item->name,
            'description' => $item->description
        ];

        $item->name = $request->name;
        $item->description = $request->description;
        $item->save();

        $after = [
            'name' => $item->name,
            'description' => $item->description
        ];
        History::create([
            'user_id' => auth()->user()->id,
            'action' => "Update",
            'action_category' => 'Bahan Bar',
            'item_id' => $item->id,
            'description' => "Update item $item->name",
            'before_change' => json_encode($before),
            'after_change' => json_encode($after), 'user' => auth()->user()->name

        ]);

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    public function itemIn(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $item = Item::findOrFail($id);

        $before = $item->quantity;

        $item->quantity += $request->quantity;
        $item->save();

        $after = $item->quantity;

        History::create([
            'user_id' => auth()->user()->id,
            'action' => "Add",
            'action_category' => 'Bahan Bar',
            'item_id' => $item->id,
            'description' => "Menambah jumlah stok item $item->name sebanyak $request->quantity",
            'before_change' => json_encode($before),
            'after_change' => json_encode($after), 'user' => auth()->user()->name

        ]);


        // Redirect back with a success message
        return redirect()->back()->with('success', 'Item quantity updated successfully.');
    }
    public function itemOut(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $item = Item::findOrFail($id);
        if ($request->quantity > $item->quantity) {
            return redirect()->back()->with('error', 'Quantity exceeds available stock.');
        }

        $before = $item->quantity;

        $item->quantity -= $request->quantity;
        $item->save();

        $after = $item->quantity;


        History::create([
            'user_id' => auth()->user()->id,
            'action' => "Out",
            'action_category' => 'Bahan Bar',
            'item_id' => $item->id,
            'description' => "Mengurangi jumlah stok item $item->name sebanyak $request->quantity",
            'before_change' => json_encode($before),
            'after_change' => json_encode($after), 'user' => auth()->user()->name

        ]);

        $after = $item->quantity;


        // Redirect back with a success message
        return redirect()->back()->with('success', 'Item quantity updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $before = $item->attributesToArray();  // Snapshot data item sebelum dihapus


        $item->delete();

        History::create([
            'user_id' => auth()->id(),
            'action' => 'Delete',
            'action_category' => 'Bahan Bar',
            'item_id' => $item->id,
            'description' => 'Item deleted',
            'before_change' => json_encode($before),
            'after_change' => null, 'user' => auth()->user()->name
            // Tidak ada state setelah penghapusan
        ]);

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
