<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $fillable = ['count', 'size', 'color'];


	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}
}
