<?php

namespace Sl24Bundle\Entity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Article
 * @package Sl24Bundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="articles")
 */
class Article
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userID;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     * @ORM\Column(name="article_text", type="string", length=200000)
     */
    private $articleText;

    /**
     * @var string
     * @ORM\Column(name="article_img", type="string", length=255, nullable=true, options={"default" = null})
     */
    private $articleImg;

    /**
     * @var string
     * @ORM\Column(name="article_title", type="string", length=255)
     */
    private $articleTitle;

    /**
     * @var string
     * @ORM\Column(name="key_words", type="string", length=255, nullable=true, options={"default" = null})
     */
    private $keyWords;

    public function __construct() {
        $this->created = new \DateTime();
    }

    /**
     * @param EntityManager $em
     * @param int $user_id
     * @param array $params
     * @return Article
     */
    public static function addNewArticle(EntityManager $em, $user_id, $params)
    {
        $user = $em->getRepository('Sl24Bundle:User')->find($user_id);
        $article = new Article();
        $article->setArticleText($params['text']);
        $article->setArticleTitle($params['title']);
        $article->setUser($user);

        srand((new \DateTime())->format('s'));
        $fs = new Filesystem();
        $random = null;
        while (true) {
            $random = rand(0, 9999999);
            if (!$fs->exists($random . 'jpg')) {
                break;
            }
        }
        /** @var UploadedFile $article_img */
        if($params['img'] == null)
        {
            $article->setArticleImg('notimg');
        }
        else {
            $article_img = $params['img'];

            $article_img->move(__DIR__ . '/../../../web/documents/', $random . '.jpg');
            $article->setArticleImg('documents/' . $random . '.jpg');
        }
        $em->persist($article);
        $em->flush();

        return $article;
    }

    public function getInArray() {
        return array(
            'id' => $this->getId(),
            'userID'=>$this->getUserID(),
            'created' => $this->getCreated()->format('Y-m-d'),
            'articleText' => $this->getArticleText(),
            'articleImg' => $this->getArticleImg(),
            'articleTitle' => $this->getArticleTitle(),
            'keyWords' => $this->getKeyWords(),
        );
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userID
     *
     * @param integer $userID
     * @return Article
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    
        return $this;
    }

    /**
     * Get userID
     *
     * @return integer 
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Article
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set articleText
     *
     * @param string $articleText
     * @return Article
     */
    public function setArticleText($articleText)
    {
        $this->articleText = $articleText;
    
        return $this;
    }

    /**
     * Get articleText
     *
     * @return string 
     */
    public function getArticleText()
    {
        return $this->articleText;
    }

    /**
     * Set articleImg
     *
     * @param string $articleImg
     * @return Article
     */
    public function setArticleImg($articleImg)
    {
        $this->articleImg = $articleImg;
    
        return $this;
    }

    /**
     * Get articleImg
     *
     * @return string 
     */
    public function getArticleImg()
    {
        return $this->articleImg;
    }

    /**
     * Set articleTitle
     *
     * @param string $articleTitle
     * @return Article
     */
    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;
    
        return $this;
    }

    /**
     * Get articleTitle
     *
     * @return string 
     */
    public function getArticleTitle()
    {
        return $this->articleTitle;
    }

    /**
     * Set keyWords
     *
     * @param string $keyWords
     * @return Article
     */
    public function setKeyWords($keyWords)
    {
        $this->keyWords = $keyWords;
    
        return $this;
    }

    /**
     * Get keyWords
     *
     * @return string 
     */
    public function getKeyWords()
    {
        return $this->keyWords;
    }

    /**
     * Set user
     *
     * @param \Sl24Bundle\Entity\User $user
     * @return Article
     */
    public function setUser(\Sl24Bundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Sl24Bundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
