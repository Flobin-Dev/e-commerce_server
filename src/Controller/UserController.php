<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users/me")
     */
    public function index()
    {
        if ($this->getUser() === null) {
            return $this->json([
                "success" => false
            ]);
        }

        return $this->json([
            "success" => true,
            "email" => $this->getUser()->getEmail()
        ]);
    }
}
