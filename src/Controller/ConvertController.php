<?php
namespace PDT\Controller;

use PDT\Infrastructure\File\Adapter;
use PDT\Infrastructure\File\Provider\SystemStorage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ConvertController extends MainController
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
        $result = $this->uploadFileToStorage($_FILES['document']);

        return $this->createRequestEnvelopJSON($result);
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