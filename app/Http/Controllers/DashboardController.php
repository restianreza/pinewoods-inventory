<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\History;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $histories = History::select(
            'action_category',
            DB::raw('SUM(CASE WHEN action = "Add" THEN after_change - before_change ELSE 0 END) as total_masuk'),
            DB::raw('SUM(CASE WHEN action = "Out" THEN before_change - after_change ELSE 0 END) as total_keluar')
        )
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('action_category')
            ->get();

        $items = Item::select(
            'categories.category_name as category_name',
            DB::raw('sum(quantity) as total_stok')
        )
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->groupBy('categories.category_name')
            ->get();

        $tabHis = History::select(
            'description',
            'user',
            'action_category',
            DB::raw('DATE(created_at) as date')
        )->orderBy('created_at', 'desc')->get();

        $kategori = Categorie::all();

        return view('dashboard', compact('histories', 'items', 'kategori', 'tabHis'));
    }
}
