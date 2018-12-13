<?php

namespace AppBundle\Controller;

use AppBundle\Service\FileUploader;
use Doctrine\DBAL\ConnectionException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Event;
use AppBundle\Form\EventType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class EventController
 * @package AppBundle\Controller
 * @Route("/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/show", name="show_events")
     */
    public function showAction(LoggerInterface $logger)
    {
        try{
            $events=$this->getDoctrine()->getManager()->getRepository(Event::class)
                ->findBy(array("status"=> true));

        }catch (ConnectionException $exception){
            $logger->error($exception->getMessage());
        }
        return $this->render('@App/Event/show.html.twig', array(
            "events"=>$events
        ));
    }


    /**
     * @Route("/details/{id}", name="show_details_events")
     */
    public function showDetailsAction($id){
        $event=$this->getDoctrine()->getRepository(Event::class)->findOneBy(array('id'=>$id));
        return $this->render('@App/Event/details.html.twig', array(
            'event'=>$event
        ));
    }

    /**
     * @Route("/add", name="add_event")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request,FileUploader $fileUploader)
    {
        $event = new Event();// create new event object to set event from form

        //generate form
        $form = $this->createForm(EventType::class,$event,array(
            'action'=>$this->generateUrl('add_event')
        ));

//        handle requests from form page
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {//if form is submitted & valid
            $file = $event->getImage();//get image from $event

//            generate image name with extension
            $fileName = $fileUploader->upload($file);


            $event->setImage($fileName);//set the new image name

            //persist the $event
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            //redirect to evets page
            return $this->redirect($this->generateUrl('show_events'));
        }

        return $this->render('@App/Event/add.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/delete/{id}",name="delete_event")
     *
     * todo rode admin
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $event=$em->getRepository('AppBundle:Event')->find($id);

        $event->setStatus(false);

        $em->flush();
        $this->addFlash('success', 'Event deleted!');

        return $this->redirectToRoute('show_events');
    }

    /**
     * @Route("/update/{id}", name="update_event")
     */
    public function updateAction(Request $request,$id, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();
        $event=  $em->getRepository(Event::class)->find($id);
        $oldImage=$event->getImage();
        if (empty($event)) {
            return $this->redirectToRoute('404NotFound',array('message'=>"Event not found"));
        }

        //generate form
        $form = $this->createEditForm($event);

        //        handle requests from form page
        $form->handleRequest($request);

        if($form->isSubmitted() && !$event->getImage())
            $event->setImage($oldImage);

        if ($form->isSubmitted() && $form->isValid()) {//if form is submitted & valid
            $file = $event->getImage();
            $event->setImage($fileUploader->upload($file));

            $em->flush();
            $this->addFlash('success', 'Event updated!');

            return $this->redirectToRoute('show_details_events',array('id'=>$id));
        }
            return $this->render('@App/Event/update.html.twig',array('entity'=> $event,'form'=>$form->createView()));
    }

    private function createEditForm(Event $entity)
    {
        $form = $this->createForm(EventType::class, $entity, array(
            'action' => $this->generateUrl('update_event', array('id' => $entity->getId()))
        ));
        $form->add('submit', SubmitType::class, array('label' => 'Update'));
        return $form;
    }

    /**
     * @Route("/search",name="search_event")
     */
    public function searchAction(){
//        TODO Oussema : search Event
        return $this->render('AppBundle:Event:update.html.twig', array(
            // ...
        ));
    }
}