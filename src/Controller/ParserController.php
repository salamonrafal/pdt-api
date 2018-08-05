<?php
namespace PDT\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParserController
{

    /**
     * @param $docId integer
     * @return Response
     *
     * @Route("/api/v1/parse/{docId}", name = "pdt_parse_run")
     */
    public function run_parse_file(int $docId): Response
    {

        return new Response("test: " . $docId);
    }
}