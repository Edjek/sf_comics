<?php

namespace App\Controller\Admin;

use App\Entity\Writer;
use App\Form\WriterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminWriterController extends AbstractController
{
    #[Route('/admin/create/writer', name: 'admin_create_writer')]
    public function createWriter(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $writer = new Writer();

        $writerForm = $this->createForm(WriterType::class, $writer);

        $writerForm->handleRequest($request);

        if ($writerForm->isSubmitted() && $writerForm->isValid()) {
            $entityManagerInterface->persist($writer);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Une marque a été créé'
            );

            return $this->redirectToRoute("writer_list");
        }

        return $this->render("admin/admin_writer/writerform.html.twig", ['writerForm' => $writerForm->createView()]);
    }
}
