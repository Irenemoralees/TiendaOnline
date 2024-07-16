<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Entity\Category;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $article-> setPrice(300);
        $article-> setImage('https://cdn.sonitron.net/sonitron/2020/03/Lenovo-S145-15AST-ordenadores-menos-300-euros.jpg');

        $article2 = new Articulo ();
        $article2-> setName('Gorro de lana');
        $article2-> setDescription('HEATTECH GORRO TÉRMICO CANALÉ.');
        $article2-> setPrice(10);
        $article2-> setImage( 'https://image.uniqlo.com/UQ/ST3/WesternCommon/imagesgoods/459725/item/goods_09_459725.jpg?width=722&impolicy=quality_70&imformat=chrome');

        $article3 = new Articulo ();
        $article3-> setName('Pelota de fútbol');
        $article3-> setDescription('adidas Euro 24 Trn.');
        $article3-> setPrice(24.90);
        $article3-> setImage('https://resize.sprintercdn.com/f/384x384/products/0373719/adidas-euro-24_0373719_00_4_1605075126.jpg?w=384&q=75');



$category = new Category();
$category->setType ('Electrónica');

$category2 = new Category();
$category2->setType ('Moda');

$category3 = new Category();
$category3->setType ('Deportes y Aire libre');

$category4 = new Category();
$category4->setType ('Hogar y cocina');

$category5 = new Category();
$category5->setType ('Juguetes y juegos');

$category6 = new Category();
$category6->setType ('Salud y Belleza');

$article->addCategory($category);
$article2->addCategory($category2);
$article3->addCategory($category3);



        $doctrine-> persist($article);
        $doctrine-> persist($article2);
        $doctrine-> persist($article3);

        $doctrine-> persist($category);
        $doctrine-> persist($category2);
        $doctrine-> persist($category3);

        $doctrine->flush();

        return new Response('Artículos insertados correctamente');
    }

    #[Route('/insert/articles', name: 'InsertArticle')]
    public function InsertArticle (EntityManagerInterface $doctrine, Request $request){

        $form = $this-> createForm(ArticleType::class);
        
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid()){
            $article = $form-> getData();
            $doctrine ->persist($article);
            $doctrine ->flush();
        }

        return $this-> render ('articles/newArticle.html.twig', ['articleForm' => $form]);
    }
};
