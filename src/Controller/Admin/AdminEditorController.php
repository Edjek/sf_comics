<?php

namespace App\Controller\Admin;

use App\Entity\Editor;
use App\Form\EditorType;
use App\Repository\EditorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEditorController extends AbstractController
{
    #[Route('/admin/editor', name: 'admin_editor_list')]
    public function comic_list(EditorRepository $editorRepository)
    {
        $editors = $editorRepository->findAll();

        return $this->render('admin/admin_editor/editors.html.twig', [
            'editors' => $editors,
        ]);
    }

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

            return $this->redirectToRoute("admin_editor_list");
        }

        return $this->render("admin/admin_editor/editorform.html.twig", ['editorForm' => $editorForm->createView()]);
    }


    #[Route('/admin/update/editor/{id}', name: 'admin_update_editor')]
    public function updateEditor(
        $id,
        EditorRepository $editorRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ) {

        $editor = $editorRepository->find($id);

        $editorForm = $this->createForm(EditorType::class, $editor);

        $editorForm->handleRequest($request);

        if ($editorForm->isSubmitted() && $editorForm->isValid()) {
            $entityManagerInterface->persist($editor);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'L\'editeur a été modifié'
            );

            return $this->redirectToRoute('admin_editor_list');
        }

        return $this->render("admin/admin_editor/editorform.html.twig", ['editorForm' => $editorForm->createView()]);
    }

    #[Route('/admin/delete/editor/{id}', name: 'admin_delete_editor')]
    public function deleteEditor($id, EditorRepository $editorRepository, EntityManagerInterface $entityManagerInterface)
    {
        $editor = $editorRepository->find($id);

        $entityManagerInterface->remove($editor);

        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'L\'editeur a été supprimé'
        );

        return $this->redirectToRoute("admin_editor_list");
    }
}
