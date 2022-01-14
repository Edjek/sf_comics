<?php

namespace App\Controller\Admin;

use App\Entity\Licence;
use App\Form\LicenceType;
use App\Repository\LicenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminLicenceController extends AbstractController
{
    #[Route('/admin/licence', name: 'admin_licence_list')]
    public function comic_list(LicenceRepository $licenceRepository)
    {
        $licences = $licenceRepository->findAll();

        return $this->render('admin/admin_licence/licences.html.twig', [
            'licences' => $licences,
        ]);
    }

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
                'Une licence a été créée'
            );

            return $this->redirectToRoute("admin_licence_list");
        }

        return $this->render("admin/admin_licence/licenceform.html.twig", ['licenceForm' => $licenceForm->createView()]);
    }

    #[Route('/admin/update/licence/{id}', name: 'admin_update_licence')]
    public function updateLicence(
        $id,
        LicenceRepository $licenceRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ) {

        $licence = $licenceRepository->find($id);

        $licenceForm = $this->createForm(LicenceType::class, $licence);

        $licenceForm->handleRequest($request);

        if ($licenceForm->isSubmitted() && $licenceForm->isValid()) {
            $entityManagerInterface->persist($licence);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'La licence a été modifiée'
            );

            return $this->redirectToRoute('admin_licence_list');
        }

        return $this->render("admin/admin_licence/licenceform.html.twig", ['licenceForm' => $licenceForm->createView()]);
    }

    #[Route('/admin/delete/licence/{id}', name: 'admin_delete_licence')]
    public function deleteLicence($id, LicenceRepository $licenceRepository, EntityManagerInterface $entityManagerInterface)
    {
        $licence = $licenceRepository->find($id);

        $entityManagerInterface->remove($licence);

        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'La licence a été supprimée'
        );

        return $this->redirectToRoute("admin_licence_list");
    }
}
