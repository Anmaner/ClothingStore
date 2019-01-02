<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategorie;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Auth;

class ShoppingController extends Controller
{
	public function category(Request $request, ProductCategorie $prodCat, Product $product, $catTitle = null)
	{
		$products = $catTitle ? $prodCat->where('title', $catTitle)->first()->products()->paginate(32) : $product->paginate(32);
		$categories = $prodCat->all();

		return view('shop.product', compact('products', 'categories', 'catTitle'));
	}

	public function product(Request $request, ProductCategorie $prodCat, Product $product, User $user, $alias)
	{
		$data = $product->where('alias', $alias)->first();
		$categories = $prodCat->all();
		$products = $product->inRandomOrder()->limit(30)->get();
		
		if(Auth::check()) {
			$userHasReviews = $user->find(Auth::id())->reviews()->count() > 0;
		}
		else{
			$userHasReviews = false;
		}

		return view('shop.product_detail', compact('data', 'categories', 'products', 'userHasReviews'));
	}

	public function review(Request $request, Review $review)
	{
		$data = $request->all();

		if(Auth::check()) {
			$review['user_id'] = Auth::id();
		}
		else{
			$review['name'] = $data['name'];
			$review['email'] = $data['email'];
		}

		// Validation of rating

		$review['rating'] = $data['rating'];
		$review['text'] = $data['text'];
		$review['product_id'] = $data['product_id'];

		$review->save();

		return redirect()->route('product', $data['product_alias']);
	}
}
