<?php

namespace App\UseCases\Cart;

use App\Usecases\Cart\Repositories\RepositoryInterface;
use App\UseCases\Cart\CartItem;
use App\Models\Product;

class Cart
{
	private $repository;
	private $products = [];

	public function __construct(RepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function add($prodId, $amount = 1)
	{
		$this->products[$prodId] = new CartItem($prodId, $this->repository->getPrice($prodId), $amount);
	}

	public function delete($prodId)
	{
		unset($this->products[$prodId]);
	}

	public function get($prodId)
	{
		return $this->products[$prodId];
	}

	public function getAll()
	{
		return $this->products;
	}

	public function clear()
	{
		$this->products = [];
	}

	public function setAmount($prodId, $amount)
	{
		$this->products[$prodId]->setAmount($amount);
	}

	public function amountUp($prodId)
	{
		$this->products[$prodId]->amountUp();
	}

	public function amountDown($prodId)
	{
		$this->products[$prodId]->amountDown();
	}

	public function getGeneralCost()
	{
		$price = 0;

		foreach($this->products as $product) {
			$price += $product->getGeneralPrice();
		}

		return $price;
	}
}