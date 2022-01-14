<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/admin/create/user', name: 'admin_create_user')]
    public function createUser(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $user = new User();

        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Un utilisateur a été créé'
            );

            return $this->redirectToRoute("user_list");
        }

        return $this->render("admin/admin_user/userform.html.twig", ['userForm' => $userForm->createView()]);
    }
}
