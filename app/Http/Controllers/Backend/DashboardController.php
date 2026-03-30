<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalProducts   = Product::count();
        $totalUsers      = User::count();

        return view('backend.layouts.dashboard', compact('totalCategories', 'totalProducts', 'totalUsers'));
    }
}
