<?php

namespace Sl24Bundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Filesystem\Filesystem;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Sl24Bundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registered", type="datetime")
     */
    private $registered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastactive", type="datetime")
     */
    private $lastactive;

    /**
     * @var boolean
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     * @var ArrayCollection $roles
     */
    protected $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true, options={"default" = null})
     */
    private $avatar;

    /**
     * @var int
     * @ORM\Column(name="parent_id", type="integer", nullable=true, options={"default" = null})
     */
    private $parentID;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="childs")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="User", mappedBy="parent")
     */
    private $childs;

    /**
     * @var int
     * @ORM\Column(name="sl_number", type="integer")
     */
    private $slNumber;

    /**
     * @var \DateTime
     * @ORM\Column(name="deal_date", type="date")
     */
    private $dealDate;

    /**
     * @var @var \DateTime
     * @ORM\Column(name="first_seminar", type="date")
     */
    private $firstSeminar;

    /**
     * @var int
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var int
     * @ORM\Column(name="team_score")
     */
    private $teamScore;

    /**
     * @var int
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var boolean
     * @ORM\Column(name="parker", type="boolean")
     */
    private $parker;

    /**
     * @var boolean
     * @ORM\Column(name="diary", type="boolean")
     */
    private $diary;

    /**
     * @var boolean
     * @ORM\Column(name="cufflinks", type="boolean")
     */
    private $cufflinks;

    /**
     * @var boolean
     * @ORM\Column(name="watches", type="boolean")
     */
    private $watches;

    /**
     * @var int
     * @ORM\Column(name="director_number", type="integer")
     */
    private $directorNumber;

    public function getInArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'username' => $this->getUsername(),
            'directorNumber' => $this->getDirectorNumber(),
            'email' => $this->getEmail(),
            'level' => $this->getLevel(),
            'parentID' => $this->getParentID(),
            'slNumber' => $this->getSlNumber(),
            'score' => $this->getScore(),
            'teamScore' => $this->getTeamScore(),
            'dealDate' => $this->getDealDate()->format('Y-m-d'),
            'cufflinks' => $this->getCufflinks(),
            'diary' => $this->getDiary(),
            'watches' => $this->getWatches(),
            'parker' => $this->getParker(),
            'firstSeminar' => $this->getFirstSeminar()->format('Y-m-d'),
        );
    }

    public function getChildsListInArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'username' => $this->getUsername(),
            'directorNumber' => $this->getDirectorNumber(),
            'email' => $this->getEmail(),
            'level' => $this->getLevel(),
            'parentID' => $this->getParentID(),
            'slNumber' => $this->getSlNumber(),
            'score' => $this->getScore(),
            'teamScore' => $this->getTeamScore(),
            'dealDate' => $this->getDealDate()->format('Y-m-d'),
            'cufflinks' => $this->getCufflinks(),
            'diary' => $this->getDiary(),
            'watches' => $this->getWatches(),
            'parker' => $this->getParker(),
            'firstSeminar' => $this->getFirstSeminar()->format('Y-m-d'),
            'childs' => Functions::arrayToJson($this->getChilds()),
        );
    }

    public function __construct()
    {
        $this->active = true;
        $this->salt = md5(uniqid(null, true));
        $this->roles = new ArrayCollection();
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return '7v8b6ghjb6834bdkjndsjb233409fjvsiu8892d';
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->name,
            $this->surname,
            $this->registered,
            $this->lastactive,
            $this->active
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->name,
            $this->surname,
            $this->registered,
            $this->lastactive,
            $this->active) = unserialize($serialized);
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() { }


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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set registered
     *
     * @param \DateTime $registered
     * @return User
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;

        return $this;
    }

    /**
     * Get registered
     *
     * @return \DateTime 
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Set lastactive
     *
     * @param \DateTime $lastactive
     * @return User
     */
    public function setLastactive($lastactive)
    {
        $this->lastactive = $lastactive;

        return $this;
    }

    /**
     * Get lastactive
     *
     * @return \DateTime 
     */
    public function getLastactive()
    {
        return $this->lastactive;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add roles
     *
     * @param \Sl24Bundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\Sl24Bundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Sl24Bundle\Entity\Role $roles
     */
    public function removeRole(\Sl24Bundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Set parentID
     *
     * @param integer $parentID
     * @return User
     */
    public function setParentID($parentID)
    {
        $this->parentID = $parentID;

        return $this;
    }

    /**
     * Get parentID
     *
     * @return integer 
     */
    public function getParentID()
    {
        return $this->parentID;
    }

    /**
     * Set slNumber
     *
     * @param integer $slNumber
     * @return User
     */
    public function setSlNumber($slNumber)
    {
        $this->slNumber = $slNumber;

        return $this;
    }

    /**
     * Get slNumber
     *
     * @return integer 
     */
    public function getSlNumber()
    {
        return $this->slNumber;
    }

    /**
     * Set dealDate
     *
     * @param \DateTime $dealDate
     * @return User
     */
    public function setDealDate($dealDate)
    {
        $this->dealDate = $dealDate;

        return $this;
    }

    /**
     * Get dealDate
     *
     * @return \DateTime 
     */
    public function getDealDate()
    {
        return $this->dealDate;
    }

    /**
     * Set firstSeminar
     *
     * @param \DateTime $firstSeminar
     * @return User
     */
    public function setFirstSeminar($firstSeminar)
    {
        $this->firstSeminar = $firstSeminar;

        return $this;
    }

    /**
     * Get firstSeminar
     *
     * @return \DateTime 
     */
    public function getFirstSeminar()
    {
        return $this->firstSeminar;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return User
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set teamScore
     *
     * @param string $teamScore
     * @return User
     */
    public function setTeamScore($teamScore)
    {
        $this->teamScore = $teamScore;

        return $this;
    }

    /**
     * Get teamScore
     *
     * @return string 
     */
    public function getTeamScore()
    {
        return $this->teamScore;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return User
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set parker
     *
     * @param boolean $parker
     * @return User
     */
    public function setParker($parker)
    {
        $this->parker = $parker;

        return $this;
    }

    /**
     * Get parker
     *
     * @return boolean 
     */
    public function getParker()
    {
        return $this->parker;
    }

    /**
     * Set diary
     *
     * @param boolean $diary
     * @return User
     */
    public function setDiary($diary)
    {
        $this->diary = $diary;

        return $this;
    }

    /**
     * Get diary
     *
     * @return boolean 
     */
    public function getDiary()
    {
        return $this->diary;
    }

    /**
     * Set cufflinks
     *
     * @param boolean $cufflinks
     * @return User
     */
    public function setCufflinks($cufflinks)
    {
        $this->cufflinks = $cufflinks;

        return $this;
    }

    /**
     * Get cufflinks
     *
     * @return boolean 
     */
    public function getCufflinks()
    {
        return $this->cufflinks;
    }

    /**
     * Set watches
     *
     * @param boolean $watches
     * @return User
     */
    public function setWatches($watches)
    {
        $this->watches = $watches;

        return $this;
    }

    /**
     * Get watches
     *
     * @return boolean 
     */
    public function getWatches()
    {
        return $this->watches;
    }

    /**
     * Set directorNumber
     *
     * @param integer $directorNumber
     * @return User
     */
    public function setDirectorNumber($directorNumber)
    {
        $this->directorNumber = $directorNumber;

        return $this;
    }

    /**
     * Get directorNumber
     *
     * @return integer 
     */
    public function getDirectorNumber()
    {
        return $this->directorNumber;
    }

    /**
     * Set parent
     *
     * @param \Sl24Bundle\Entity\User $parent
     * @return User
     */
    public function setParent(\Sl24Bundle\Entity\User $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Sl24Bundle\Entity\User 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add childs
     *
     * @param \Sl24Bundle\Entity\User $childs
     * @return User
     */
    public function addChild(\Sl24Bundle\Entity\User $childs)
    {
        $this->childs[] = $childs;

        return $this;
    }

    /**
     * Remove childs
     *
     * @param \Sl24Bundle\Entity\User $childs
     */
    public function removeChild(\Sl24Bundle\Entity\User $childs)
    {
        $this->childs->removeElement($childs);
    }

    /**
     * Get childs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChilds()
    {
        return $this->childs;
    }
}
