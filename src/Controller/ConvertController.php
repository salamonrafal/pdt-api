<?php
namespace PDT\Controller;

use PDT\Configuration\Services;
use PDT\Infrastructure\File\Adapter;
use PDT\Infrastructure\File\Provider\SystemStorage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ConvertController
{
    private $appConfig;

    public function __construct(Services $appConfig)
    {
        $this->appConfig = $appConfig->getConfig();
    }

    /**
     * @param $docId integer
     * @return Response
     *
     * @Route("/api/v1/convert/{docId}", name = "pdt_convert_doc_run")
     */
    public function run_convert_file(int $docId): Response
    {

        return new Response("test: " . $docId);
    }


    /**
     * @return Response
     *
     * @Route("/api/v1/convert", name = "pdt_convert_run")
     */
    public function run_upload_convert_file(): Response
    {

        return new Response("test: ");
    }


    /**
     * @return Response
     *
     * @Route("/api/v1/upload", name = "pdt_upload_run")
     */
    public function run_upload_file (): Response
    {
        $result = $this->uploadFileToStorage($_FILES['document']);

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($result, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_CREATED);

        return $response;
    }


    /*
     * Private methods
     */


    private function uploadFileToStorage(array $file)
    {
        $LocalStorage = new SystemStorage();
        $StorageAdapter = new Adapter($LocalStorage);

        $data = array(
            'filename' => $file['name'],
            'fullpath' => dirname(__DIR__)
                . $this->appConfig['directories']['documents']
                . basename($file['name'])
        );

        $StorageAdapter->uploadFile($file['tmp_name'], $data['fullpath']);

        return $data;
    }
}