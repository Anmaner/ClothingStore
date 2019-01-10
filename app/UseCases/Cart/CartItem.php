<?php

namespace App\UseCases\Cart;

class CartItem
{
	private $id;
	private $price;
	private $amount;
	private $size;
	private $color;

	public function __construct($id, $size, $color, $amount)
	{
		$this->id = $id;
		$this->size = $size;
		$this->color = $color;
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

	public function getSize()
	{
		return $this->size;
	}


	public function getColor()
	{
		return $this->color;
	}	

	public function getGeneralPrice()
	{
		return $this->price * $this->amount;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function setSize($size)
	{
		$this->size = $size;
	}

	public function setColor($color)
	{
		$this->color = $color;
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