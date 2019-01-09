<?php

namespace App\UseCases\Cart;

class CartItem
{
	private $id;
	private $price;
	private $amount;

	public function __construct($id, $amount)
	{
		$this->id = $id;
		$this->amount = $amount;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function getGeneralPrice()
	{
		return $this->price * $this->amount;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function setAmount($amount)
	{
		$this->amount = $amount;
	}

	public function amountUp()
	{
		$this->amount++;
	}

	public function amountDown()
	{
		if($this->amount > 1) {
			$this->amount--;
		}
	}
}