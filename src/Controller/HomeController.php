<?php
// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
#[Route('/', name: 'home')]
public function index()
{
    $number = random_int(0, 100);
    $message = "Bienvenido a CardsAndShots!";
    $date = new \DateTime();
    $email = $this->getUser()->getEmail();

    return $this->render('home.html.twig', [
        'number' => $number,
        'message' => $message,
        'date' => $date,
        'email' => $email,
    ]);
}
}
