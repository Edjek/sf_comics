<?php

namespace App\Controller\Admin;

use App\Entity\Licence;
use App\Form\LicenceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminLicenceController extends AbstractController
{
    #[Route('/admin/create/licence', name: 'admin_create_licence')]
    public function createLicence(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $licence = new Licence();

        $licenceForm = $this->createForm(LicenceType::class, $licence);

        $licenceForm->handleRequest($request);

        if ($licenceForm->isSubmitted() && $licenceForm->isValid()) {
            $entityManagerInterface->persist($licence);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Une licence a été créé'
            );

            return $this->redirectToRoute("licence_list");
        }

        return $this->render("admin/admin_licence/licenceform.html.twig", ['licenceForm' => $licenceForm->createView()]);
    }
}
