<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Form\ImageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminImageController extends AbstractController
{
    #[Route('/admin/create/image', name: 'admin_create_image')]
    public function createImage(EntityManagerInterface $entityManagerInterface, Request $request, SluggerInterface $sluggerInterface)
    {
        $image = new Image();

        $imageForm = $this->createForm(ImageType::class, $image);

        $imageForm->handleRequest($request);

        if ($imageForm->isSubmitted() && $imageForm->isValid()) {
            // On récupère le fichier
            $imageFile = $imageForm->get('media')->getData();

            if ($imageFile) {

                // On créée un nom unique à notre fichier à partir du nom original
                // Pour éviter tout problème de confusion

                // On récupère le nom original du fichier
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                // On utilise slug sur le nom original pour avoir un nom valide du fichier
                $safeFilename = $sluggerInterface->slug($originalFilename);

                // On ajoute un id unique au nom de l'image
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                // On déplace le fichier dans le dossier public/image
                // la destination du fichier est enregistré dans 'images_directory'
                // qui est défini dans le fichier config\services.yaml

                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $image->setSrc($newFilename);
            }
            $entityManagerInterface->persist($image);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Une image a été créé'
            );

            return $this->redirectToRoute("image_list");
        }

        return $this->render("admin/admin_image/imageform.html.twig", ['imageForm' => $imageForm->createView()]);
    }
}
