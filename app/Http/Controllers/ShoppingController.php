<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategorie;
use App\Models\Product;

class ShoppingController extends Controller
{
	public function category(Request $request, ProductCategorie $prodCat, Product $product, $catTitle = null)
	{
		$products = $catTitle ? $prodCat->where('title', $catTitle)->first()->products()->paginate(32) : $product->paginate(32);
		$categories = $prodCat->all();

		return view('shop.product', compact('products', 'categories', 'catTitle'));
	}
}
