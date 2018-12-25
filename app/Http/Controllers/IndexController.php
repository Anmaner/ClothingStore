<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategorie;


class IndexController extends Controller
{
	public function index(Product $product, ProductCategorie $prodCat)
	{
		$products = $product->inRandomOrder()->limit(32)->get();
		$categories = $prodCat->all();

		return view('index', compact('products', 'categories'));
	}
}
