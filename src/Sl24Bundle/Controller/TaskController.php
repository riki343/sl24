<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sl24Bundle\Entity\Functions;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function getTasksAction()
    {
        /** @var User $user */
        $user = $this->getUser();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT u FROM Sl24Bundle\Entity\Task u WHERE (u.ownerID = :userID OR u.assignedID = :userID)');
        $query->setParameter('userID', $user->getId());

        $tasks = Functions::arrayToJson($query->getResult());

        return new JsonResponse($tasks);
    }

}