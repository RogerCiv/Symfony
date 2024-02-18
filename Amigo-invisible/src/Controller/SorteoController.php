<?php

namespace App\Controller;

use App\Entity\Sorteo;
use App\Entity\User;
use App\Form\SorteoType;
use App\Repository\SorteoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sorteo')]
class SorteoController extends AbstractController
{
    #[Route('/', name: 'app_sorteo_index', methods: ['GET'])]
    public function index(SorteoRepository $sorteoRepository): Response
    {
        return $this->render('sorteo/index.html.twig', [
            'sorteos' => $sorteoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sorteo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sorteo = new Sorteo();
        $form = $this->createForm(SorteoType::class, $sorteo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sorteo);
            $entityManager->flush();

            return $this->redirectToRoute('app_sorteo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorteo/new.html.twig', [
            'sorteo' => $sorteo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sorteo_show', methods: ['GET'])]
    public function show(Sorteo $sorteo): Response
    {
        return $this->render('sorteo/show.html.twig', [
            'sorteo' => $sorteo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sorteo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sorteo $sorteo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SorteoType::class, $sorteo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sorteo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorteo/edit.html.twig', [
            'sorteo' => $sorteo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sorteo_delete', methods: ['POST'])]
    public function delete(Request $request, Sorteo $sorteo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sorteo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sorteo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sorteo_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/reparto/{id}', name: 'app_sorteo_manual', methods: ['POST'])]
public function realizarRepartoManual(Sorteo $sorteo, EntityManagerInterface $entityManager): Response
{
    // Verifica si el reparto ya se ha realizado
    if ($sorteo->getUsuarios()->isEmpty()) {
        $this->realizarReparto($sorteo, $entityManager);

        $entityManager->persist($sorteo);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_sorteo_show', ['id' => $sorteo->getId()], Response::HTTP_SEE_OTHER);
}


private function realizarReparto(Sorteo $sorteo, EntityManagerInterface $entityManager): void
{
    // Obtén la lista de usuarios desde la base de datos
    $usuarios = $entityManager->getRepository(User::class)->findAll();

    // Baraja aleatoriamente la lista de usuarios
    shuffle($usuarios);

    // Realiza el reparto
    $totalUsuarios = count($usuarios);

    // Asegurarse de que todos los usuarios estén emparejados
    if ($totalUsuarios % 2 !== 0) {
        // Agregar un usuario ficticio si el número de usuarios es impar
        $usuarios[] = null;
        $totalUsuarios++;
    }

    // Crear un array para registrar los usuarios emparejados
    $usuariosEmparejados = [];

    // Iterar sobre la mitad del array para emparejar
    for ($i = 0; $i < $totalUsuarios; $i++) {
        // Asegurarse de que el usuario actual no esté emparejado
        do {
            $usuarioEmparejado = $usuarios[array_rand($usuarios)];
        } while (in_array($usuarioEmparejado, $usuariosEmparejados));

        // Añadir a la lista de emparejados
        $usuariosEmparejados[] = $usuarioEmparejado;

        $usuario = $usuarios[$i];

        // Asigna el usuario emparejado como receptor del regalo
        $sorteo->addUsuario($usuarioEmparejado);

        // Actualiza el presupuesto del usuario actual
        if ($usuario !== null) {
            // $presupuestoActual = $usuario->getPresupuesto();
            // $nuevoPresupuesto = $presupuestoActual - $sorteo->getPresupuestoRegalo();
            
            // $usuario->setPresupuesto($nuevoPresupuesto);
            $usuario->setPresupuesto($sorteo->getPresupuestoRegalo());

            // Establece la relación usuario_asignado directamente
            $usuario->setUsuarioAsignado($usuarioEmparejado);

            // Persiste la entidad Usuario
            $entityManager->persist($usuario);
        }
    }

    // Persiste la entidad Sorteo
    $entityManager->flush();
}




}
