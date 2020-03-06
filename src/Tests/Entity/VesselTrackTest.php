<?php

namespace App\Tests\Entity;

use App\Entity\VesselTrack;
use Symfony\Component\Validator\Validation;
use PHPUnit\Framework\TestCase;

class VesselTrackTest extends TestCase
{
    public function testMmsi()
    {
        $instance = new VesselTrack();
        $instance->setMmsi(1);
        $this->assertEquals(1, $instance->getMmsi());
    }

    public function testSpeed()
    {
        $instance = new VesselTrack();
        $instance->setSpeed(1);
        $this->assertEquals(1, $instance->getSpeed());
    }

    public function testStationId()
    {
        $instance = new VesselTrack();
        $instance->setStationId(1);
        $this->assertEquals(1, $instance->getStationId());
    }

    public function testRot()
    {
        $instance = new VesselTrack();
        $instance->setRot("test");
        $this->assertEquals("test", $instance->getRot());
    }

    public function testHeading()
    {
        $instance = new VesselTrack();
        $instance->setHeading(1);
        $this->assertEquals(1, $instance->getHeading());
    }

    public function testCourse()
    {
        $instance = new VesselTrack();
        $instance->setCourse(1);
        $this->assertEquals(1, $instance->getCourse());
    }

    public function testLon()
    {
        $instance = new VesselTrack();
        $instance->setLon(1);
        $this->assertEquals(1, $instance->getLon());
    }

    public function testLat()
    {
        $instance = new VesselTrack();
        $instance->setLat(1);
        $this->assertEquals(1, $instance->getlat());
    }

    public function testTimestamp()
    {
        $instance = new VesselTrack();
        $instance->setTimestamp(1);
        $this->assertEquals(1, $instance->getTimestamp());
    }

    public function testStatus()
    {
        $instance = new VesselTrack();
        $instance->setStatus(1);
        $this->assertEquals(1, $instance->getStatus());
    }
    public function testValidate()
    {
        $instance = new VesselTrack();
        $instance->setStatus(-1);
        $instance->setTimestamp(1);
        $instance->setCourse(1);
        $instance->setHeading(1);
        $instance->setRot("Test");
        $instance->setMmsi(-1);
        $instance->setLat(1);
        $instance->setLon(1);
        $instance->setStationId('abc');
        $instance->setSpeed(1);

        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $errors = $validator->validate($instance);
        $this->assertEquals(count($errors), 3);
        $this->assertEquals($errors[0]->getMessage(), 'The MMSI is not numeric or not a positive value');
        $this->assertEquals($errors[1]->getMessage(), 'The station identifier is not numeric or not a positive value');
        $this->assertEquals($errors[2]->getMessage(), 'The AIS status is not numeric or not a positive value');
    }

    public function testToTableData()
    {
        $instance = new VesselTrack();
        $instance->setStatus(1);
        $instance->setTimestamp(1372700340);
        $instance->setCourse(1);
        $instance->setHeading(1);
        $instance->setRot("Test");
        $instance->setMmsi(1);
        $instance->setLat(1);
        $instance->setLon(1);
        $instance->setStationId(1);
        $instance->setSpeed(1);
        $testResult = $instance->toTableData();
        $this->assertEquals($testResult, [
            'mmsi' => 1,
            'status' => 1,
            'stationId' => 1,
            'speed' => 1,
            'rot' => "Test",
            'lat' => 1,
            'lon' => 1,
            'heading' => 1,
            'course' => 1,
            'dateTime' => '2013-07-01T17:39:00Z'
        ]);
    }
}
