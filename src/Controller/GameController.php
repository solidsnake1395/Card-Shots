<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameController extends AbstractController
{
    #[Route('/home')]
    public function index(): Response
    {
        $number = random_int(0, 100);
        $message = "Bienvenido a CardsAndShots!";
        $date = new \DateTime();

        return $this->render('home.html.twig', [
            'number' => $number,
            'message' => $message,
            'date' => $date,
        ]);
    }
}