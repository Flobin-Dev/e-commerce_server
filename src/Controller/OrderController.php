<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\ProductImage;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Ramsey\Uuid\Uuid;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/orders/", name="order")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param ProductRepository $productRepository
     * @return Response
     * @throws ApiErrorException
     */
    public function create(Request $request, EntityManagerInterface $manager, ProductRepository $productRepository)
    {
        $requestData = json_decode($request->getContent());
        $requestProducts = $requestData->orderProducts;

        $order = new Order();
        $order->setOrderUuid(Uuid::uuid4());
        $manager->persist($order);
        $manager->flush();

        $baseClientCallbackUrl = "http://localhost:3000/checkout/" . $order->getOrderUuid()->toString();

        $stripeProducts = array_map(function ($v) use ($productRepository) {
            $productEntity = $productRepository->find($v->productId);
            $images = array_map(function (ProductImage $image) {
                return $image->getUrl();
            }, $productEntity->getImages()->toArray());

            return [
                "name" => $productEntity->getName(),
                "description" => $productEntity->getShortDescription(),
                "amount" => round($productEntity->getPrice() * 100),
                "currency" => "EUR",
                "quantity" => $v->quantity,
                "images" => $images
            ];
        }, $requestProducts);

        $stripeSessionData = [
            "success_url" => $baseClientCallbackUrl . "/success",
            "cancel_url" => $baseClientCallbackUrl . "/failure",
            "payment_method_types" => ["card"],
            "line_items" => $stripeProducts
        ];

        Stripe::setApiKey("sk_test_OARvJPyc8Ckn8xbFM7UxgNLu00vpkP4pnM");
        $stripeSessionResult = Session::create($stripeSessionData);

        $order->setStripeSessionId($stripeSessionResult["id"]);
        $manager->persist($order);
        $manager->flush();

        return $this->json(["success" => true, "stripe_session_id" => $stripeSessionResult["id"]]);
    }

    /**
     * @Route("/orders/{orderUuid}/result", methods={"GET"})
     * @param Order $orderEntity
     * @return JsonResponse
     */
    public function getResult(Order $orderEntity)
    {
        return $this->json(["success" => true]);
    }
}
