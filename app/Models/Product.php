<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = ['title', 'alias', 'price', 'description', 'intro', 'weight', 'dimensions', 'materials'];


	public function categories()
	{
		return $this->belongsToMany('App\Models\ProductCategorie', 'product_product_categorie', 'product_id', 'categorie_id');
	}

	public function reviews()
	{
		return $this->hasMany('App\Models\Review');
	}

	public function sizes()
	{
		return $this->hasMany('App\Models\ProductSize');
	}

	public function photos()
	{
		return $this->hasMany('App\Models\ProductPhoto');
	}

	public function colors()
	{
		return $this->hasMany('App\Models\ProductColor');
	}

    public function wishlist()
    {
        return $this->belongsToMany('App\Models\User', 'wishlists');
    }

    public function getColorsList()
    {
    	$colors = $this->colors();
    	$colorsList = [];

    	if(empty($colors)) {
    		return [];
    	}

    	foreach($colors as $color) {
    		$colorsList[] = $color['color'];
    	}

    	return $colorsList;
    }
}
