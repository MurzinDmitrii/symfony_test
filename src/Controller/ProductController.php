<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/products', name: 'get_products', methods: ['GET'])]
    public function getProducts(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        return $this->json($products);
    }

    #[Route('/product/{id}', name: 'get_product', methods: ['GET'])]
    public function getProduct(int $id, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);
        
        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }
        
        return $this->json($product);
    }
}
