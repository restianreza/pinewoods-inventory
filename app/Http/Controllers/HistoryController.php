<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->get();
        return view('pages.more.history', compact('history'));
    }
}
