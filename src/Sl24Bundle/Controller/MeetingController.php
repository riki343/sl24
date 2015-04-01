<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sl24Bundle\Entity\Functions;

class MeetingController extends Controller
{
    /**
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

    public function editMeetingAction(Request $request, $meeting_id) {
        $data = json_decode($request->getContent(), true);
        $data = (object)$data['meeting'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $meeting = Meeting::editInfo($em, $meeting_id, $data);
        return new JsonResponse($meeting->getInArray());
    }
}