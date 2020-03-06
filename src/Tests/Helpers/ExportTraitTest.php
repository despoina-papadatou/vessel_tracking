<?php

namespace App\Tests\Helpers;

use App\Helpers\ExportTrait;
use PHPUnit\Framework\TestCase;

class ExportTraitTest extends TestCase
{
    use ExportTrait;

    public function testCreateCSV()
    {
        $list = [[
            'mmsi' => 1,
            'status' => 2
        ],[
            'mmsi' => 11,
            'status' => 22
        ]];

        $response = $this->createCSV($list, array('mmsi', 'status'));
        $this->assertEquals($response->headers->get('content-type'), 'text/csv');
        ob_get_clean();
    }

    public function testCreateXML()
    {
        $list = [[
            'mmsi' => 1,
            'status' => 2
        ],[
            'mmsi' => 11,
            'status' => 22
        ]];
        $response = $this->createXML($list);
        $this->assertEquals($response->headers->get('content-type'), 'application/xml');
    }
}