<?php

namespace App\Usecases\Cart\Repositories;

interface RepositoryInterface
{
	public function getProduct($prodId);

	public function getPrice($prodId);
}