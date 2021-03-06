<?php

namespace WorkersManager\MngrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shedule
 *
 * @ORM\Table(name="shedule")
 * @ORM\Entity(repositoryClass="WorkersManager\MngrBundle\Repository\SheduleRepository")
 */
class Shedule
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
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer")
     */
    private $month;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fromDay", type="datetime")
     */
    private $fromDay;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="toDay", type="datetime")
     */
    private $toDay;

    /**
     * @var int
     *
     * @ORM\Column(name="hours", type="integer")
     */
    private $hours;
    
    /**
     *@ORM\ManyToOne(targetEntity="Employee", inversedBy="shedules")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     * @var type 
     */
    private $employee;


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
     * Set year
     *
     * @param integer $year
     * @return Shedule
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set month
     *
     * @param integer $month
     * @return Shedule
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer 
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set fromDay
     *
     * @param \DateTime $fromDay
     * @return Shedule
     */
    public function setFromDay($fromDay)
    {
        $this->fromDay = $fromDay;

        return $this;
    }

    /**
     * Get fromDay
     *
     * @return \DateTime 
     */
    public function getFromDay()
    {
        return $this->fromDay;
    }

    /**
     * Set toDay
     *
     * @param \DateTime $toDay
     * @return Shedule
     */
    public function setToDay($toDay)
    {
        $this->toDay = $toDay;

        return $this;
    }

    /**
     * Get toDay
     *
     * @return \DateTime 
     */
    public function getToDay()
    {
        return $this->toDay;
    }

    /**
     * Set hours
     *
     * @param integer $hours
     * @return Shedule
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return integer 
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set employee
     *
     * @param \WorkersManager\MngrBundle\Entity\Employee $employee
     * @return Shedule
     */
    public function setEmployee(\WorkersManager\MngrBundle\Entity\Employee $employee = null)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \WorkersManager\MngrBundle\Entity\Employee 
     */
    public function getEmployee()
    {
        return $this->employee;
    }
}
