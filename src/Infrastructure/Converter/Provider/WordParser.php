<?php
namespace PDT\Infrastructure\Converter\Provider;

use PDT\Infrastructure\Converter\IConverter;

class WordParser implements IConverter
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var array
     */
    private $appConfig;

    public function __construct(string $filename, array $appConfig)
    {
        $this->filename=$filename;
        $this->appConfig=$appConfig;
    }

    public function convertToHtml(): array
    {
        // TODO: Implement convertToHtml() method.
    }
}