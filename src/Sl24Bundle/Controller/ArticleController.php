<?php

namespace Sl24Bundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sl24Bundle\Entity\Functions;
use Sl24Bundle\Entity\User;
use Sl24Bundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getArticlesAction()
    {
        $articles = $this->getDoctrine()->getRepository('Sl24Bundle:Article')->findAll();

        return new JsonResponse(array(
            'articles' => Functions::arrayToJson($articles),
            'user' => $this->getUser()->getInArray()
        ));
    }

    public function getFullArticlesAction($id)
    {
        $article = $this->getDoctrine()->getRepository('Sl24Bundle:Article')->find($id);
        return new JsonResponse(array(
            'article' => $article->getInArray(),
            'user' => $this->getUser()->getInArray()
        ));
    }

    public function addArticlesAction(Request $request)
    {
        $params = array(
            'title' => $request->request->get('article_title'),
            'text' => $request->request->get('article_text'),
            'img' => $request->files->get('article_img'),
            'subtitle' => $request->request->get('article_sub_title'),
        );
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        if($params['title'] != null or $params['text'] != null or $params['subtitle'] != null)
        {
        $article = Article::addNewArticle($em, $user->getId(), $params);
        }
        return $this->redirectToRoute('sl_24_get_articles_page');
    }
}