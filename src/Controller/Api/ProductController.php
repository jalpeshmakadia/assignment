<?php

namespace App\Controller\Api;

use App\Services\ProductManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Attributes as OA;


class ProductController extends AbstractFOSRestController
{
    /**
     * List all products in API
     *
     * @param ProductManager $productManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Rest\Get('/api/products', name: 'api_product_list')]
    #[OA\Response(
        response: 200,
        description: 'Returns the list of products',
        content: new OA\JsonContent(
            type: 'object',
            properties:[
                new OA\Property(type:'string', property:'modal'),
                new OA\Property(type:'string', property:'ram'),
                new OA\Property(type:'string', property:'hdd'),
                new OA\Property(type:'string', property:'location'),
                new OA\Property(type:'string', property:'price')
            ]
        )
    )]
    #[OA\Tag(name: 'Products')]
    public function index(ProductManager $productManager)
    {
        /** Getting product from service*/
        $products = $productManager->getProducts();

        /** Creating response view*/
        $view = $this->view($products, 200);
        return $this->handleView($view);
    }
}
