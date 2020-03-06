<?php

namespace App\Helpers;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ExportTrait
 */
trait ExportTrait
{
    protected function createCSV($list, $headers)
    {
        ob_start();
        $fp = fopen('php://output', 'a');

        fputcsv($fp, $headers);

        forEach($list as $item) {
            fputcsv($fp, array_values($item));
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="tracks.csv"');
        $response->setStatusCode(200);

        fclose($fp);
        return $response;
    }

    protected function createXML($list)
    {
        $xmlEncoder = new XmlEncoder();
        return new Response($xmlEncoder->encode($list, 'xml'), 200, array(
            'Content-Type' => 'application/xml'
        ));
    }
}