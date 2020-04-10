<?php

declare(strict_types=1);

namespace App\Product;

use App\Product\Exceptions\ProductNotFoundException;
use App\Product\Exceptions\ProductNotSavedException;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;

class ProductFacade
{

    private DocumentManager $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function create(?string $name, ?string $price, ?string $currency): Product
    {
        $product = new Product(
            new Name($name),
            new Price($price),
            new Currency($currency)
        );
        $this->dm->persist($product);

        try {
            $this->dm->flush();

            return $product;
        } catch (MongoDBException $e) {
            throw new ProductNotSavedException($e->getMessage());
        }
    }

    public function update(string $id, ?string $name): void
    {
        $product = $this->get($id);
        $product->rename(new Name($name));
        $this->dm->persist($product);

        try {
            $this->dm->flush();
        } catch (MongoDBException $e) {
            throw new ProductNotSavedException($e->getMessage());
        }
    }

    public function get(string $id)
    {
        $product = $this->dm->getRepository(Product::class)->find($id);
        if ($product) {
            return $product;
        } else {
            throw new ProductNotFoundException("Product with id {$id} does not exist");
        }
    }
}