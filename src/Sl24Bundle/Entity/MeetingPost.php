<?php

namespace Sl24Bundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sl24Bundle\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * MeetingPost
 *
 * @ORM\Table(name="meeting_posts")
 * @ORM\Entity
 */
class MeetingPost
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
     * @ORM\Column(name="meeting_id", type="integer")
     */
    private $meetingID;

    /**
     * @var Meeting
     * @ORM\ManyToOne(targetEntity="Meeting")
     * @ORM\JoinColumn(name="meeting_id", referencedColumnName="id")
     */
    private $meeting;

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
     * @param EntityManager $em
     * @param int $user_id
     * @param int $meeting_id
     * @param object $params
     * @return null|MeetingPost
     */
    public static function addNewPost(EntityManager $em, $user_id, $meeting_id, $params) {
        $meeting = $em->find('Sl24Bundle:Meeting', $meeting_id);
        $user = $em->find('Sl24Bundle:User', $user_id);
        if ($meeting && $user) {
            $post = new MeetingPost();
            $post->setMeeting($meeting);
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
     * @return null|MeetingPost
     */
    public static function editPost(EntityManager $em, $post_id, $user_id, $message) {
        $post = $em->find('Sl24Bundle:MeetingPost', $post_id);
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
     * @return MeetingPost
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
     * Set meetingID
     *
     * @param integer $meetingID
     * @return MeetingPost
     */
    public function setMeetingID($meetingID)
    {
        $this->meetingID = $meetingID;

        return $this;
    }

    /**
     * Get meetingID
     *
     * @return integer 
     */
    public function getMeetingID()
    {
        return $this->meetingID;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return MeetingPost
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
     * @return MeetingPost
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
     * @return MeetingPost
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
     * Set meeting
     *
     * @param \Sl24Bundle\Entity\Meeting $meeting
     * @return MeetingPost
     */
    public function setMeeting(\Sl24Bundle\Entity\Meeting $meeting = null)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting
     *
     * @return \Sl24Bundle\Entity\Meeting 
     */
    public function getMeeting()
    {
        return $this->meeting;
    }
}
