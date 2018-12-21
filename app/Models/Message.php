<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['email', 'text', 'response', 'responder', 'read'];
}
