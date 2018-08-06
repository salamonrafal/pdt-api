<?php
namespace PDT\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConvertController
{

    /**
     * @param $docId integer
     * @return Response
     *
     * @Route("/api/v1/convert/{docId}", name = "pdt_convert_run")
     * @Method({"POST"})
     */
    public function run_convert_file(int $docId): Response
    {

        return new Response("test: " . $docId);
    }
}