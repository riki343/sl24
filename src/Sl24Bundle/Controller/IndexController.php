<?php

namespace Sl24Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('Sl24Bundle::homepage.html.twig');
    }

    /**
     * @Route("/login")
     * @return Response
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $parameters = array(
            'last_username' => $lastUsername,
            'error' => $error,
        );

        return $this->render('Sl24Bundle::login.html.twig', $parameters);
    }

    /**
     * @Route("/login_check")
     */
    public function loginCheckAction() { }

}
