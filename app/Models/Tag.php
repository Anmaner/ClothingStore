<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{	
	protected $fillable = ['title'];

	public function posts()
	{
		return $this->belongsToMany('App\Models\Post');
	}
}
