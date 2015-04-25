<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Sl24Bundle\Entity\Meeting;
use Sl24Bundle\Entity\MeetingPost;
use Sl24Bundle\Entity\TaskPost;
use Sl24Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sl24Bundle\Entity\Functions;

class TaskPostController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @param int $task_id
     * @return JsonResponse
     */
    public function getPostsAction($task_id) {
        $task = $this->getDoctrine()->getRepository('Sl24Bundle:Task')->find($task_id);
        return new JsonResponse(Functions::arrayToJson($task->getPosts()));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param int $task_id
     * @return JsonResponse
     */
    public function addPostAction(Request $request, $task_id) {
        $data = json_decode($request->getContent(), true);
        $data = (object) $data['post'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        /** @var MeetingPost $post */
        $post = TaskPost::addNewPost($em, $user->getId(), $task_id, $data);
        return new JsonResponse(($post) ? $post->getInArray() : null);
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param int $post_id
     * @return JsonResponse
     */
    public function editPostAction(Request $request, $post_id) {
        $data = json_decode($request->getContent(), true);
        $data = (object) $data['post'];
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        /** @var MeetingPost $post */
        $post = TaskPost::editPost($em, $post_id, $user->getId(), $data->message);
        return new JsonResponse(($post) ? $post->getInArray() : null);
    }
}