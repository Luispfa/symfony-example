<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PostController extends Controller
{
    /**
     * @Route("/foros/{slug}/nuevo", name="post_new")
     */
    public function newAction(Request $request, $slug)
    {
        $post = new Post();
        $manager = $this->getDoctrine()->getManager();
        $forum = $manager->getRepository('AppBundle:Forum')
                ->findOneBy(['slug'=>$slug]);
        
        if($forum == null){
            throw $this->createNotFoundException('Forum not found');
        }
        
        $form = $this->createFormBuilder($post)
                ->add('content')
                ->add('submit', SubmitType::class)
                ->getForm();
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                $post->setAuthor($this->getUser());
                $post->setForum($forum);
                
                $manager->persist($post);
                $manager->flush();
                
                return $this->redirectToRoute('forum_show', ['slug'=> $slug]);
            }
        }
        
        return $this->render(':post:new.html.twig',[
            'forum'=> $forum,
            'form'=> $form->createView()
        ]);
    }
}
