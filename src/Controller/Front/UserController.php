<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/sign-up', name: 'sign-up')]
    public function createUser(EntityManagerInterface $entityManagerInterface, Request $request, 
    UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $user = new User();

        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $user->setRoles(["ROLE_USER"]);

            $plainPassWord = $userForm->get('password')->getData();
            $hashedPassword = $userPasswordHasherInterface->hashPassword($user, $plainPassWord);
            $user->setPassword($hashedPassword);

            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Un utilisateur a été créé'
            );

            return $this->redirectToRoute("app_login");
        }

        return $this->render("admin/admin_user/userform.html.twig", ['userForm' => $userForm->createView()]);
    }
}
