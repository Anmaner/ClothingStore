<?php

namespace App\UseCases\Cart;

use App\Usecases\Cart\Repositories\RepositoryInterface;
use App\Usecases\Cart\Storages\StorageInterface;
use App\UseCases\Cart\CartItem;
use App\Models\Product;

class Cart
{
	private $repository;
	private $storage;
	private $products = [];

	public function __construct(StorageInterface $storage, RepositoryInterface $repository)
	{
		$this->repository = $repository;
		$this->storage = $storage;

		$this->load();
	}

	public function add($prodId, $size, $color, $amount = 1)
	{
		$this->products[$prodId] = new CartItem($prodId, $size, $color, $amount);

		$this->save();
	}

	public function delete($prodId)
	{
		unset($this->products[$prodId]);

		$this->save();
	}

	public function get($prodId)
	{
		$this->load();

		return $this->products[$prodId];
	}

	public function getAll()
	{
		$this->load();

		return $this->products;
	}

	public function clear()
	{
		$this->products = [];

		$this->save();
	}

	public function setAmount($prodId, $amount)
	{
		$this->products[$prodId]->setAmount($amount);

		$this->save();
	}

	public function amountUp($prodId)
	{
		$this->products[$prodId]->amountUp();

		$this->save();
	}

	public function amountDown($prodId)
	{
		$this->products[$prodId]->amountDown();

		$this->save();
	}

	public function getGeneralCost()
	{
		$this->load();

		$price = 0;
		foreach($this->products as $product) {
			$price += $product->getGeneralPrice();
		}

		return $price;
	}



	protected function save()
	{
		$this->storage->save($this->products);
	}

	protected function load()
	{
		$this->products = $this->handleProducts($this->storage->load());
	}

	protected function handleProducts($products)
	{
		foreach($products as $product) {
			$product->setPrice($this->repository->getPrice($product->getId()));
		}

		return $products;
	}
}