<?php
namespace PDT\Infrastructure\Converter;

use PDT\Domain\Document\DocumentType;
use PDT\Domain\Exception\ExceptionUndefinedParser;
use PDT\Infrastructure\Converter\Provider\PdfParser;
use PDT\Infrastructure\Converter\Provider\WordParser;

class ConverterFactory {

    public function getParser (string $filename, DocumentType $type, array $appConfig)
    {
        switch ($type)
        {
            case 'pdf':
                return new PdfParser($filename, $appConfig);
            case 'doc':
            case 'docx':
                return new WordParser($filename, $appConfig);
            default:
                throw new ExceptionUndefinedParser("Unknown parser type (" . $type . ")");
        }
    }
}