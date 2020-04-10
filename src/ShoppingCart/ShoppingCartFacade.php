<?php

declare(strict_types=1);

namespace App\ShoppingCart;

use App\ShoppingCart\Exceptions\ShoppingCartNotSavedException;
use App\Product\ProductFacade;
use App\ShoppingCart\Exceptions\ShoppingCartNotFoundException;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;

class ShoppingCartFacade
{
    private DocumentManager $dm;
    private ProductFacade $productFacade;

    public function __construct(DocumentManager $dm, ProductFacade $productFacade)
    {
        $this->dm = $dm;
        $this->productFacade = $productFacade;
    }

    public function create() : ShoppingCart
    {
        $newCart = new ShoppingCart();
        $this->dm->persist($newCart);

        try {
            $this->dm->flush();

            return $newCart;
        } catch (MongoDBException $e) {
            throw new ShoppingCartNotSavedException($e->getMessage());
        }
    }

    public function addProduct(string $cartId, string $productId) : void
    {
        $cart = $this->get($cartId);
        $cart->addProduct($this->productFacade->get($productId));
        $this->dm->persist($cart);

        try {
            $this->dm->flush();
        } catch (MongoDBException $e) {
            throw new ShoppingCartNotSavedException($e->getMessage());
        }
    }

    public function removeProduct(string $cartId, string $productId) : void
    {
        $cart = $this->get($cartId);
        $cart->removeProduct($this->productFacade->get($productId));
        $this->dm->persist($cart);

        try {
            $this->dm->flush();
        } catch (MongoDBException $e) {
            throw new ShoppingCartNotSavedException($e->getMessage());
        }
    }

    private function get(string $id): ShoppingCart
    {
        $cart = $this->dm->getRepository(ShoppingCart::class)->find($id);
        if ($cart) {
            return $cart;
        } else {
            throw new ShoppingCartNotFoundException("Shopping cart with id {$id} does not exist");
        }
    }
}