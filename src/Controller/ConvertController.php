<?php
namespace PDT\Controller;

use PDT\Configuration\ServicesConfig;
use PDT\Infrastructure\File\FileService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ConvertController extends MainController
{
    private $fileService;

    public function __construct(ServicesConfig $appConfig, FileService $fileService)
    {
        parent::__construct($appConfig);

        $this->fileService = $fileService;
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