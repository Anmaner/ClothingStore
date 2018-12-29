<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategorie;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Product;

class BlogSearchController extends Controller
{
	public function tags(BlogCategorie $blogCat, Post $post, Tag $tag, Product $product, $curTag)
	{
		$categories = $blogCat->all();
		$posts = $tag->where('title', $curTag)->first()->posts()->paginate(3);
		$tags = $tag->inRandomOrder()->limit(5)->get();
		$products = $product->inRandomOrder()->limit(3)->get();

		return view('blog.blog', compact('categories', 'posts', 'tags', 'products', 'curTag'));
	}
}
