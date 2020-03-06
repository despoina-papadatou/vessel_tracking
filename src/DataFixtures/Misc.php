<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\VesselTrack;

class Misc implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $instance = new VesselTrack();
        $instance->setStatus(1);
        $instance->setTimestamp(1372697580);
        $instance->setCourse(1);
        $instance->setHeading(1);
        $instance->setRot("Test");
        $instance->setMmsi(247039300);
        $instance->setLat(15);
        $instance->setLon(16);
        $instance->setStationId(1);
        $instance->setSpeed(1);

        $instance2 = new VesselTrack();
        $instance2->setStatus(1);
        $instance2->setTimestamp(1372700340);
        $instance2->setCourse(1);
        $instance2->setHeading(1);
        $instance2->setRot("Test");
        $instance2->setMmsi(311486000);
        $instance2->setLat(12);
        $instance2->setLon(11);
        $instance2->setStationId(1);
        $instance2->setSpeed(1);

        $manager->persist($instance);
        $manager->persist($instance2);

        $manager->flush();
    }
}