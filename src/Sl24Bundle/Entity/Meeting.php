<?php

namespace Sl24Bundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sl24Bundle\Entity\MeetingStatus;
use Sl24Bundle\Entity\User;

/**
 * Task
 *
 * @ORM\Table(name="meetings")
 * @ORM\Entity
 */
class Meeting
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
     * @var string
     *
     * @ORM\Column(name="credentials", type="string", length=512)
     */
    private $credentials;

    /**
     * @var int
     * @ORM\Column(name="status_id", type="integer")
     */
    private $statusID;

    /**
     * @var MeetingStatus
     * @ORM\ManyToOne(targetEntity="MeetingStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName"id")
     */
    private $status;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     * @ORM\Column(name="consultant_id", type="integer")
     */
    private $consultantID;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="consultant_id", referencedColumnName="id")
     */
    private $consultant;

    /**
     * @var int
     * @ORM\Column(name="assistant_id", type="integer")
     */
    private $assistantID;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="assistant_id", referencedColumnName="id")
     */
    private $assistant;

    /**
     * @var float
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     * @ORM\Column(name="years", type="integer")
     */
    private $years;

    /**
     * @var int
     * @ORM\Column(name="progress", type="integer")
     */
    private $progress;
}