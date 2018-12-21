<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'text', 'img', 'intro', 'tags'];


	public function categorie()
	{
		return $this->belongsTo('App\Models\BlogCategorie');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
}
