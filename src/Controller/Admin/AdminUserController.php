<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    #[Route('/admin/user', name: 'user_list')]
    public function user_list(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('admin/admin_user/users.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('admin/user/{id}', name: 'user_show')]
    public function userShow($id, UserRepository $usersRepository)
    {
        $user = $usersRepository->find($id);
        return $this->render('admin/admin_user/user.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/admin/update/user/{id}', name: 'admin_update_user')]
    public function updateUser(
        $id,
        UserRepository $userRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ) {

        $user = $userRepository->find($id);

        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'L\'utilisateur a été modifié'
            );

            return $this->redirectToRoute('user_list');
        }

        return $this->render("admin/admin_user/userform.html.twig", ['userForm' => $userForm->createView()]);
    }

    #[Route('/admin/delete/user/{id}', name: 'admin_delete_user')]
    public function deleteUser($id, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface)
    {
        $user = $userRepository->find($id);

        $entityManagerInterface->remove($user);

        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'L\'utilisateur a été supprimé'
        );

        return $this->redirectToRoute("main");
    }
}
