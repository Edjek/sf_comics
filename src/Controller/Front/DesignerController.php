<?php

namespace App\Controller\Front;

use App\Repository\DesignerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DesignerController extends AbstractController
{
    #[Route('/designers', name: 'designer_list')]
    public function designer_list(DesignerRepository $designerRepository)
    {
        $designers = $designerRepository->findAll();

        return $this->render('front/designer/designers.html.twig', [
            'designers' => $designers,
        ]);
    }

    #[Route('/designer/{id}', name: 'designer_show')]
    public function designerShow($id, DesignerRepository $designerRepository)
    {
        $designer = $designerRepository->find($id);
        return $this->render('front/designer/designer.html.twig', [
            'designer' => $designer,
        ]);
    }
}
