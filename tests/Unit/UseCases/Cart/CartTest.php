<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\UseCases\Cart\Cart;
use App\Usecases\Cart\Repositories\RepositoryInterface;

class FakeRepository implements RepositoryInterface
{
	public function getProduct($prodId)
	{
		//
	}

	public function getPrice($prodId)
	{
		return $prodId*10;
	}
}

class CartTest extends TestCase
{
	public function setUp()
	{
		$this->cart = new Cart(new FakeRepository);
	}

    public function testAdd()
    {
    	$this->cart->add(1, 5);
    	$product = $this->cart->get(1);

    	$this->assertEquals(1, $product->getId());
    	$this->assertEquals(5, $product->getAmount());
    	$this->assertEquals(10, $product->getPrice());
    	$this->assertEquals(50, $product->getGeneralPrice());
    }

    public function testGetAll()
    {
    	$this->cart->add(1, 3);
    	$this->cart->add(5);

    	$products = $this->cart->getAll();

    	$this->assertEquals(1, $products[1]->getId());
    	$this->assertEquals(3, $products[1]->getAmount());
    	$this->assertEquals(10, $products[1]->getPrice());
    	$this->assertEquals(30, $products[1]->getGeneralPrice());

    	$this->assertEquals(5, $products[5]->getId());
    	$this->assertEquals(1, $products[5]->getAmount());
    	$this->assertEquals(50, $products[5]->getPrice());
    	$this->assertEquals(50, $products[5]->getGeneralPrice());
    }

 	public function testClear()
 	{
 		$this->cart->add(1);
 		$this->cart->add(2);
 		$this->cart->clear();

 		$this->assertEquals([], $this->cart->getAll());
 	}

 	public function testSetAmount()
	{
		$this->cart->add(1, 5);
		$this->cart->setAmount(1, 20);

		$this->assertEquals(20, $this->cart->get(1)->getAmount());
	}

 	public function testAmountUpDown()
 	{
 		$this->cart->add(1);
 		$this->cart->amountUp(1);
 		$this->cart->amountUp(1);
 		$this->cart->amountDown(1);

 		$this->assertEquals(2, $this->cart->get(1)->getAmount());
 	}

 	public function testAmountDownIfOne()
 	{
 		$this->cart->add(1);
 		$this->cart->amountDown(1);
 		$this->cart->amountDown(1);

 		$this->assertEquals(1, $this->cart->get(1)->getAmount());
 	}

 	public function testGetGeneralCost()
 	{
 		$this->cart->add(1, 5);
 		$this->cart->add(2, 1);

 		$this->assertEquals(70, $this->cart->getGeneralCost());
 	}
}
