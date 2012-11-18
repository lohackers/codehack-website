<?php

namespace CodeHack\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Money
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeHack\CoreBundle\Entity\MoneyRepository")
 */
class Money 
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
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
  
     /**
     * @ORM\ManyToOne(targetEntity="Emergency", inversedBy="money")
     */
    private $emergency;

    /**
     * Set emergency
     *
     * @param \CodeHack\CoreBundle\Entity\Emergency $emergency
     * @return Money
     */
    public function setEmergency(\CodeHack\CoreBundle\Entity\Emergency $emergency = null)
    {
        $this->emergency = $emergency;
    
        return $this;
    }

    /**
     * Get emergency
     *
     * @return \CodeHack\CoreBundle\Entity\Emergency 
     */
    public function getEmergency()
    {
        return $this->emergency;
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
     * Set quantity
     *
     * @param integer $quantity
     * @return Money
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Money
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
     * Set title
     *
     * @param string $title
     * @return Money
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}