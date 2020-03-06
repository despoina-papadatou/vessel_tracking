<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Representation of a vessel track
 *
 * @ORM\Entity()
 * @ORM\Table(name="vessel_track")
 * @ORM\HasLifecycleCallbacks()
 */
class VesselTrack
{
    /**
     * Vessel identifier
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="mmsi", type="integer")
     */
    private $mmsi;

    /**
     * AIS vessel status
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * Receiving station ID
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="stationId", type="integer")
     */
    private $stationId;

    /**
     * Speed in knots x 10 (i.e. 10,1 knots is 101)
     *
     * @var float
     *
     * @ORM\Id
     * @ORM\Column(name="speed", type="float")
     */
    private $speed;

    /**
     * Longitude
     *
     * @var float
     *
     * @ORM\Id
     * @ORM\Column(name="lon", type="float")
     */
    private $lon;

    /**
     * Latitude
     *
     * @var float
     *
     * @ORM\Id
     * @ORM\Column(name="lat", type="float")
     */
    private $lat;

    /**
     * Vessel's course over ground
     *
     * @var float
     *
     * @ORM\Id
     * @ORM\Column(name="course", type="float")
     */
    private $course;

    /**
     * Vessel's true heading
     *
     * @var float
     *
     * @ORM\Id
     * @ORM\Column(name="heading", type="float")
     */
    private $heading;

    /**
     * Vessel's rate of turn
     *
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="rot", type="string")
     */
    private $rot;

    /**
     * Position timestamp
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="timestamp", type="integer")
     */
    private $timestamp;

    /**
     * @return int
     */
    public function getMmsi()
    {
        return $this->mmsi;
    }

    /**
     * @param int $mmsi
     * @return self
     */
    public function setMmsi($mmsi)
    {
        $this->mmsi = $mmsi;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param integer $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStationId()
    {
        return $this->stationId;
    }

    /**
     * @param int $stationId
     * @return self
     */
    public function setStationId($stationId)
    {
        $this->stationId = $stationId;

        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     * @return self
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param float $lon
     * @return self
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return self
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return float
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param float $course
     * @return self
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return float
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * @param float $heading
     * @return self
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * @return string
     */
    public function getRot()
    {
        return $this->rot;
    }

    /**
     * @param string $rot
     * @return self
     */
    public function setRot($rot)
    {
        $this->rot = $rot;

        return $this;
    }

    /**
     * @return inte
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param float $timestamp
     * @return self
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function toTableData()
    {
        return [
            'mmsi' => $this->mmsi,
            'status' => $this->status,
            'stationId' => $this->stationId,
            'speed' => $this->speed,
            'rot' => $this->rot,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'heading' => $this->heading,
            'course' => $this->course,
            'dateTime' => gmdate("Y-m-d\TH:i:s\Z", $this->timestamp)
        ];
    }

    /**
     * @Assert\Callback()
     *
     * @param \Symfony\Component\Validator\Context\ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (!is_numeric($this->getMmsi()) || $this->getMmsi() <= 0) {
            $context->buildViolation('The MMSI is not numeric or not a positive value')
                ->atPath('mmsi')
                ->addViolation();
        }

        if (!is_numeric($this->getStationId()) || $this->getStationId() <= 0) {
            $context->buildViolation('The station identifier is not numeric or not a positive value')
                ->atPath('stationId')
                ->addViolation();
        }

        if (!is_numeric($this->getStatus()) || $this->getStatus() < 0) {
            $context->buildViolation('The AIS status is not numeric or not a positive value')
                ->atPath('status')
                ->addViolation();
        }
    }
}
