<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
	protected $fillable = ['title'];

	public function post()
	{
		return $this->belongsTo('App\Models\Post');
	}
}