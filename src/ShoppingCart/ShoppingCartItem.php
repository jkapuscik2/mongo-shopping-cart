<?php

namespace App\ShoppingCart;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/**
 * @ODM\EmbeddedDocument()
 */
class ShoppingCartItem
{
    /**
     * @ODM\Id()
     */
    private ?string $id = null;

    /**
     * @ODM\Field(type="string")
     */
    private string $productId;

    /**
     * @ODM\Field(type="string")
     */
    private string $name;

    /**
     * @ODM\Field(type="string")
     */
    private string $price;

    /**
     * @ODM\Field(type="string")
     */
    private string $currency;

    /**
     * @ODM\Field(type="date")
     */
    private DateTime $created;

    public function __construct(
        string $productId,
        string $name,
        string $price,
        string $currency
    )
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
        $this->currency = $currency;
        $this->created = new DateTime();
    }

    public function getProductId(): string
    {
        return $this->productId;
    }
}