<?php

namespace App\Usecases\Cart\Repositories;

use Session;

class LaravelSessionStorage implements StorageInterface
{
	public function save($data)
	{
		Session::put('cart', serialize($data));
	}

	public function load()
	{
		return Session::has('cart') ? unserialize(Session::get('cart')) : [];
	}
}