<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $products=Product::with('category')->latest()->limit(8)->get();
        return view('Front.home', [
            'title' => 'Home',
            'products'=>$products
        ]);
    }
}
