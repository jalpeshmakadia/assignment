<?php

namespace App\Controller\Admin;

use App\Services\ProductManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    /**
     * List all products
     * @param ProductManager $productManager
     * @return Response
     */
    #[Route('/', name: 'app_product_index', methods: ['GET'])]
    public function index(ProductManager $productManager): Response
    {
        /** Getting product from service*/
        $products = $productManager->getProducts();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
