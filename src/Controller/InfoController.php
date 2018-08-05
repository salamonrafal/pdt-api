<?php
namespace PDT\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController
{
    /**
     * @Route("/api/v1/info", name = "pdt_info")
     */
    public function display_info(): Response
    {
        return $this->getMessageInfo();
    }

    /**
     * @Route("/", name = "pdt_info_index")
     */
    public function index_info(): Response
    {
        return $this->getMessageInfo();
    }

    private function getMessageInfo(): Response
    {
        return new Response("<html><head><title>[PDT] Info page</title></head><body><p>Service working</p></body></html>");
    }
}