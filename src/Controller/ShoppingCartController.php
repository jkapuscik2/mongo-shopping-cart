<?php

namespace App\Controller;

use App\Common\HttpStatusCodes;
use App\ShoppingCart\ShoppingCartFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ShoppingCartController extends AbstractController
{
    private ShoppingCartFacade $shoppingCartFacade;

    public function __construct(ShoppingCartFacade $shoppingCartFacade)
    {
        $this->shoppingCartFacade = $shoppingCartFacade;
    }

    public function create()
    {
        $newCart = $this->shoppingCartFacade->create();


        return new Response("", HttpStatusCodes::STATUS_CREATED,
            [
                "Location" => $this->generateUrl("carts_find", [
                    "id" => $newCart->getId()
                ])
            ]);
    }

    public function addProduct(string $cartId, string $productId)
    {
        $this->shoppingCartFacade->addProduct(
            $cartId,
            $productId
        );

        return new Response("", HttpStatusCodes::STATUS_OK_NO_CONTENT);
    }

    public function removeProduct(string $cartId, string $productId)
    {
        $this->shoppingCartFacade->removeProduct(
            $cartId,
            $productId
        );

        return new Response("", HttpStatusCodes::STATUS_OK_NO_CONTENT);
    }

    public function find()
    {
        throw new \App\Common\Exceptions\NotYetImplementedException("Not implemented");
    }
}