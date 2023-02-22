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
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('article/index.html.twig', ['articles'=>$articles]);
    }

    /**
     * @Route('/article/{id}', name="article_show")
     */
    public function show($id){
        //return new Response('<h1> Ma première page </h1>');
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('article/detail.html.twig', ['article'=>$article]);
    }

    //  /**
    //  * @Route('/article/save')
    //  */
    // public function save():Response
    // {
    //    $entityManager =  $this->getDoctrine()->getManager();
    //    $prices = [1000, 1500, 2000];
    //    for($i=0; $i<=2;$i++){
    //     $article = new Article();
    //     $article->setNom('Article'.$i);
    //     $article->setPrix($prices[$i]);
    //     $entityManager->persist($article);
    //     $entityManager->flush();
    //    }
    //    return new Response("Articles enregistrés avec succes ");
    // }
    /**
     * @Route('/article/ajouter')
     * Method({"GET","POST"})
     */
    public function new(Request $request){
        $article = new Article();

        $form = $this->createFormBuilder($article)
        ->add('nom', TextType::class)
        ->add('prix', TextType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Creer')
        )->getform();

        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid()){
            $article = $form->getData();
            $entityManager =  $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('article/new.html.twig', ['form' =>$form->createView()]);
    }
    /**
     * @Route('/article/update/{id}', name="article_update")
     * Method({"GET","PUT"})
     */
    public function update(Request $request, $id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $form = $this->createFormBuilder($article)
        ->add('nom', TextType::class)
        ->add('prix', TextType::class)
        ->add('save', SubmitType::class, array(
            'label' => 'Modifier')
        )->getform();

        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid()){
            $article = $form->getData();
            $entityManager =  $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('article/update.html.twig', ['form' =>$form->createView()]);
    }

}
