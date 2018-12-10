<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Comment:delete.html.twig', array(
            // ...
        ));
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
