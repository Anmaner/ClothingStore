<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategorie;
use App\Models\Post;
use App\Models\Product;


class BlogController extends Controller
{
	public function category(BlogCategorie $blogCat, Post $post, Product $product, $catTitle = null)
	{
		$categories = $blogCat->all();
		$posts = $catTitle ? $categories->where('alias', $catTitle)->first()->posts()->paginate(3) : $post->paginate(3);
		$products = $product->inRandomOrder()->limit(3)->get();

		return view('blog.blog', compact('categories', 'posts', 'products'));
	}
}
