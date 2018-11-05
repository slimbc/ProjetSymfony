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
        return $this->render('AppBundle:Event:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Event:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/update")
     */
    public function updateAction()
    {
        return $this->render('AppBundle:Event:update.html.twig', array(
            // ...
        ));
    }

}
