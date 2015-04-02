<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sl24Bundle\Entity\Functions;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TeamController extends Controller
{
    public function GetTeamsAction()
    {
        /** @var User $user */
        $user = $this->getUser();
        return new JsonResponse($user->getChildsListInArray());
    }
}
