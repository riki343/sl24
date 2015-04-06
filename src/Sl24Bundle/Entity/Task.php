<?php

namespace Sl24Bundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sl24Bundle\Entity\TaskStatus;
use Sl24Bundle\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Task
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity
 */
class Task
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     * @ORM\Column(name="status_id", type="integer")
     */
    private $statusID;

    /**
     * @ORM\ManyToOne(targetEntity="TaskStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * @var TaskStatus
     */
    private $status;

    /**
     * @var int
     * @ORM\Column(name="owner_id", type="integer")
     */
    private $ownerID;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var int
     * @ORM\Column(name="assigned_id", type="integer")
     */
    private $assignedID;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="assigned_id", referencedColumnName="id")
     */
    private $assigned;

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
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Task
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set statusID
     *
     * @param integer $statusID
     * @return Task
     */
    public function setStatusID($statusID)
    {
        $this->statusID = $statusID;

        return $this;
    }

    /**
     * Get statusID
     *
     * @return integer 
     */
    public function getStatusID()
    {
        return $this->statusID;
    }

    /**
     * Set ownerID
     *
     * @param integer $ownerID
     * @return Task
     */
    public function setOwnerID($ownerID)
    {
        $this->ownerID = $ownerID;

        return $this;
    }

    /**
     * Get ownerID
     *
     * @return integer 
     */
    public function getOwnerID()
    {
        return $this->ownerID;
    }

    /**
     * Set assignedID
     *
     * @param integer $assignedID
     * @return Task
     */
    public function setAssignedID($assignedID)
    {
        $this->assignedID = $assignedID;

        return $this;
    }

    /**
     * Get assignedID
     *
     * @return integer 
     */
    public function getAssignedID()
    {
        return $this->assignedID;
    }

    /**
     * Set status
     *
     * @param \Sl24Bundle\Entity\TaskStatus $status
     * @return Task
     */
    public function setStatus(\Sl24Bundle\Entity\TaskStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Sl24Bundle\Entity\TaskStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set owner
     *
     * @param \Sl24Bundle\Entity\User $owner
     * @return Task
     */
    public function setOwner(\Sl24Bundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \Sl24Bundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set assigned
     *
     * @param \Sl24Bundle\Entity\User $assigned
     * @return Task
     */
    public function setAssigned(\Sl24Bundle\Entity\User $assigned = null)
    {
        $this->assigned = $assigned;

        return $this;
    }

    /**
     * Get assigned
     *
     * @return \Sl24Bundle\Entity\User 
     */
    public function getAssigned()
    {
        return $this->assigned;
    }

    public function getInArray()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'date' => $this->getDate()->format('Y-m-d'),
            'statusID' => $this->getStatusID(),
            'status' => $this->getStatus()->getInArray(),
            'ownerID' => $this->getOwnerID(),
            'owner' => $this->getOwner()->getInArray(),
            'assignedID' => $this->getAssignedID(),
            'assigned' => $this->getAssigned()->getInArray(),
        );
    }

    /**
     * @param EntityManager $em
     * @param User $user
     * @param $parameters
     * @return Task
     */
    public static function addTask($em, $user, $parameters)
    {
        $task = new Task();
        $task->setName($parameters['name']);
        $task->setDescription($parameters['description']);
        $task->setDate(new \DateTime());
        $task->setStatus($em->getRepository('Sl24Bundle:TaskStatus')->find(1));
        $task->setOwner($user);
        $task->setAssigned($user);

        $em->persist($task);
        $em->flush();

        return $task;
    }

    /**
     * @param EntityManager $em
     * @param $parameters
     * @return mixed
     */
    public static function editTask($em, $parameters)
    {
        $task = $em->getRepository('Sl24Bundle:Task')->find($parameters['id']);

        if ($parameters['name'] != $task->getName())
            $task->setName($parameters['name']);

        if ($parameters['statusID'] != $task->getStatusID()){
            $status = $em->getRepository('Sl24Bundle:TaskStatus')->find($parameters['statusID']);
            $task->setStatus($status);
        }

        if ($parameters['description'] != $task->getDescription())
            $task->setDescription($parameters['description']);

        $em->persist($task);
        $em->flush();
        return $task;
    }

    /**
     * @param EntityManager $em
     * @param $task_id
     */
    public static function deleteTask($em, $task_id)
    {
        $task = $em->getRepository('Sl24Bundle:Task')->find($task_id);

        $em->remove($task);
        $em->flush();
    }
}
