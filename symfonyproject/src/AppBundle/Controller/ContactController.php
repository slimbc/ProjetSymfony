<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ContactController
 * @package AppBundle\Controller
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * @Route("/", name="contact_page")
     */
    public function showContactPageAction()
    {
        return $this->render('@App/Contact/contact.html.twig');
    }

    /**
     * @Route("/sendMessage")
     */
    public function sendMessageAction()
    {
        return $this->render('', array(
            // ... todo sendMessage
        ));
    }

}
