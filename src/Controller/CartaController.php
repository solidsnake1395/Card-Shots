<?php

namespace App\Controller;
use Symfony\Component\Security\Http\Attribute\IsGranted;

use App\Entity\Carta;
use App\Form\CartaType;
use App\Repository\CartaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/carta')]
#[IsGranted('ROLE_SUPER_ADMIN')]
final class CartaController extends AbstractController
{
    #[Route(name: 'app_carta_index', methods: ['GET'])]
    public function index(CartaRepository $cartaRepository): Response
    {
        return $this->render('carta/index.html.twig', [
            'cartas' => $cartaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_carta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cartum = new Carta();
        $form = $this->createForm(CartaType::class, $cartum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cartum);
            $entityManager->flush();

            return $this->redirectToRoute('app_carta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carta/new.html.twig', [
            'cartum' => $cartum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carta_show', methods: ['GET'])]
    public function show(Carta $cartum): Response
    {
        return $this->render('carta/show.html.twig', [
            'cartum' => $cartum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_carta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carta $cartum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartaType::class, $cartum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_carta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carta/edit.html.twig', [
            'cartum' => $cartum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carta_delete', methods: ['POST'])]
    public function delete(Request $request, Carta $cartum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cartum->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cartum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_carta_index', [], Response::HTTP_SEE_OTHER);
    }
}
