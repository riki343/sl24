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
     * @ORM\Column(name="client", type="string", length=512)
     */
    private $client;

    /**
     * @var boolean
     * @ORM\Column(name="client_sex", type="boolean", options={"default" = false})
     */
    private $clientSex;

    /**
     * @var string
     * @ORM\Column(name="client_partner", type="string", nullable=true, options={"default" = null})
     */
    private $clientPartner;

    /**
     * @var boolean
     * @ORM\Column(name="client_partner_sex", type="boolean", options={"default" = false})
     */
    private $clientPartnerSex;

    /**
     * @var boolean
     * @ORM\Column(name="maried", type="boolean", options={"default" = false})
     */
    private $maried;

    /**
     * @var boolean
     * @ORM\Column(name="children", type="boolean", options={"default" = false})
     */
    private $children;

    /**
     * @var boolean
     * @ORM\Column(name="in_time", type="boolean", nullable=true, options={"default" = null})
     */
    private $inTime;

    /**
     * @var \DateTime
     * @ORM\Column(name="meeting_date", type="datetime", nullable=true)
     */
    private $meetingDate;

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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="meetings")
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

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="MeetingPost", mappedBy="meeting")
     */
    private $posts;

    public function __construct() {
        $this->setProgress(0);
        $this->meetingDate = null;
        $this->clientPartner = null;
        $this->clientPartnerSex = false;
        $this->clientSex = false;
        $this->maried = false;
        $this->children = false;
        $this->inTime = null;
    }

    public function getInArray() {
        return array(
            'id' => $this->getId(),
            'consultantID' => $this->getConsultantID(),
            'consultant' => $this->getConsultant()->getInArray(),
            'assistant' => ($this->getAssistant())
                ? $this->getAssistant()->getInArray()
                : null,
            'status' => $this->getStatus()->getInArray(),
            'client' => $this->getClient(),
            'clientSex' => ($this->getClientSex()) ? '1' : '0',
            'maried' => $this->getMaried(),
            'partner' => $this->getClientPartner(),
            'partnerSex' => ($this->getClientPartnerSex()) ? '1' : '0',
            'children' => $this->getChildren(),
            'inTime' => $this->getInTime(),
            'meetingDate' => ($this->getMeetingDate())
                ? $this->getMeetingDate()->format('Y-m-d')
                :null,
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
            'clientBirthday' =>
                array(
                    'year' => ($this->getClientBirthday())
                        ? $this->getClientBirthday()->format('Y')
                        :null,
                    'month' => ($this->getClientBirthday())
                        ? $this->getClientBirthday()->format('m')
                        : null,
                    'day' => ($this->getClientBirthday())
                        ? $this->getClientBirthday()->format('d')
                        : null,
                    'date' => ($this->getClientBirthday())
                        ? $this->getClientBirthday()->format('Y-m-d')
                        : null,
                ),
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
        $meeting->setClient($data->credentials);
        $meeting->setDate(\DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($data->date))));
        $meeting->setStatus($meetingStatus);
        $meeting->setConsultant($user);
        if ($data->assistant) {
            /** @var User $assistant */
            $assistant = $em->getRepository('Sl24Bundle:User')->find($data->assistant);
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
            ->find($data->status['id']);
        $employmentType = $em->getRepository('Sl24Bundle:EmploymentType')
            ->find($data->employmentType['id']);

        $meeting->setAge($data->age);
        if ($data->clientBirthday['date'])
        $meeting->setClientBirthday(\DateTime::createFromFormat('Y-m-d',
            date('Y-m-d', strtotime($data->clientBirthday['date']))));
        $meeting->setClient($data->client);
        $meeting->setStatus($status);
        if ($data->assistant) {
            $assistant = $em->getRepository('Sl24Bundle:User')->find($data->assistant);
            $meeting->setAssistant($assistant);
        }
        $meeting->setEmploymentType($employmentType);
        if ($data->date) {
            $meeting->setDate(\DateTime::createFromFormat('Y-m-d',
                date('Y-m-d', strtotime($data->date))));
        }
        $meeting->setPrice($data->price);
        $meeting->setYears($data->years);
        $meeting->setProgress($data->progress);

        $meeting->setClientPartner($data->partner);
        $meeting->setClientPartnerSex($data->partnerSex);
        $meeting->setClientSex($data->clientSex);
        $meeting->setInTime($data->inTime);
        if ($data->meetingDate) {
            $meeting->setMeetingDate(\DateTime::createFromFormat('Y-m-d',
                date('Y-m-d', strtotime($data->meetingDate))));
        }

        $meeting->setMaried($data->maried);
        $meeting->setChildren($data->children);


        if ($data->payDate) {
            $meeting->setPayDate(\DateTime::createFromFormat('Y-m-d',
                date('Y-m-d', strtotime($data->payDate))));
        }

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

    /**
     * Add posts
     *
     * @param \Sl24Bundle\Entity\MeetingPost $posts
     * @return Meeting
     */
    public function addPost(\Sl24Bundle\Entity\MeetingPost $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Sl24Bundle\Entity\MeetingPost $posts
     */
    public function removePost(\Sl24Bundle\Entity\MeetingPost $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set client
     *
     * @param string $client
     * @return Meeting
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set clientSex
     *
     * @param boolean $clientSex
     * @return Meeting
     */
    public function setClientSex($clientSex)
    {
        $this->clientSex = $clientSex;

        return $this;
    }

    /**
     * Get clientSex
     *
     * @return boolean 
     */
    public function getClientSex()
    {
        return $this->clientSex;
    }

    /**
     * Set clientPartner
     *
     * @param string $clientPartner
     * @return Meeting
     */
    public function setClientPartner($clientPartner)
    {
        $this->clientPartner = $clientPartner;

        return $this;
    }

    /**
     * Get clientPartner
     *
     * @return string 
     */
    public function getClientPartner()
    {
        return $this->clientPartner;
    }

    /**
     * Set clientPartnerSex
     *
     * @param boolean $clientPartnerSex
     * @return Meeting
     */
    public function setClientPartnerSex($clientPartnerSex)
    {
        $this->clientPartnerSex = $clientPartnerSex;

        return $this;
    }

    /**
     * Get clientPartnerSex
     *
     * @return boolean 
     */
    public function getClientPartnerSex()
    {
        return $this->clientPartnerSex;
    }

    /**
     * Set maried
     *
     * @param boolean $maried
     * @return Meeting
     */
    public function setMaried($maried)
    {
        $this->maried = $maried;

        return $this;
    }

    /**
     * Get maried
     *
     * @return boolean 
     */
    public function getMaried()
    {
        return $this->maried;
    }

    /**
     * Set children
     *
     * @param boolean $children
     * @return Meeting
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return boolean 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set inTime
     *
     * @param boolean $inTime
     * @return Meeting
     */
    public function setInTime($inTime)
    {
        $this->inTime = $inTime;

        return $this;
    }

    /**
     * Get inTime
     *
     * @return boolean 
     */
    public function getInTime()
    {
        return $this->inTime;
    }

    /**
     * Set meetingDate
     *
     * @param \DateTime $meetingDate
     * @return Meeting
     */
    public function setMeetingDate($meetingDate)
    {
        $this->meetingDate = $meetingDate;

        return $this;
    }

    /**
     * Get meetingDate
     *
     * @return \DateTime 
     */
    public function getMeetingDate()
    {
        return $this->meetingDate;
    }
}
