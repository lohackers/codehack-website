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
     * @ORM\OneToMany(targetEntity="BaseRequirement", mappedBy="emergency")
     */
    private $requirements;
    
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->requirements = new ArrayCollection();
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
}