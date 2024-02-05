<?php

namespace App\Controller;

use App\Entity\Oleada;
use App\Form\OleadaType;
use App\Repository\OleadaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/oleada')]
class OleadaController extends AbstractController
{
    #[Route('/', name: 'app_oleada_index', methods: ['GET'])]
    public function index(OleadaRepository $oleadaRepository): Response
    {
        return $this->render('oleada/index.html.twig', [
            'oleadas' => $oleadaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_oleada_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $oleada = new Oleada();
        $form = $this->createForm(OleadaType::class, $oleada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($oleada);
            $entityManager->flush();

            return $this->redirectToRoute('app_oleada_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('oleada/new.html.twig', [
            'oleada' => $oleada,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_oleada_show', methods: ['GET'])]
    public function show(Oleada $oleada): Response
    {
        return $this->render('oleada/show.html.twig', [
            'oleada' => $oleada,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_oleada_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Oleada $oleada, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OleadaType::class, $oleada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_oleada_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('oleada/edit.html.twig', [
            'oleada' => $oleada,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_oleada_delete', methods: ['POST'])]
    public function delete(Request $request, Oleada $oleada, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$oleada->getId(), $request->request->get('_token'))) {
            $entityManager->remove($oleada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_oleada_index', [], Response::HTTP_SEE_OTHER);
    }
}
