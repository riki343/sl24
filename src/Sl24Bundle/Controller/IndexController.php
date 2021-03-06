<?php

namespace Sl24Bundle\Controller;

use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;


class IndexController extends Controller
{
    /**
     * @Route("/")
     * @return Response
     */
    public function indexAction() {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $parents = array();
            /** @var User $user */
            $user = $this->getUser();
            while ($user->getParent()) {
                $parents[] = $user->getParent()->getInArray();
                $user = $user->getParent();
            }
            return $this->render('Sl24Bundle::homepage.html.twig', array('parents' => $parents));
        }
        return $this->render('@Sl24/wellcome.html.twig');
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
