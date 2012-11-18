<?php

namespace CodeHack\CoreBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CodeHack\CoreBundle\Entity\People;

/**
 * LoadPeopleData
 *
 * @author erivello
 */
class LoadPeopleData extends AbstractFixture implements OrderedFixtureInterface
{
   /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 5; $i < 10; $i++) {
            $people = new People();
            $people->setDescription('Foo descriptio ' . $i);
            $people->setTitle('Foo Title ' . $i);
            $people->setQuantity($i);
            $people->setEmergency($this->getReference('emergency'.$i));
            $manager->persist($people);
        }
        
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }    
}
