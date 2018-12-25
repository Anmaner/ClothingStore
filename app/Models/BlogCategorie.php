<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategorie extends Model
{
	protected $fillable = ['title', 'alias'];

	public function posts()
	{
		return $this->hasMany('App\Models\Post', 'categorie_id', 'id');
	}
}
