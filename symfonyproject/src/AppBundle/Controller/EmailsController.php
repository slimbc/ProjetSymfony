<?php

namespace AppBundle\Controller;

use AppBundle\Entity\email;
use AppBundle\Entity\Event;
use AppBundle\Entity\User;
use Psr\Log\LoggerInterface;
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


            $users= array();
            $u = null;
            $users=$this->getDoctrine()->getRepository(User::class)->findAll();
            foreach($users as $u)
            {
                $message = (new \Swift_Message($e->getObject()))
                    ->setFrom('nategprojet@gmail.com')
                    ->setTo($u->getEmail())
                    ->setBody($e->getContent());
                $mailer->send($message);
            }
            $em->flush();
        }


        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }



    /**
     * @Route("/mail/show",name="show_mail")
     */
    public function showAction(LoggerInterface $logger)
    {       $mails= array();
            $mails=$this->getDoctrine()->getRepository(email::class)
                ->findAll();
            return $this->render('@App/Emails/Show.html.twig', array(
            "mails"=>$mails
        ));
    }



}
