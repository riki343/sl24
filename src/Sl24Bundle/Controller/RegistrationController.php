<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sl24Bundle\Entity\Functions;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    public function registrationAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $parameters = (object)$data['info'];
        /** @var User $user */
        $user = $this->getUser();
        if ($request->getMethod() == 'POST' && $user->getLevel() >= 3
            && $parameters->pass == $parameters->rpass) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $encoderFactory = $this->get('security.encoder_factory');
            User::addUser($em, $encoderFactory, $parameters);
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }
}
