<?php

namespace App\Controller;

use App\Entity\Articulo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TiendaController extends AbstractController
{
    #[Route('/article/{id}', name: 'getArticle')]
    public function getArticle(EntityManagerInterface $doctrine, $id)
    {
        $repository = $doctrine-> getRepository(Articulo::class);
        $article = $repository-> find($id);
        return $this->render('articles/article.html.twig', ['article' => $article]);
    }
    #[Route('/articles', name: 'listArticle')]
    public function aricles(EntityManagerInterface $doctrine)
    {
       
        $repository = $doctrine-> getRepository(Articulo::class);
        $articles = $repository-> findAll();
        return $this->render('articles/articleList.html.twig', ['articles'=> $articles]);
     
    }

    #[Route('/new/articles')]
    public function newArticles (EntityManagerInterface $doctrine)
    {
     
        $article = new Articulo ();
        $article-> setName('Ordenador');
        $article-> setDescription('Dispositivo electrónico que procesa datos y ejecuta tareas basadas en instrucciones previamente programadas');
        $article-> setType('Electrónica');
        $article-> setPrice(300);
        $article-> setImage('https://cdn.sonitron.net/sonitron/2020/03/Lenovo-S145-15AST-ordenadores-menos-300-euros.jpg');

        $article2 = new Articulo ();
        $article2-> setName('Gorro de lana');
        $article2-> setDescription('HEATTECH GORRO TÉRMICO CANALÉ.');
        $article2-> setType('Moda/Complemento');
        $article2-> setPrice(10);
        $article2-> setImage( 'https://image.uniqlo.com/UQ/ST3/WesternCommon/imagesgoods/459725/item/goods_09_459725.jpg?width=722&impolicy=quality_70&imformat=chrome');

        $article3 = new Articulo ();
        $article3-> setName('Pelota de fútbol');
        $article3-> setDescription('adidas Euro 24 Trn.');
        $article3-> setType('Deporte');
        $article3-> setPrice(24.90);
        $article3-> setImage('https://resize.sprintercdn.com/f/384x384/products/0373719/adidas-euro-24_0373719_00_4_1605075126.jpg?w=384&q=75');

        $doctrine-> persist($article);
        $doctrine-> persist($article2);
        $doctrine-> persist($article3);

        $doctrine->flush();

        return new Response('Artículos insertados correctamente');
    }
};
