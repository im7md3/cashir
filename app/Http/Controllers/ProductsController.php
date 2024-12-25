<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductsController extends Controller
{
    public function print()  {
        $products = Product::with(['department', 'unit'])->latest()->get();
        return view('product.print', compact('products'));
    }
}
