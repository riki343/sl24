<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Sl24Bundle\Entity\Functions;
use Sl24Bundle\Entity\Meeting;
use Sl24Bundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HomePageController extends Controller {
    /**
     * @Security("has_role('ROLE_USER')")
     * @param $user_id
     * @return JsonResponse
     */
    public function getHomePageInfoAction($user_id = null) {
        $result = array();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = ($user_id)
            ? $em->find('Sl24Bundle:User', $user_id)
            : $this->getUser();
        $result['meetings'] = Meeting::getMeetingsForToday($em, $user->getId());
        $result['tasks'] = Task::getTasksForToday($em, $user->getId());
        $result['birthdays'] = User::getBirthDays($em, $user->getId());
        $result['childs'] = Functions::arrayToJson($user->getChilds());
        $result['user'] = $user->getInArray();
        return new JsonResponse($result);
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param int $user_id
     * @return JsonResponse
     */
    public function getSettingsAction($user_id) {
        $user = $this->getDoctrine()->getRepository('Sl24Bundle:User')->find($user_id);
        return new JsonResponse($user->getInArray());
    }

    /**
     * @param Request $request
     * @param int $user_id
     * @return JsonResponse
     */
    public function saveNewPassAction(Request $request, $user_id) {
        $data = json_decode($request->getContent(), true);
        $data = (object) $data['user'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = User::changePass($em, $user_id, $data);
        return new JsonResponse($user->getInArray());
    }

    /**
     * @param Request $request
     * @param int $user_id
     * @return JsonResponse
     */
    public function saveUserInfoAction(Request $request, $user_id) {
        $data = json_decode($request->getContent(), true);
        $data = (object) $data['user'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = User::changeInfo($em, $user_id, $data);
        return new JsonResponse($user->getInArray());
    }
}