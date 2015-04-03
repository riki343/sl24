<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sl24Bundle\Entity\Functions;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegistrationController extends Controller
{
    public function registrationAction()
    {
        return new JsonResponse('success!');
    }
}
