<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class CommentController
 * @package AppBundle\Controller
 * @Route("/comment")
 */
class CommentController extends Controller
{
    /**
     * @Route("/add",name="add_comment")
     */
    public function addAction(Request $request)
    {
       $comment = new Comment();
        $form = $this->createForm(CommentType::class,$comment,array(
            'action'=>$this->generateUrl('add_comment')
        ));
        //        handle requests from form page
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        //persist the $event
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            //redirect to all articls page

            $em->flush();
            return $this->redirect($this->generateUrl('show_comment'));
        }
        return $this->render('@App/Comment/show.html.twig', array(
            'form' => $form->createView()));

    }

    /**
     * @Route("/delete/{id}/{article}",name="delete_comment")
     */
    public function deleteAction($id,$article)
    {
       $comment= $this->getDoctrine()->getRepository(Comment::class)->findOneBy(array('id'=>$id))->setState(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        //redirect to all articls page

        $em->flush();

        return $this->redirect($this->generateUrl('show_article_details',array("id" => $article)));
    }

    /**
     * @Route("/show",name="show_comment")
     */
    public function showAction()
    {
        return $this->render('AppBundle:Comment:show.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/modify")
     */
    public function modifyAction()
    {
        return $this->render('AppBundle:Comment:modify.html.twig', array(
            // ...
        ));
    }

}
