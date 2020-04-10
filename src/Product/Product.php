<?php

declare(strict_types=1);

namespace App\Product;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document()
 */
class Product
{

    /**
     * @ODM\Id()
     */
    private ?string $id = null;

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
     * @ODM\Version
     * @ODM\Field(type="int")
     */
    private int $version = 0;

    public function __construct(Name $name, Price $price, Currency $currency)
    {
        $this->name = $name->get();
        $this->price = $price->get();
        $this->currency = $currency->get();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function rename(Name $name)
    {
        $this->name = $name->get();
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getPrice() : string
    {
        return $this->price;
    }

    public function getCurrency() : string
    {
        return $this->currency;
    }
}