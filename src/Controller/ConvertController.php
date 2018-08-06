<?php
namespace PDT\Controller;

use PDT\Infrastructure\File\Adapter;
use PDT\Infrastructure\File\Provider\SystemStorage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConvertController
{
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
        $LocalStorage = new SystemStorage();
        $StorageAdapter = new Adapter($LocalStorage);

        $uploadfile = dirname(__DIR__) . '/../var/uploads/' . basename($_FILES['document']['name']);
        $StorageAdapter->uploadFile($_FILES['document']['tmp_name'], $uploadfile);

        return new Response("test: ");
    }
}