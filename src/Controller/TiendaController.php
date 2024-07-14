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
    #[Route('/articles')]
    public function aricles()
    {
        $articles = [
            [
                'name' => 'Ordenador',
                'description' => 'Dispositivo electrónico que procesa datos y ejecuta tareas basadas en instrucciones previamente programadas.',
                'type' => 'Electrónica',
                'price' => '300$',
                'image' => 'https://cdn.sonitron.net/sonitron/2020/03/Lenovo-S145-15AST-ordenadores-menos-300-euros.jpg'
            ],
            [
                'name' => 'Gorro de lana',
                'description' => 'HEATTECH GORRO TÉRMICO CANALÉ.',
                'type' => 'Moda/Complemento',
                'price' => '10$',
                'image' => 'https://image.uniqlo.com/UQ/ST3/WesternCommon/imagesgoods/459725/item/goods_09_459725.jpg?width=722&impolicy=quality_70&imformat=chrome'
            ],
            [
                'name' => 'Pelota de fútbol',
                'description' => 'adidas Euro 24 Trn.',
                'type' => 'Deporte',
                'price' => '24.90$',
                'image' => 'https://resize.sprintercdn.com/f/384x384/products/0373719/adidas-euro-24_0373719_00_4_1605075126.jpg?w=384&q=75'
            ]
        ];
        return $this->render('articles/articleList.html.twig', ['articles'=> $articles]);
     
    }
};
