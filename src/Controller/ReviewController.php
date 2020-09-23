<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Review;
use App\Entity\Product;

class ReviewController extends AbstractController
{
    // Decodes the Request from Json to an array
    //
    public function jsonToArray(Request $request)
    {
        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        return $parametersAsArray;
    }

    // After the normalization, loops through the Request
    // to see empty fields and returns errors as an array
    //
    public function errorsDetected(array $request)
    {
        $errors = [];
        foreach($request as $key => $value) {
            if (empty($value)) {
                array_push($errors, "Please enter a value for " . $key);
            }
        }
    }

    /**
     * @Route("/api/products/{id}/reviews", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param Product $product
     * @return Response
     */
    public function addReview(Request $request, EntityManagerInterface $manager, Product $product)
    {
        $user = $this->getUser();
        $request = $this->jsonToArray($request);
        $errors = $this->errorsDetected($request);

        if (!empty($errors)) {
            return $this->json([ "errors" => $errors], 400);
        } else {
            $review = new Review();
            $review->setUser($user);
            $review->setProduct($product);
            $review->setComment($request['comment']);
            $review->setRating($request['rating']);
            $manager->persist($review);
            $manager->flush();

            return $this->json(['success' => true]);
        }
    }
}
