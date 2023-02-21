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
    public function home($name = "abalo" /* version 1 on peut definir la varaible de manière glbale ici*/){
        //return new Response('<h1> Ma première page </h1>');
        /*version 2 soit venir ici et attribuer une valeur*/
        $name = "Charly";
        return $this->render('index.html.twig', ['name' =>$name]);
    }
}
