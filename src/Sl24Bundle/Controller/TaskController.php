<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sl24Bundle\Entity\Functions;
use Sl24Bundle\Entity\Task;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addTaskAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $data = (object) $data['task'];

        $parameters = array(
            'name' => $data->name,
            'description' => $data->description
        );

        /** @var User $user */
        $user = $this->getUser();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        Task::addTask($em, $user, $parameters);

        return new JsonResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteTaskAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $data = (object) $data;

        /** @var User $user */
        $user = $this->getUser();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        Task::deleteTask($em, $data->task_id);

        return new JsonResponse();
    }

}