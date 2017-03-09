<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
use AppBundle\Event\ForumNewEvent;
use AppBundle\Form\ForumType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller {

    /**
     * @Route("/foros", name="forum_list")
     */
    public function listAction() {
        $manager = $this->get('doctrine');

        $forums = $manager->getRepository('AppBundle:Forum')->findAll();
        $mostActiveUsers = $manager->getRepository('AppBundle:User')->findMostActiveUsers();

        return $this->render('forum/list.html.twig', [
                    'forums' => $forums,
                    'mostActiveUsers' => $mostActiveUsers,
        ]);
    }

    /**
     * @Route("/foros/nuevo", name="forum_new")
     */
    public function newAction(Request $request) {
        $forum = new Forum();

        $form = $this->createForm(ForumType::class, $forum);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $manager = $this->get('doctrine')->getManager();

                $manager->persist($forum);
                $manager->flush();

                $this->get('event_dispatcher')->dispatch(
                        'forum.created', new ForumNewEvent($forum)
                );

                return $this->redirectToRoute('forum_show', ['slug' => $forum->getSlug()]);
            }
        }

        return $this->render('forum/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/foros/{slug}", name="forum_show")
     */
    public function showAction(Forum $forum) {
        $mostActiveForums = $this->get('doctrine')->getRepository('AppBundle:Forum')->findMostActiveForums();

        return $this->render('forum/show.html.twig', [
                    'forum' => $forum,
                    'mostActiveForums' => $mostActiveForums,
        ]);
    }

}
