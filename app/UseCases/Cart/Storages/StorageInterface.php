<?php

namespace App\Usecases\Cart\Storages;

interface StorageInterface
{
	public function save($data);

	public function load();
}