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
    public function registrationAction(Request $request) {
        $data = json_decode($request->getContent(), true);
        $parameters = (object)$data['info'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        $director = $em->getRepository('Sl24Bundle:User')->findOneBy(array('slNumber' => $parameters->parent));
        if (!$director) return new JsonResponse(-3);
        if ($user->getLevel() >= 3 && $parameters->pass == $parameters->rpass) {

            $encoderFactory = $this->get('security.encoder_factory');
            try {
                User::addUser($em, $encoderFactory, $parameters);
            } catch (\Exception $ex) {
                return new JsonResponse(-1);
            }
            return new JsonResponse(1);
        } else {
            return new JsonResponse(-2);
        }
    }
}
