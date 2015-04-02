<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Sl24Bundle\Entity\Meeting;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sl24Bundle\Entity\Functions;

class MeetingController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @param string|int $user_id
     * @return JsonResponse
     */
    public function getMeetingsAction($user_id) {
        if ($user_id === "user_id") {
            $user_id = $this->getUser()->getId();
        }
        $meetings = $this->getDoctrine()->getRepository('Sl24Bundle:Meeting')
            ->findBy(array('consultantID' => $user_id), array('date' => 'DESC'));
        $meetings = Functions::arrayToJson($meetings);
        return new JsonResponse($meetings);
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param int $meeting_id
     * @return JsonResponse
     */
    public function getMeetingAction($meeting_id) {
        $meeting = $this->getDoctrine()->getRepository('Sl24Bundle:Meeting')
            ->find($meeting_id);
        return new JsonResponse($meeting->getInArray());
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @return JsonResponse
     */
    public function addNewMeetingAction(Request $request) {
        $data = json_decode($request->getContent(), true);
        $data = (object)$data['meeting'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        Meeting::addNewMeeting($em, $user, $data);
        return new JsonResponse('success');
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param int $meeting_id
     * @return JsonResponse
     */
    public function editMeetingAction(Request $request, $meeting_id) {
        $data = json_decode($request->getContent(), true);
        $data = (object)$data['meeting'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $meeting = Meeting::editInfo($em, $meeting_id, $data);
        return new JsonResponse($meeting->getInArray());
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @return JsonResponse
     */
    public function getMeetingsInfoAction() {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        return new JsonResponse(Meeting::getMeetingsInfo($em, $user));
    }
}