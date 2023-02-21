<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
