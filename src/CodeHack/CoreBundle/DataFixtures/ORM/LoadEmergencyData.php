<?php

namespace CodeHack\CoreBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CodeHack\CoreBundle\Entity\Emergency;

/**
 * LoadEmergencyData
 *
 * @author erivello
 */
class LoadEmergencyData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 5; $i++) {
            $emergency = new Emergency();
            $emergency->setApproved(1);
            $emergency->setType('earthquake');
            $emergency->setLat('12.42467');
            $emergency->setLng('45.56310');
            $emergency->setLevel('slight');
            $emergency->setIntensity($i);
            $emergency->setTimestamp(new \DateTime('now'));
            $manager->persist($emergency);
        }

        for ($i = 5; $i < 10; $i++) {
            $emergency = new Emergency();
            $emergency->setApproved(1);
            $emergency->setType('fire');
            $emergency->setLat('12.42467');
            $emergency->setLng('45.56310');
            $emergency->setLevel('serious');
            $emergency->setIntensity($i);
            $emergency->setTimestamp(new \DateTime('now'));
            $this->addReference('emergency'.$i, $emergency);
            $manager->persist($emergency);
        }

        for ($i = 10; $i < 15; $i++) {
            $emergency = new Emergency();
            $emergency->setApproved(1);
            $emergency->setType('flood');
            $emergency->setLat('12.42467');
            $emergency->setLng('45.56310');
            $emergency->setLevel('medium');
            $emergency->setIntensity($i);
            $emergency->setTimestamp(new \DateTime('now'));
            $manager->persist($emergency);
        }
        
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }    
}
