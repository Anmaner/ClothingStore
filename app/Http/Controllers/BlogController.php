<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategorie;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Comment;


class BlogController extends Controller
{
	public function category(BlogCategorie $blogCat, Post $post, Product $product, Tag $tag, $catTitle = null)
	{
		$categories = $blogCat->all();
		$posts = $catTitle ? $categories->where('alias', $catTitle)->first()->posts()->paginate(3) : $post->paginate(3);

		$products = $product->inRandomOrder()->limit(3)->get();
		$tags = $tag->inRandomOrder()->limit(5)->get();

		return view('blog.blog', compact('categories', 'posts', 'products', 'catTitle', 'tags'));
	}

	public function post(BlogCategorie $blogCat, Post $post, Product $product, Tag $tag, $alias)
	{
		$data = $post->where('alias', $alias)->first();

		$categories = $blogCat->all();
		$products = $product->inRandomOrder()->limit(3)->get();
		$tags = $tag->inRandomOrder()->limit(5)->get();

		return view('blog.blog_detail', compact('data', 'categories', 'products', 'tags'));
	}

	public function comment(Request $request, Comment $comment)
	{
		$data = $request->all();

		$comment['text'] = $data['text'];
		$comment['post_id'] = $request['post_id'];


		if(\Auth::check()) {
			$comment['user_id'] = \Auth::id();
		}
		else{
			// Valid "name" and "email"

			$comment['name'] = $data['name'];
			$comment['email'] = $data['email'];
		}

		$comment->save();

		return redirect()->route('post', $data['post_title']);
	}
}
