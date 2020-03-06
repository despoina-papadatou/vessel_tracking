<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\VesselTrack;

class ApiService
{
    /**
     * @var $entityManager
     */
    private $entityManager;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(

        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * Find tracks
     *
     * @param int $mmsi
     * @param float $minLon
     * @param float $maxLon
     * @param float $minLat
     * @param float $maxLat
     * @param string $dateFrom
     * @param string $dateTo
     *
     * @return VesselTrack[]
     */
    public function findTracks($mmsi, $minLon, $maxLon, $minLat, $maxLat, $dateFrom, $dateTo)
    {
        $queryBuilder = $this->entityManager
            ->getRepository(VesselTrack::class)
            ->createQueryBuilder('vt')
            ->where("vt.mmsi IN (:mmsi)");
        $queryBuilder->setParameter('mmsi', explode(',', $mmsi));

        if($dateFrom) {
            $queryBuilder->andWhere("vt.timestamp >= :dateFrom");
            $dateFrom = new \DateTime($dateFrom);
            $queryBuilder->setParameter('dateFrom', $dateFrom->getTimestamp());
        }

        if($dateTo) {
            $queryBuilder->andWhere("vt.timestamp <= :dateTo");
            $dateTo = new \DateTime($dateTo);
            $queryBuilder->setParameter('dateTo', $dateTo->getTimestamp());
        }

        if($minLat) {
            $queryBuilder->andWhere("vt.lat >= :minLat");
            $queryBuilder->setParameter('minLat', $minLat);
        }
        if($maxLat) {
            $queryBuilder->andWhere("vt.lat <= :maxLat");
            $queryBuilder->setParameter('maxLat', $maxLat);
        }
        if($minLon) {
            $queryBuilder->andWhere("vt.lon >= :minLon");
            $queryBuilder->setParameter('minLon', $minLon);
        }
        if($maxLon) {
            $queryBuilder->andWhere("vt.lon <= :maxLon");
            $queryBuilder->setParameter('maxLon', $maxLon);
        }
        $queryBuilder->orderBy('vt.timestamp', 'DESC');
        $tracks = $queryBuilder->getQuery()->execute();

        $trackList = array();
        forEach($tracks as $track) {
            $trackList[] = $track->toTableData();
        }

        return $trackList;
    }
}
