<?php

namespace App\Controller;

use App\Entity\Fabricante;
use App\Form\FabricanteType;
use App\Repository\FabricanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fabricante')]
class FabricanteController extends AbstractController
{
    #[Route('/', name: 'app_fabricante_index', methods: ['GET'])]
    public function index(FabricanteRepository $fabricanteRepository): Response
    {
        return $this->render('fabricante/index.html.twig', [
            'fabricantes' => $fabricanteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fabricante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fabricante = new Fabricante();
        $form = $this->createForm(FabricanteType::class, $fabricante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fabricante);
            $entityManager->flush();

            return $this->redirectToRoute('app_fabricante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fabricante/new.html.twig', [
            'fabricante' => $fabricante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fabricante_show', methods: ['GET'])]
    public function show(Fabricante $fabricante): Response
    {
        return $this->render('fabricante/show.html.twig', [
            'fabricante' => $fabricante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fabricante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fabricante $fabricante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FabricanteType::class, $fabricante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fabricante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fabricante/edit.html.twig', [
            'fabricante' => $fabricante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fabricante_delete', methods: ['POST'])]
    public function delete(Request $request, Fabricante $fabricante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fabricante->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fabricante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fabricante_index', [], Response::HTTP_SEE_OTHER);
    }
}
