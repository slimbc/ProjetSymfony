<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class EventController
 * @package AppBundle\Controller
 * @Route("/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/show", name="show events")
     */
    public function showAction()
    {
        return $this->render('@App/Event/show.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction()
    {
//        TODO oussema : add event
        return $this->render('AppBundle:Event:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
//        TODO oussema : delete event
        return $this->render('AppBundle:Event:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/update")
     */
    public function updateAction()
    {
//        TODO oussema : update event
        return $this->render('AppBundle:Event:update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/search",name="search event")
     */
    public function searchAction(){
//        TODO Oussema : search Event
        return $this->render('AppBundle:Event:update.html.twig', array(
            // ...
        ));
    }
}
