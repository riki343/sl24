<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Sl24Bundle\Entity\Meeting;
use Sl24Bundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomePageController extends Controller {
    /**
     * @Security("has_role('ROLE_USER')")
     * @return JsonResponse
     */
    public function getHomePageInfoAction() {
        $result = array();
        $user_id = $this->getUser()->getId();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $result['meetings'] = Meeting::getMeetingsForToday($em, $user_id);
        $result['tasks'] = Task::getTasksForToday($em, $user_id);
        $result['birthdays'] = Meeting::getMeetingsForToday($em, $user_id);
        return new JsonResponse($result);
    }
}