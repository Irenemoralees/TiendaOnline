<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TiendaController extends AbstractController
{
    #[Route('/article')]
    public function getArticle()
    {
        $article = [
            'name' => 'Ordenador',
            'description' => 'Dispositivo electrónico que procesa datos y ejecuta tareas basadas en instrucciones previamente programadas.',
            'type' => 'Electrónica',
            'price' => '300$',
            'image' => 'https://cdn.sonitron.net/sonitron/2020/03/Lenovo-S145-15AST-ordenadores-menos-300-euros.jpg'
        ];
        return $this->render('articles/article.html.twig', ['article' => $article]);
    }
}
