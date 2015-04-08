<?php

namespace Sl24Bundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sl24Bundle\Controller\MounthController;
use Sl24Bundle\Entity\User;

/**
 * WorkingMonth
 *
 * @ORM\Table(name="working_months")
 * @ORM\Entity
 */
class WorkingMonth
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
     * @var \DateTime
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="end_date", type="date")
     */
    private $endDate;

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
     * @return WorkingMonth
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return WorkingMonth
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return WorkingMonth
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param EntityManager $em
     * @param $data
     */
    public static function addMounth($em, $data)
    {
        $mounth = new WorkingMonth();

        $mounth->setName($data->name);
        $mounth->setStartDate(\DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($data->startDate))));
        $mounth->setEndDate(\DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($data->endDate))));

        $em->persist($mounth);
        $em->flush();
    }
}
