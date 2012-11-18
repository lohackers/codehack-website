<?php

namespace CodeHack\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Money
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CodeHack\CoreBundle\Entity\MoneyRepository")
 */
class Money extends BaseRequirement
{
    /**
     * @var float
     *
     * @ORM\Column(name="unitcost", type="decimal")
     */
    private $unitcost;


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
     * Set unitcost
     *
     * @param float $unitcost
     * @return Money
     */
    public function setUnitcost($unitcost)
    {
        $this->unitcost = $unitcost;
    
        return $this;
    }

    /**
     * Get unitcost
     *
     * @return float 
     */
    public function getUnitcost()
    {
        return $this->unitcost;
    }
}