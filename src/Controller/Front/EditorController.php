<?php

namespace App\Controller\Front;

use App\Repository\EditorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditorController extends AbstractController
{
    #[Route('/editors', name: 'editor_list')]
    public function editor_list(EditorRepository $editorRepository)
    {
        $editors = $editorRepository->findAll();

        return $this->render('front/editor/editors.html.twig', [
            'editors' => $editors,
        ]);
    }

    #[Route('/editor/{id}', name: 'editor_show')]
    public function editorShow($id, EditorRepository $editorRepository)
    {
        $editor = $editorRepository->find($id);
        return $this->render('front/editor/editor.html.twig', [
            'editor' => $editor,
        ]);
    }
}
