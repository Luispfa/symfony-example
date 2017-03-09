<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller {

    /**
     * @Route("/perfil/{username}", name="profile_show")
     */
    public function showAction(Request $request) {
        $manager = $this->get('doctrine');
        $user = $manager->getRepository('AppBundle:User')->findOneBy(['username' => $request->get('username')]);
        
        return $this->render('profile/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/perfil", name="profile_edit")
     */
    public function editAction() {
        return $this->render('profile/edit.html.twig');
    }

}
