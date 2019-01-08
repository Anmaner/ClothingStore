<?php

namespace App\Usecases\Cart\Repositories;

use App\Models\Product;

class LaravelRepository implements RepositoryInterface
{
	public function getProduct($prodId)
	{
		if($product = Product::find($prodId)->first()) {
			return $product->toArray();
		}
		else {
			throw new \Exception("Product with id '$prodId' not found");
		}
	}

	public function getPrice($prodId)
	{
		if($product = Product::select('price')->where('id', $prodId)->first()) {
			return $product['price'];
		}
		else {
			throw new \Exception("Product with id '$prodId' not found");
		}
	}
}