<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminComicsController extends AbstractController
{
    #[Route('/admin/comics', name: 'admin_comics')]
    public function index(): Response
    {
        return $this->render('admin_comics/index.html.twig', [
            'controller_name' => 'AdminComicsController',
        ]);
    }
}
