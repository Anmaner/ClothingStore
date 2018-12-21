<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategorie extends Model
{
	protected $fillable = ['title'];

	public function products()
	{
		return $this->belongsToMany('App\Models\Product', 'product_product_categorie', 'categorie_id', 'product_id');
	}
}
