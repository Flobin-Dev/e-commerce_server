<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductImage;
use App\Entity\ProductSpec;
use App\Entity\Review;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products/", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function create()
    {
        return $this->json([]);
    }

    /**
     * @Route("/products/{id}", methods={"GET"})
     * @param Product $product
     * @return JsonResponse
     */
    public function read(Product $product)
    {
        $reviews = array_map(function (Review $review) {
            return [
                "user" => $review->getUser()->getEmail(),
                "rating" => $review->getRating(),
                "comment" => $review->getComment()
            ];
        }, $product->getReviews()->toArray());

        $images = array_map(function (ProductImage $image) {
            return $image->getUrl();
        }, $product->getImages()->toArray());

        $specs = array_reduce($product->getProductSpecs()->toArray(), function ($carry, ProductSpec $spec) {
            $carry[$spec->getSpec()->getName()] = $spec->getValue();
            return $carry;
        }, []);

        return $this->json([
            "id" => $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "shortDescription" => $product->getShortDescription(),
            "advancedDescription" => $product->getAdvancedDescription(),
            "specs" => $specs,
            "reviews" => $reviews,
            "images" => $images,
            "sku" => $product->getSku()
        ]);
    }

    /**
     * @Route("/products/{id}", methods={"PUT"})
     * @IsGranted("ROLE_ADMIN")
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Product $product)
    {
        return $this->json([]);
    }

    /**
     * @Route("/products/{id}", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     * @param Product $product
     * @return JsonResponse
     */
    public function delete(Product $product)
    {
        return $this->json([]);
    }
}
