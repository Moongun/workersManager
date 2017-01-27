<?php

namespace WorkersManager\MngrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="WorkersManager\MngrBundle\Repository\EmployeeRepository")
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
     * @ORM\OneToMany(targetEntity="Shedule", mappedBy="employee")
     * @var type 
     */
    private $shedules;


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
     * @return Employee
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
     * @return Employee
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
    
    public function __construct() {
        $this->shedules = new ArrayCollection();
    }

    /**
     * Add shedules
     *
     * @param \WorkersManager\MngrBundle\Entity\Shedule $shedules
     * @return Employee
     */
    public function addShedule(\WorkersManager\MngrBundle\Entity\Shedule $shedules)
    {
        $this->shedules[] = $shedules;

        return $this;
    }

    /**
     * Remove shedules
     *
     * @param \WorkersManager\MngrBundle\Entity\Shedule $shedules
     */
    public function removeShedule(\WorkersManager\MngrBundle\Entity\Shedule $shedules)
    {
        $this->shedules->removeElement($shedules);
    }

    /**
     * Get shedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShedules()
    {
        return $this->shedules;
    }
    
    public function __toString() 
    {
        return $this->name;
    }
}
