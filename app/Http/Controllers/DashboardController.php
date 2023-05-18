<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::select('id')->count();

        $categories = Category::with('alternatives', 'criteria')->select('id', 'name')->get();
        // dd($categories);

        return view('dashboard.pages.dashboard', [
            'users_count' => $users_count,
            'categories' => $categories
        ]);
    }
}
