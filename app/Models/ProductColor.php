<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
	protected $fillable = ['color'];

	public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}
}
