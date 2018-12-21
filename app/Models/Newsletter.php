<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
	protected $fillable = ['email'];

	public function user() {
		return $this->belongsTo('App\Models\User');
	}
}
