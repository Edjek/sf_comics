<?php

namespace App\Controller\Front;

use App\Repository\ComicsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComicsController extends AbstractController
{
    #[Route('/comics', name: 'comics_list')]
    public function comic_list(ComicsRepository $comicsRepository)
    {
        $comics = $comicsRepository->findAll();

        return $this->render('front/comics/comics.html.twig', [
            'comics' => $comics,
        ]);
    }

    #[Route('/comic/{id}', name: 'comic_show')]
    public function comicShow($id, ComicsRepository $comicsRepository)
    {
        $comic = $comicsRepository->find($id);
        return $this->render('front/comics/comic.html.twig', [
            'comic' => $comic,
        ]);
    }
}
