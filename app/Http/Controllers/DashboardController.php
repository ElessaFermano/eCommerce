<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function dashboard()
   {
    return view('dashboard');
    
   }
   public function total()
   {
      $totalUsers = User::count();
      $totalOrders = Order::count();
      $totalReviews = Review::count();
      $totalProducts = Product::count();
      $totalCategories = Category::count();
  
      return view('dashboard', compact('totalUsers', 'totalOrders', 'totalReviews', 'totalProducts', 'totalCategories'));
      
   }
}
