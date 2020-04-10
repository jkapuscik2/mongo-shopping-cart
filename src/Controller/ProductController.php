<?php

namespace App\Controller;

use App\Common\HttpStatusCodes;
use App\Exceptions\NotYetImplementedException;
use App\Product\ProductFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{

    private ProductFacade $productFacade;

    public function __construct(ProductFacade $productFacade)
    {
        $this->productFacade = $productFacade;
    }

    public function create(Request $request)
    {
        $newProduct = $this->productFacade->create(
            $request->get("name"),
            $request->get("price"),
            $request->get("currency")
        );

        return new Response("", HttpStatusCodes::STATUS_CREATED,
            [
                "Location" => $this->generateUrl("products_find", [
                    "id" => $newProduct->getId()
                ])
            ]);
    }

    public function update(string $id, Request $request)
    {
        $this->productFacade->update(
            $id,
            $request->get("name")
        );

        return new Response("", HttpStatusCodes::STATUS_OK_NO_CONTENT);

    }

    public function find()
    {
        throw new \App\Common\Exceptions\NotYetImplementedException("Not implemented");
    }

}