<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Form\ArticleType;
use AppBundle\Form\CommentType;
use Doctrine\DBAL\ConnectionException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Class ArticleController
 * @package AppBundle\Controller
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/add",name="add_article")
     */
    public function addAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article,array(
            'action'=>$this->generateUrl('add_article')
        ));
//        handle requests from form page
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//persist the $event
            $em = $this->getDoctrine()->getManager();
            $article->setCreater("hassen");
            $em->persist($article);
            //redirect to all articls page

            $em->flush();
            return $this->redirect($this->generateUrl('show_article'));
        }
            return $this->render('@App/Article/add.html.twig', array(
                'form' => $form->createView()));

    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Article:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/show",name="show_article")
     */
    public function showAction(LoggerInterface $logger)
    { $articls= array();
        try{
            $articls=$this->getDoctrine()->getManager()->getRepository(Article::class)
                ->findAll();

        }catch (ConnectionException $exception){
            $logger->error($exception->getMessage());
        }
        return $this->render('@App/Article/show.html.twig', array(
            "articls"=>$articls
        ));
    }


    /**
     * @Route("/showdetails/{id}",name="show_article_details")
     */
    public function showdetailsAction($id,Request $request)
    {  $article=$this->getDoctrine()->getRepository(Article::class)->findOneBy(array('id'=>$id));
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(array('article_id'=>$id));
        $comment=new Comment();
        try{
            $form= $this->createForm(CommentType::class,$comment,array(
                'action'=>$this->generateUrl('show_article_details',array("id" => $id))
            ));
            $form->handleRequest($request);
for ($c=0;$c<sizeof($comments);$c++) {
    try{
$comments[$c]->setDatte($comments[$c]->getDateEcriture().date_format());
    }catch (\Exception $e){

    }
}
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $comment->setWriter("hassen");
                $comment->setArticleId($id);
                $time= (new \DateTime('now'));
                $comment->setDateEcriture(new \DateTime('now'));
                //$comment->setDatte(strlen($time));
                $em->persist($comment);
                $em->flush();

            }
            return $this->render('@App/Article/details.html.twig', array(
                'article'=>$article,'form' => $form->createView(),'comments'=>$comments
            ));
        }
        catch (ConnectionException $exception){
            return $this->render('@App/Article/details.html.twig', array(
                'article'=>$article
            ));
        }
    }

}
