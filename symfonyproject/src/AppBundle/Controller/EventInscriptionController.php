<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Inscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EventInscriptionController extends Controller
{

    /**
     * @Route("/event/register/{id}")
     */
    public function registerAction($id){

        $em=$this->getDoctrine()->getManager();


        $event = $em->getRepository(Event::class)->find($id);
        $user = $this->getUser();

        $inscription = $em->getRepository(Inscription::class)->findOneBy(array('event'=>$event,'user'=>$user ));
        if($inscription==null){
            $inscription = new Inscription();
            $inscription->setEvent($event)->setUser($user);
            $em->persist($inscription);
            $em->flush();
            $this->addFlash('success', 'registered!');
        }else
            $this->addFlash('failure', 'already registered!');

        return $this->redirectToRoute('show_details_events', array('id'=>$id));
    }
}