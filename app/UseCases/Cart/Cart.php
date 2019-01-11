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
		$this->productExists($prodId);

		unset($this->products[$prodId]);

		$this->save();
	}

	public function get($prodId)
	{
		$this->productExists($prodId);

		return $this->handleProduct($this->products[$prodId]);
	}

	public function getAll()
	{
		return $this->handleProducts($this->products);
	}

	public function clear()
	{
		$this->products = [];

		$this->save();
	}

	public function setAmount($prodId, $amount)
	{
		$this->productExists($prodId);
		$this->products[$prodId]->setAmount($amount);

		$this->save();
	}

	public function amountUp($prodId)
	{
		$this->productExists($prodId);
		$this->products[$prodId]->amountUp();

		$this->save();
	}

	public function amountDown($prodId)
	{
		$this->productExists($prodId);
		$this->products[$prodId]->amountDown();

		$this->save();
	}

	public function getGeneralCost()
	{
		$price = 0;
		foreach($this->handleProducts($this->products) as $product) {
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

	protected function handleProducts(array $products)
	{
		foreach($products as $product) {
			$this->handleProduct($product);
		}

		return $products;
	}

	protected function handleProduct($product)
	{
		$product->setPrice($this->repository->getPrice($product->getId()));
		return $product;
	}

	protected function productExists($prodId)
	{
		if(!isset($this->products[$prodId])) {
			throw new \Exception("Product not found");
		}
	}
}