<?php

namespace Sl24Bundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sl24Bundle\Entity\MeetingStatus;
use Sl24Bundle\Entity\User;
use Sl24Bundle\Entity\EmploymentType;

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
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
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
     * @ORM\Column(name="assistant_id", type="integer", nullable=true, options={"default" = null})
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
     * @ORM\Column(name="price", type="float", nullable=true, options={"default" = null})
     */
    private $price;

    /**
     * @var int
     * @ORM\Column(name="years", type="integer", nullable=true, options={"default" = null})
     */
    private $years;

    /**
     * @var int
     * @ORM\Column(name="progress", type="integer", options={"default" = 0})
     */
    private $progress;

    /**
     * @var int
     * @ORM\Column(name="age", type="integer", nullable=true, options={"default" = null})
     */
    private $age;

    /**
     * @var int
     * @ORM\Column(name="employment_type", type="integer")
     */
    private $employmentTypeID;

    /**
     * @var EmploymentType
     * @ORM\ManyToOne(targetEntity="EmploymentType")
     * @ORM\JoinColumn(name="employment_type", referencedColumnName="id")
     */
    private $employmentType;

    /**
     * @var \DateTime
     * @ORM\Column(name="pay_date", type="date", nullable=true, options={"default" = null})
     */
    private $payDate;

    /**
     * @var int
     * @ORM\Column(name="working_month_id", type="integer", nullable=true, options={"default" = null})
     */
    private $workingMonthID;

    /**
     * @var \DateTime
     * @ORM\Column(name="client_birthday", type="date", nullable=true, options={"default" = null})
     */
    private $clientBirthday;

    public function __construct() {
        $this->setProgress(0);
    }

    public function getInArray() {
        return array(
            'id' => $this->getId(),
            'credentials' => $this->getCredentials(),
            'consultantID' => $this->getConsultantID(),
            'consultant' => $this->getConsultant()->getInArray(),
            'assistantID' => $this->getAssistantID(),
            'status' => $this->getStatus()->getInArray(),
            'employmentType' => $this->getEmploymentType()->getInArray(),
            'date' => $this->getDate()->format('Y-m-d'),
            'price' => $this->getPrice(),
            'years' => $this->getYears(),
            'progress' => $this->getProgress(),
            'age' => $this->getAge(),
            'payDate' => ($this->getPayDate())
                ? $this->getPayDate()->format('Y-m-d')
                : null,
            'workingMonthID' => $this->getWorkingMonthID(),
            'clientBirthday' => ($this->getClientBirthday())
                ? array(
                    'year' => $this->getClientBirthday()->format('Y'),
                    'month' => $this->getClientBirthday()->format('m'),
                    'day' => $this->getClientBirthday()->format('d'),
                    'date' => $this->getClientBirthday()->format('Y-m-d'),
                )
                : null,
        );
    }

    /**
     * @param EntityManager $em
     * @param User $user
     * @param object $data
     * @return Meeting
     */
    public static function addNewMeeting(EntityManager $em, User $user, $data) {
        $meetingStatus = $em->getRepository('Sl24Bundle:MeetingStatus')->find($data->status);
        $employmentType = $em->getRepository('Sl24Bundle:EmploymentType')->find($data->employmentType);
        $meeting = new Meeting();
        $meeting->setCredentials($data->credentials);
        $meeting->setDate(\DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($data->date))));
        $meeting->setStatus($meetingStatus);
        $meeting->setConsultant($user);
        if ($data->assistant) {
            /** @var User $assistant */
            $assistant = $em->getRepository('User')->find($data->$assistant);
            $meeting->setAssistant($assistant);
        }
        $meeting->setEmploymentType($employmentType);
        /*
         * Working month
         */
        $em->persist($meeting);
        $em->flush();

        return $meeting;
    }

    /**
     * @param EntityManager $em
     * @param int $meeting_id
     * @param object $data
     * @return Meeting
     */
    public static function editInfo(EntityManager $em, $meeting_id, $data) {
        $meeting = $em->getRepository('Sl24Bundle:Meeting')->find($meeting_id);
        $status = $em->getRepository('Sl24Bundle:MeetingStatus')
            ->find($data->status->id);
        $employmentType = $em->getRepository('Sl24Bundle:EmploymentType')
            ->find($data->employmentType->id);

        $meeting->setAge($data->age);
        $meeting->setClientBirthday($data->clientBirthday->date);
        $meeting->setCredentials($data->credentials);
        $meeting->setStatus($status);
        if ($data->$assistant) {
            $assistant = $em->getRepository('Sl24Bundle:User')->find($data->assistant);
            $meeting->setAssistant($assistant);
        }
        $meeting->setEmploymentType($employmentType);
        $meeting->setDate($data->date);
        $meeting->setPrice($data->price);
        $meeting->setYears($data->years);
        $meeting->setProgress($data->progress);
        /*
         * working Month
         */
        $meeting->setPayDate($data->payDate);

        $em->persist($meeting);
        $em->flush();

        return $meeting;
    }

    /**
     * @param EntityManager $em
     * @param int $meeting_id
     */
    public static function removeMeeting(EntityManager $em, $meeting_id) {
        $meeting = $em->getRepository('Sl24Bundle:Meeting')->find($meeting_id);
        $em->remove($meeting);
        $em->flush();
    }

    public static function getMeetingsInfo(EntityManager $em, User $user) {
        $assistants = array();
        $tempUser = $user;
        while ($tempUser->getParent() != null) {
            $assistants[] = $tempUser->getParent()->getInArray();
            $tempUser = $tempUser->getParent();
        }

        $statuses = Functions::arrayToJson(
            $em->getRepository('Sl24Bundle:MeetingStatus')->findAll()
        );

        $employmentTypes = Functions::arrayToJson(
            $em->getRepository('Sl24Bundle:EmploymentType')->findAll()
        );

        return array(
            'assistants' => $assistants,
            'statuses' => $statuses,
            'employmentTypes' => $employmentTypes,
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
     * Set credentials
     *
     * @param string $credentials
     * @return Meeting
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * Get credentials
     *
     * @return string 
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set statusID
     *
     * @param integer $statusID
     * @return Meeting
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
     * Set date
     *
     * @param \DateTime $date
     * @return Meeting
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
     * Set consultantID
     *
     * @param integer $consultantID
     * @return Meeting
     */
    public function setConsultantID($consultantID)
    {
        $this->consultantID = $consultantID;

        return $this;
    }

    /**
     * Get consultantID
     *
     * @return integer 
     */
    public function getConsultantID()
    {
        return $this->consultantID;
    }

    /**
     * Set assistantID
     *
     * @param integer $assistantID
     * @return Meeting
     */
    public function setAssistantID($assistantID)
    {
        $this->assistantID = $assistantID;

        return $this;
    }

    /**
     * Get assistantID
     *
     * @return integer 
     */
    public function getAssistantID()
    {
        return $this->assistantID;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Meeting
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set years
     *
     * @param integer $years
     * @return Meeting
     */
    public function setYears($years)
    {
        $this->years = $years;

        return $this;
    }

    /**
     * Get years
     *
     * @return integer 
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * Set progress
     *
     * @param integer $progress
     * @return Meeting
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return integer 
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Meeting
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set employmentTypeID
     *
     * @param integer $employmentTypeID
     * @return Meeting
     */
    public function setEmploymentTypeID($employmentTypeID)
    {
        $this->employmentTypeID = $employmentTypeID;

        return $this;
    }

    /**
     * Get employmentTypeID
     *
     * @return integer 
     */
    public function getEmploymentTypeID()
    {
        return $this->employmentTypeID;
    }

    /**
     * Set payDate
     *
     * @param \DateTime $payDate
     * @return Meeting
     */
    public function setPayDate($payDate)
    {
        $this->payDate = $payDate;

        return $this;
    }

    /**
     * Get payDate
     *
     * @return \DateTime 
     */
    public function getPayDate()
    {
        return $this->payDate;
    }

    /**
     * Set workingMonthID
     *
     * @param integer $workingMonthID
     * @return Meeting
     */
    public function setWorkingMonthID($workingMonthID)
    {
        $this->workingMonthID = $workingMonthID;

        return $this;
    }

    /**
     * Get workingMonthID
     *
     * @return integer 
     */
    public function getWorkingMonthID()
    {
        return $this->workingMonthID;
    }

    /**
     * Set clientBirthday
     *
     * @param \DateTime $clientBirthday
     * @return Meeting
     */
    public function setClientBirthday($clientBirthday)
    {
        $this->clientBirthday = $clientBirthday;

        return $this;
    }

    /**
     * Get clientBirthday
     *
     * @return \DateTime 
     */
    public function getClientBirthday()
    {
        return $this->clientBirthday;
    }

    /**
     * Set consultant
     *
     * @param \Sl24Bundle\Entity\User $consultant
     * @return Meeting
     */
    public function setConsultant(\Sl24Bundle\Entity\User $consultant = null)
    {
        $this->consultant = $consultant;

        return $this;
    }

    /**
     * Get consultant
     *
     * @return \Sl24Bundle\Entity\User 
     */
    public function getConsultant()
    {
        return $this->consultant;
    }

    /**
     * Set assistant
     *
     * @param \Sl24Bundle\Entity\User $assistant
     * @return Meeting
     */
    public function setAssistant(\Sl24Bundle\Entity\User $assistant = null)
    {
        $this->assistant = $assistant;

        return $this;
    }

    /**
     * Get assistant
     *
     * @return \Sl24Bundle\Entity\User 
     */
    public function getAssistant()
    {
        return $this->assistant;
    }

    /**
     * Set employmentType
     *
     * @param EmploymentType $employmentType
     * @return Meeting
     */
    public function setEmploymentType(EmploymentType $employmentType = null)
    {
        $this->employmentType = $employmentType;

        return $this;
    }

    /**
     * Get employmentType
     *
     * @return EmploymentType 
     */
    public function getEmploymentType()
    {
        return $this->employmentType;
    }

    /**
     * Set status
     *
     * @param \Sl24Bundle\Entity\MeetingStatus $status
     * @return Meeting
     */
    public function setStatus(MeetingStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Sl24Bundle\Entity\MeetingStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
