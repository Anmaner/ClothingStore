<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'alias', 'text', 'img', 'intro'];


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

	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag');
	}
}
