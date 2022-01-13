<?php

namespace App\Controller\Admin;

use App\Entity\Editor;
use App\Form\EditorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEditorController extends AbstractController
{
    #[Route('/admin/create/editor', name: 'admin_create_editor')]
    public function createEditor(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $editor = new Editor();

        $editorForm = $this->createForm(EditorType::class, $editor);

        $editorForm->handleRequest($request);

        if ($editorForm->isSubmitted() && $editorForm->isValid()) {
            $entityManagerInterface->persist($editor);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Un editeur a été créé'
            );

            return $this->redirectToRoute("editor_list");
        }

        return $this->render("admin/admin_editor/editorform.html.twig", ['editorForm' => $editorForm->createView()]);
    }
}
