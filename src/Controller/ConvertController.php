<?php
namespace PDT\Controller;

use PDT\Configuration\ServicesConfig;
use PDT\Infrastructure\File\FileService;
use PDT\Infrastructure\File\Provider\SystemStorage;
use PDT\Infrastructure\File\StorageAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ConvertController extends MainController
{
    private $fileService;

    public function __construct(ServicesConfig $serviceConfig)
    {
        parent::__construct($serviceConfig);

        $clientStorageProvider = new SystemStorage();
        $storageAdapter = new StorageAdapter($clientStorageProvider, $this->appConfig);
        $this->fileService = new FileService($storageAdapter);
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
        $result['document'] = $this->fileService->uploadFileToStorage($_FILES['document'], $this->appConfig);

        return $this->createRequestEnvelopJSON($result);
    }

}