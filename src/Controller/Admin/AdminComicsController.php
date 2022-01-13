<?php

namespace App\Controller\Admin;

use App\Entity\Comics;
use App\Form\ComicsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminComicsController extends AbstractController
{
    #[Route('/admin/create/comics', name: 'admin_create_comics')]
    public function createComics(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $comics = new Comics();

        $comicsForm = $this->createForm(ComicsType::class, $comics);

        $comicsForm->handleRequest($request);

        if ($comicsForm->isSubmitted() && $comicsForm->isValid()) {
            $date = $comicsForm->get('year')->getData();
            $comics->setYear($date);
            $entityManagerInterface->persist($comics);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Un comics a été créé'
            );

            return $this->redirectToRoute("comics_list");
        }

        return $this->render("admin/admin_comics/comicsform.html.twig", ['comicsForm' => $comicsForm->createView()]);
    }
}
