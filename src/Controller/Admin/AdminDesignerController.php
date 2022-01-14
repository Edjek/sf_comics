<?php

namespace App\Controller\Admin;

use App\Entity\Designer;
use App\Form\DesignerType;
use App\Repository\DesignerRepository;
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

        /**
     * @Route("admin/update/designer/{id}", name="update_designer")
     */
    public function updateDesigner(
        $id,
        DesignerRepository $designerRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ) {

        $designer = $designerRepository->find($id);

        $designerForm = $this->createForm(DesignerType::class, $designer);

        $designerForm->handleRequest($request);

        if ($designerForm->isSubmitted() && $designerForm->isValid()) {
            $entityManagerInterface->persist($designer);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Le dessinateur a été modifié'
            );

            return $this->redirectToRoute('designer_list');
        }

        return $this->render("admin/admin_designer/designerform.html.twig", ['designerForm' => $designerForm->createView()]);
    }

    #[Route('/admin/delete/designer/{id}', name: 'admin_delete_designer')]
    public function deleteDesigner($id, DesignerRepository $designerRepository, EntityManagerInterface $entityManagerInterface)
    {
        $designer = $designerRepository->find($id);

        $entityManagerInterface->remove($designer);

        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'La dessinateur a été supprimé'
        );

        return $this->redirectToRoute("designer_list");
    }
}
