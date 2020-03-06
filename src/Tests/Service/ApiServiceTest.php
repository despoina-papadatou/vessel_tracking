<?php

namespace App\Tests\Service;

use App\Service\ApiService;
use App\DataFixtures\Misc;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class VesselTrackTest extends WebTestCase
{
    use FixturesTrait;

    /**
     * @var ApiService
     */
    private $service;

    public function testFindTracks()
    {
        $entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $this->service = new ApiService($entityManager);

        $this->loadFixtures(array(Misc::class));

        $result = $this->service->findTracks('247039300,311486000', null, null,null,null,'2013-01-08T05:00:00Z',null);
        $this->assertCount(2, $result);

        $result = $this->service->findTracks('247039300,311486000', null, null,15,null,null,null);
        $this->assertCount(1, $result);

        $result = $this->service->findTracks('247039300,311486000', null, null,null,null,'2015-01-08T05:00:00Z',null);
        $this->assertCount(0, $result);
    }
}