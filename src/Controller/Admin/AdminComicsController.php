<?php

namespace App\Controller\Admin;

use App\Entity\Comics;
use App\Form\ComicsType;
use App\Repository\ComicsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminComicsController extends AbstractController
{
    #[Route('/admin/comics', name: 'admin_comics_list')]
    public function comic_list(ComicsRepository $comicsRepository)
    {
        $comics = $comicsRepository->findAll();

        return $this->render('admin/admin_comics/comics.html.twig', [
            'comics' => $comics,
        ]);
    }

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

    #[Route('/admin/update/comics/{id}', name: 'admin_update_comics')]
    public function updateComics(
        $id,
        ComicsRepository $comicsRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ) {

        $comics = $comicsRepository->find($id);

        $comicsForm = $this->createForm(ComicsType::class, $comics);

        $comicsForm->handleRequest($request);

        if ($comicsForm->isSubmitted() && $comicsForm->isValid()) {
            $entityManagerInterface->persist($comics);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Le comics a été modifié'
            );

            return $this->redirectToRoute('admin_comics_list');
        }

        return $this->render("admin/admin_comics/comicsform.html.twig", ['comicsForm' => $comicsForm->createView()]);
    }

    #[Route('/admin/delete/comics/{id}', name: 'admin_delete_comics')]
    public function deleteComics($id, ComicsRepository $comicsRepository, EntityManagerInterface $entityManagerInterface)
    {
        $comics = $comicsRepository->find($id);

        $entityManagerInterface->remove($comics);

        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'La comics a été supprimé'
        );

        return $this->redirectToRoute("admin_comics_list");
    }
}
