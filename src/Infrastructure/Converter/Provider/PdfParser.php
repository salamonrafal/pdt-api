<?php
namespace PDT\Infrastructure\Converter\Provider;

use PDT\Infrastructure\Converter\IConverter;

class PdfParser implements IConverter
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
        $cacheDir = dirname(__FILE__) . $this->appConfig['directories']['cache_upload_pdf'] . uniqid();

        // change pdftohtml bin location
        \Gufy\PdfToHtml\Config::set('pdftohtml.bin', $this->appConfig['bin_location']['pdftohtml_bin']);

        // change pdfinfo bin location
        \Gufy\PdfToHtml\Config::set('pdfinfo.bin', $this->appConfig['bin_location']['pdfinfo_bin']);

        // change location output folder
        \Gufy\PdfToHtml\Config::set('pdftohtml.output', $cacheDir);

        // change place CSS styles
        \Gufy\PdfToHtml\Config::set('pdftohtml.inlineCss', true);

        $pdf = new \Gufy\PdfToHtml\Pdf($this->filename);

        $html = $pdf->html();

        return [
            'content' => $html
        ];
    }
}