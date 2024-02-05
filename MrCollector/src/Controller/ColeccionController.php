<?php

namespace App\Controller;

use App\Entity\Coleccion;
use App\Form\ColeccionType;
use App\Repository\ColeccionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coleccion')]
class ColeccionController extends AbstractController
{
    #[Route('/', name: 'app_coleccion_index', methods: ['GET'])]
    public function index(ColeccionRepository $coleccionRepository): Response
    {
        return $this->render('coleccion/index.html.twig', [
            'coleccions' => $coleccionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coleccion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coleccion = new Coleccion();
        $form = $this->createForm(ColeccionType::class, $coleccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coleccion);
            $entityManager->flush();

            return $this->redirectToRoute('app_coleccion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coleccion/new.html.twig', [
            'coleccion' => $coleccion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coleccion_show', methods: ['GET'])]
    public function show(Coleccion $coleccion): Response
    {
        return $this->render('coleccion/show.html.twig', [
            'coleccion' => $coleccion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coleccion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coleccion $coleccion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ColeccionType::class, $coleccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coleccion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coleccion/edit.html.twig', [
            'coleccion' => $coleccion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coleccion_delete', methods: ['POST'])]
    public function delete(Request $request, Coleccion $coleccion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coleccion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($coleccion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coleccion_index', [], Response::HTTP_SEE_OTHER);
    }
}
