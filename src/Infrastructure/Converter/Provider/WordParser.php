<?php
namespace PDT\Infrastructure\Converter\Provider;

use PDT\Infrastructure\Converter\IConverter;
use \PhpOffice\PhpWord\IOFactory;

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
        $result = [
            'content' => ''
        ];

        // Creating the new document...
        $phpWord = IOFactory::load($this->filename, 'MsDoc');
        $xmlWriter = IOFactory::createWriter($phpWord, 'RTF');
        $xmlWriter->save("{$this->filename}.docx");
        return $result;
    }
}