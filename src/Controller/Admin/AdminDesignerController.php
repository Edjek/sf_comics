<?php

namespace App\Controller\Admin;

use App\Entity\Designer;
use App\Form\DesignerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDesignerController extends AbstractController
{
    #[Route('/admin/create/designer', name: 'admin_create_designer')]
    public function createDesigner(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $designer = new Designer();

        $designerForm = $this->createForm(DesignerType::class, $designer);

        $designerForm->handleRequest($request);

        if ($designerForm->isSubmitted() && $designerForm->isValid()) {
            $entityManagerInterface->persist($designer);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Un dessinateur a été créé'
            );

            return $this->redirectToRoute("designer_list");
        }

        return $this->render("admin/admin_designer/designerform.html.twig", ['designerForm' => $designerForm->createView()]);
    }
}
