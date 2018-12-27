<?php

namespace AppBundle\Controller;

use AppBundle\Entity\email;
use AppBundle\Form\emailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class EmailsController extends Controller
{

    /**
     * @Route("/Mail/send",name="send-mail")
     */
    public function addAction()
    {
        $e = new email();
        $form = $this->createForm(emailType::class,$e,array('action'=>$this->generateUrl('add_mail')));
        return $this->render('@App/Emails/add.html.twig',array('form'=>$form->createView()));
    }


    /**
     * @Route("/Mail/add",name="add_mail")
     */
    public function addmail(Request $req,\Swift_Mailer $mailer)
    {

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('slim.chaaben2@gmail.com')
            ->setTo('slim.chaaben2@gmail.com')
            ->setBody('slim test');
        $mailer->send($message);

        $e = new email();
        $form  =$this->createForm(emailType::class,$e);
        $e = new email();
        $form = $this->createForm(emailType::class,$e);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $e->setDate(new \DateTime('now'));
            $e->setCreater($user);
            $em->persist($e);
            $em->flush();
        }


        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

}
