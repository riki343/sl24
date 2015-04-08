<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Sl24Bundle\Entity\WorkingMonth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MounthController extends Controller
{
    public function addMounthAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $data = (object)$data['mounth'];

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        WorkingMonth::addMounth($em, $data);

        return new JsonResponse();
    }
}
