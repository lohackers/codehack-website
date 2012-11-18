<?php

namespace CodeHack\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Emergency
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeHack\CoreBundle\Entity\EmergencyRepository")
 */
class Emergency
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
     * @var float
     *
     * @ORM\Column(name="lat", type="decimal")
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="decimal")
     */
    private $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="intensity", type="string", length=255)
     */
    private $intensity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean")
     */
    private $approved;
    
    /**
     * @ORM\OneToMany(targetEntity="People", mappedBy="emergency")
     */
    private $people;
    
    /**
     * @ORM\OneToMany(targetEntity="Money", mappedBy="emergency")
     */
    private $money;
    
    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="emergency")
     */
    private $material;
    

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
     * Set lat
     *
     * @param float $lat
     * @return Emergency
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    
        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     * @return Emergency
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    
        return $this;
    }

    /**
     * Get lng
     *
     * @return float 
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Emergency
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set level
     *
     * @param string $level
     * @return Emergency
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set intensity
     *
     * @param string $intensity
     * @return Emergency
     */
    public function setIntensity($intensity)
    {
        $this->intensity = $intensity;
    
        return $this;
    }

    /**
     * Get intensity
     *
     * @return string 
     */
    public function getIntensity()
    {
        return $this->intensity;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Emergency
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return Emergency
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    
        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Add requirements
     *
     * @param \CodeHack\CoreBundle\Entity\BaseRequirement $requirements
     * @return Emergency
     */
    public function addRequirement(\CodeHack\CoreBundle\Entity\BaseRequirement $requirements)
    {
        $this->requirements[] = $requirements;
    
        return $this;
    }

    /**
     * Remove requirements
     *
     * @param \CodeHack\CoreBundle\Entity\BaseRequirement $requirements
     */
    public function removeRequirement(\CodeHack\CoreBundle\Entity\BaseRequirement $requirements)
    {
        $this->requirements->removeElement($requirements);
    }

    /**
     * Get requirements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->people = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add people
     *
     * @param \CodeHack\CoreBundle\Entity\People $people
     * @return Emergency
     */
    public function addPeople(\CodeHack\CoreBundle\Entity\People $people)
    {
        $this->people[] = $people;
    
        return $this;
    }

    /**
     * Remove people
     *
     * @param \CodeHack\CoreBundle\Entity\People $people
     */
    public function removePeople(\CodeHack\CoreBundle\Entity\People $people)
    {
        $this->people->removeElement($people);
    }

    /**
     * Get people
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * Add money
     *
     * @param \CodeHack\CoreBundle\Entity\Money $money
     * @return Emergency
     */
    public function addMoney(\CodeHack\CoreBundle\Entity\Money $money)
    {
        $this->money[] = $money;
    
        return $this;
    }

    /**
     * Remove money
     *
     * @param \CodeHack\CoreBundle\Entity\Money $money
     */
    public function removeMoney(\CodeHack\CoreBundle\Entity\Money $money)
    {
        $this->money->removeElement($money);
    }

    /**
     * Get money
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * Add material
     *
     * @param \CodeHack\CoreBundle\Entity\Material $material
     * @return Emergency
     */
    public function addMaterial(\CodeHack\CoreBundle\Entity\Material $material)
    {
        $this->material[] = $material;
    
        return $this;
    }

    /**
     * Remove material
     *
     * @param \CodeHack\CoreBundle\Entity\Material $material
     */
    public function removeMaterial(\CodeHack\CoreBundle\Entity\Material $material)
    {
        $this->material->removeElement($material);
    }

    /**
     * Get material
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaterial()
    {
        return $this->material;
    }
}