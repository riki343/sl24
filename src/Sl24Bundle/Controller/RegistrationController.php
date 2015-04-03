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
        /** @var User $user */
        $user = $this->getUser();
        if ($request->getMethod() == 'POST' && $user->getLevel() >= 3) {
            $data = json_decode($request->getContent(), true);
            $data = (object)$data['info'];
            $em = $this->getDoctrine()->getManager();

            //User::addNewUser($em, $data);
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }
}
