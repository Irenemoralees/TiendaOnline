<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController{
    #[Route('/insert/user', name: 'InsertUser')]
    public function InsertArticle (EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher){

        $form = $this-> createForm(UserType::class);
        
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid()){
            $user = $form-> getData();
            $password = $user -> getPassword();
            $passwordCifrada = $hasher -> hashPassword($user, $password);
            $user -> setPassword($passwordCifrada);
            $doctrine ->persist($user);
            $doctrine ->flush();

            $this -> addFlash(type: 'exito', message: 'Registro completado');

           

            return $this-> redirectToRoute(route: 'listArticle');
        }

        return $this-> render ('articles/newArticle.html.twig', ['articleForm' => $form]);
    }


    #[Route('/insert/admin', name: 'InsertAdmin')]
    public function InsertArticleAdmin(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher){

        $form = $this-> createForm(UserType::class);
        
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid()){
            $user = $form-> getData();
            $password = $user -> getPassword();
            $passwordCifrada = $hasher -> hashPassword($user, $password);
            $user -> setPassword($passwordCifrada);
            $user -> setRoles(['ROLE_USER', 'ROLE_ADMIN']);
            $doctrine ->persist($user);
            $doctrine ->flush();

            $this -> addFlash(type: 'exito', message: 'Resgistro de administrador completado');

           

            return $this-> redirectToRoute(route: 'listArticle');
        }

        return $this-> render ('articles/newArticle.html.twig', ['articleForm' => $form]);
    }
};