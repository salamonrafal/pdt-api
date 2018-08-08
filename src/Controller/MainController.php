<?php
namespace PDT\Controller;

use PDT\Configuration\ServicesConfig;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MainController
{
    protected $serializer;
    protected $appConfig;

    public function __construct(ServicesConfig $appConfig)
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $this->serializer = new Serializer($normalizers, $encoders);
        $this->appConfig = $appConfig->getConfig();
    }

    protected function createRequestEnvelopJSON ($payload): Response
    {
        $response = new Response();

        $response->setContent($this->serializer->serialize($payload, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_CREATED);

        return $response;
    }
}