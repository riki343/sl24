<?php

namespace Sl24Bundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sl24Bundle\Entity\TaskStatus;
use Sl24Bundle\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * TaskPost
 *
 * @ORM\Table(name="task_posts")
 * @ORM\Entity
 */
class TaskPost
{
    /**
     * @var integer
     *
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
     * @var int
     * @ORM\Column(name="task_id", type="integer")
     */
    private $taskID;

    /**
     * @var Task
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="posts")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     */
    private $task;

    /**
     * @var string
     * @ORM\Column(name="message", length=2000)
     */
    private $message;

    /**
     * @var \DateTime
     * @ORM\Column(name="posted", type="datetime")
     */
    private $posted;

    public function __construct() {
        $this->posted = new \DateTime();
    }

    /**
     * @return array
     */
    public function getInArray() {
        return array(
            'id' => $this->getId(),
            'user' => $this->getUser()->getInArray(),
            'taskID' => $this->getTaskID(),
            'message' => $this->getMessage(),
            'posted' => ($this->getPosted())
                ? $this->getPosted()->format('Y-m-d')
                : null,
        );
    }

    /**
     * @param EntityManager $em
     * @param int $user_id
     * @param int $task_id
     * @param object $params
     * @return null|MeetingPost
     */
    public static function addNewPost(EntityManager $em, $user_id, $task_id, $params) {
        $task = $em->find('Sl24Bundle:Task', $task_id);
        $user = $em->find('Sl24Bundle:User', $user_id);
        if ($task && $user) {
            $post = new TaskPost();
            $post->setTask($task);
            $post->setMessage($params->message);
            $post->setUser($user);
            $em->persist($post);
            $em->flush();
            return $post;
        }
        return null;
    }

    /**
     * @param EntityManager $em
     * @param int $post_id
     * @param int $user_id
     * @param string $message
     * @return null|TaskPost
     */
    public static function editPost(EntityManager $em, $post_id, $user_id, $message) {
        $post = $em->find('Sl24Bundle:TaskPost', $post_id);
        if ($post && $post->getUserID() == $user_id) {
            $post->setMessage($message);
            $em->persist($post);
            $em->flush();
            return $post;
        }
        return null;
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
     * @return TaskPost
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
     * Set taskID
     *
     * @param integer $taskID
     * @return TaskPost
     */
    public function setTaskID($taskID)
    {
        $this->taskID = $taskID;

        return $this;
    }

    /**
     * Get taskID
     *
     * @return integer 
     */
    public function getTaskID()
    {
        return $this->taskID;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return TaskPost
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set posted
     *
     * @param \DateTime $posted
     * @return TaskPost
     */
    public function setPosted($posted)
    {
        $this->posted = $posted;

        return $this;
    }

    /**
     * Get posted
     *
     * @return \DateTime 
     */
    public function getPosted()
    {
        return $this->posted;
    }

    /**
     * Set user
     *
     * @param \Sl24Bundle\Entity\User $user
     * @return TaskPost
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

    /**
     * Set task
     *
     * @param \Sl24Bundle\Entity\Task $task
     * @return TaskPost
     */
    public function setTask(\Sl24Bundle\Entity\Task $task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \Sl24Bundle\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }
}
