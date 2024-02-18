<?php

namespace App\Controller;

use App\Entity\Sorteo;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(UserRepository $userRepository): Response
    {
        $usuario = $this->getUser();

        $assignedUserId = $usuario->getUsuarioAsignado()->getId();
        $assignedUser = $userRepository->find($assignedUserId);

        $sorteo = $assignedUser->getSorteos()->first();
        $presupuestoSorteo = $sorteo ? $sorteo->getPresupuestoRegalo() : null;

        return $this->render('main/index.html.twig', [
            'user' => $usuario,
            'assignedUser' => $assignedUser,
            'presupuestoSorteo' => $presupuestoSorteo,
        ]);
    }
}
