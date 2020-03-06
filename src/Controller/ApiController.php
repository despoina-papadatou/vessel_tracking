<?php

namespace App\Controller;

use App\Helpers\ExportTrait;
use App\Helpers\ValidationTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Service\ApiService;


class ApiController extends AbstractController
{
    use ValidationTrait;
    use ExportTrait;

    public function index()
    {
        return new Response( 'Endpoint usage e.g. http://localhost:8000/vessel_track/list?mmsi=311040700,247039300&dateFrom=2013-07-01T05:33:00Z&dateTo=2013-07-01T08:39:00Z&minLat=30&maxLat=162&minLon=1&maxLon=45&format=xml', Response::HTTP_OK, ['content-type' => 'text/html'] );
    }

    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param ApiService $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request, ValidatorInterface $validator, ApiService $service)
    {
        $constraints = $this->getValidationConstraint();
        $validationErrors = $validator->validate($request->query->all(), $constraints);

        if ($validationErrors->count() > 0) {
            $content = array();
            forEach($validationErrors as $error) {
                $content[] = array('message' => $error->getMessage() , 'details' => $error->getParameters());
            }
            return new Response(json_encode($content), 400);
        }

        $mmsi = $request->get('mmsi');
        $minLon = $request->get('minLon');
        $maxLon = $request->get('maxLon');
        $minLat = $request->get('minLat');
        $maxLat = $request->get('maxLat');
        $dateFrom = $request->get('dateFrom');
        $dateTo = $request->get('dateTo');
        $format = $request->get('format');

        $trackList = $service->findTracks($mmsi, $minLon, $maxLon, $minLat, $maxLat, $dateFrom, $dateTo);

        if($format === 'csv') {
            $headers = array('mmsi', 'status', 'stationId', 'speed', 'rot', 'lat', 'lon', 'heading', 'course', 'timestamp');
            return $this->createCSV($trackList, $headers);
        } else if ($format === 'xml') {
            return $this->createXML($trackList);
        } else if ($format === 'hal') {
            return new JsonResponse($trackList, 200, array('Content-Type' => 'application/hal+json'));
        }

        return new JsonResponse($trackList, 200, array('Content-Type' => 'application/json'));
    }
}
