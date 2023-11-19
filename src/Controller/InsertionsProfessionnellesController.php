<?php

namespace App\Controller;

use App\Repository\InsertionProfessionnelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InsertionsProfessionnellesController extends AbstractController
{
    #[Route('/insertions-professionnelles', name: 'app_insertions_professionnelles')]
    public function index(InsertionProfessionnelleRepository $repository): Response
    {
        $insertions = $repository->findBy([], ['titre' => 'ASC', 'typePro' => 'ASC']);

        return $this->render('insertions_professionnelles/index.html.twig', ['insertions' => $insertions]);
    }
}
