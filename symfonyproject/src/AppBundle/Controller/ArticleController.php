<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Doctrine\DBAL\ConnectionException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ArticleController
 * @package AppBundle\Controller
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/add",name="add_article")
     */
    public function addAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article,array(
            'action'=>$this->generateUrl('add_article')
        ));
//        handle requests from form page
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//persist the $event
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            //redirect to all articls page

            $em->flush();
            return $this->redirect($this->generateUrl('show_article'));
        }
            return $this->render('@App/Article/add.html.twig', array(
                'form' => $form->createView()));

    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Article:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/show",name="show_article")
     */
    public function showAction(LoggerInterface $logger)
    { $articls= array();
        try{
            $articls=$this->getDoctrine()->getManager()->getRepository(Article::class)
                ->findAll();

        }catch (ConnectionException $exception){
            $logger->error($exception->getMessage());
        }
        return $this->render('@App/Article/show.html.twig', array(
            "articls"=>$articls
        ));
    }

}
