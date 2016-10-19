<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=true)
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $salary;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_removed", type="boolean")
     */
    private $isRemoved = false;


    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Address", mappedBy="employee", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $addresses;

    /**
     * @var array
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Phone", mappedBy="employee", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $phones;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->phones = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Employee
     */
    public function setGender($gender)
    {

        if (!is_null($gender)) {
            $gender = strtolower($gender);

            if (!in_array($gender, array('m', 'f'))) {
                throw new \InvalidArgumentException('Invalid gender: ' . $gender);
            }
        }

        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Employee
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Employee
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return Employee
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Activate
     *
     * @return Employee
     */
    public function makeActive()
    {
        $this->isActive = true;

        return $this;
    }

    /**
     * Deactivate
     *
     * @return Employee
     */
    public function makeInactive()
    {
        $this->isActive = false;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * Mark as removed
     *
     * @return Employee
     */
    public function makeRemoved()
    {
        $this->isRemoved = true;

        return $this;
    }

    /**
     * Mark as not removed
     *
     * @return Employee
     */
    public function makeNotRemoved()
    {
        $this->isRemoved = false;

        return $this;
    }

    /**
     * Get isRemoved
     *
     * @return bool
     */
    public function isRemoved()
    {
        return $this->isRemoved;
    }

    /**
     * Add phone
     *
     * @param Phone $phone
     *
     * @return Employee
     */
    public function addPhone(Phone $phone)
    {
        $phone->setEmployee($this);

        $this->phones->add($phone);

        return $this;
    }

    /**
     * Remove phone
     *
     * @param Phone $phone
     *
     * @return Employee
     */
    public function removePhone(Phone $phone)
    {
        $this->phones->removeElement($phone);
        return $this;
    }

    /**
     * Add address
     *
     * @param Address $address
     *
     * @return Employee
     */
    public function addAddress(Address $address)
    {
        $address->setEmployee($this);

        $this->addresses->add($address);

        return $this;
    }

    /**
     * Remove address
     *
     * @param Address $address
     *
     * @return Employee
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);

        return $this;
    }

    /**
     * Get phones
     *
     * @return array|ArrayCollection
     */
    public function getPhones() {

        return $this->phones;
    }

    /**
     * Get addresses
     *
     * @return array|ArrayCollection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}

