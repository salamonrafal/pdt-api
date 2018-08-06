<?php
namespace PDT\Infrastructure\Converter;

class Adapter {
    private $converter;

    public function __construct(IConverter $converterClient)
    {
        $this->converter = $converterClient;
    }

    public function convertToHtml ()
    {
        $this->converter->convertToHtml();
    }
}