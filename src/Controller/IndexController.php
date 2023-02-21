<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class IndexController extends AbstractController
{
    /**
     * @Route('/{name}')
     */
    public function home(){
        //return new Response('<h1> Ma première page </h1>');
        $articles = ['Article1', 'Article2', 'Article3'];
        return $this->render('article/index.html.twig', ['articles'=>$articles]);
    }

    /**
     * @Route('/article/{id}')
     */
    public function getOne($id){
        //return new Response('<h1> Ma première page </h1>');
        $articles = ['Article1', 'Article2', 'Article3'];
        $onearticle = $articles[$id];
        return $this->render('article/detail.html.twig', ['article'=>$onearticle]);
    }
    /**
     * @Route('/article/save')
     */
    public function save():Response
    {
       $entityManager =  $this->getDoctrine()->getManager();

       $article = new Article();
       $article->setNom('Article 1');
       $article->setPrix(1000);

       $entityManager->persist($article);
       $entityManager->flush();

       return new Response("Article enregistrer avec l'id " . $article->getId());
    }
}
