<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){
//        Create form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // Handle request
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // encode password
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

//            persist user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // todo email + flashbag
            return $this->redirectToRoute('homepage');
        }
        return $this->render(
            '@App/registration/registration.html.twig',
            array('form' => $form->createView())
            );
        }

}
