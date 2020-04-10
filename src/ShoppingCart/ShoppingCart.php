<?php

declare(strict_types=1);

namespace App\ShoppingCart;

use App\ShoppingCart\Exceptions\DuplicatedProductInCartException;
use App\ShoppingCart\Exceptions\NoProductInCartException;
use App\ShoppingCart\Exceptions\ProductsLimitExceeded;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use App\Product\Product;

/**
 * @ODM\Document()
 */
class ShoppingCart
{

    private const MAX_PRODUCTS_IN_CART = 4;

    /**
     * @ODM\Id()
     */
    private ?string $id = null;

    /**
     * @ODM\Version
     * @ODM\Field(type="int")
     */
    private int $version = 0;

    /**
     * @ODM\EmbedMany(targetDocument=ShoppingCartItem::class)
     */
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getCartItem(Product $product): ?ShoppingCartItem
    {
        $item = $this->products->filter(function ($item) use ($product) {
                return $item->getProductId() == $product->getId();
            })->first() ?? null;

        return $item ? $item : null;
    }

    public function addProduct(Product $product): void
    {
        if (!is_null($this->getCartItem($product))) {
            throw new DuplicatedProductInCartException("Product already in a cart");
        }

        if ($this->products->count() > self::MAX_PRODUCTS_IN_CART) {
            throw new ProductsLimitExceeded(sprintf("Cart can has only %d products", self::MAX_PRODUCTS_IN_CART));
        }

        $this->products->add(new ShoppingCartItem(
            $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency()
        ));
    }

    public function removeProduct(Product $product): void
    {
        $item = $this->getCartItem($product);

        if (is_null($item)) {
            throw new NoProductInCartException("No product of given type in a cart");
        }

        $this->products->removeElement($item);
    }

    public function getId(): string
    {
        return $this->id;
    }
}