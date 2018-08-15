<?php
namespace PDT\Controller;

use PDT\Configuration\ServicesConfig;
use PDT\Domain\Exception\ExceptionUndefinedParser;
use PDT\Infrastructure\Converter\ConverterFactory;
use PDT\Infrastructure\File\FileService;
use PDT\Infrastructure\File\Provider\SystemStorage;
use PDT\Infrastructure\File\StorageAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ConvertController extends MainController
{
    /**
     * @var FileService
     */
    private $fileService;

    /**
     * @var ConverterFactory
     */
    private $converterFactory;


    public function __construct(ServicesConfig $serviceConfig, ConverterFactory $converterFactory)
    {
        parent::__construct($serviceConfig);

        $clientStorageProvider = new SystemStorage();
        $storageAdapter = new StorageAdapter($clientStorageProvider, $this->appConfig);
        $this->fileService = new FileService($storageAdapter);
        $this->converterFactory = $converterFactory;
    }

    /**
     * @param $docId string
     * @return Response
     * @throws ExceptionUndefinedParser
     *
     * @Route("/api/v1/convert/{docId}", name = "pdt_convert_doc_run")
     */
    public function run_convert_file(string $docId): Response
    {
        $document = $this->fileService->getFileInfo($docId, $this->appConfig);
        $result = [];

        $parser = $this->converterFactory->getParser($document->getFullPath(), $document->getDocType(), $this->appConfig);
        $resultContent = $parser->convertToHtml();

        if ($resultContent['content'] != '')
        {
            $document->setDocContent($resultContent['content']);
            $document->setDocIsParsed(true);
        }

        $result['document'] = $document;

        return $this->createRequestEnvelopJSON($result);
    }


    /**
     * @return Response
     *
     * @throws ExceptionUndefinedParser
     *
     * @Route("/api/v1/convert", name = "pdt_convert_run")
     */
    public function run_upload_convert_file(): Response
    {
        $result['document'] = $this->fileService->uploadFileToStorage($_FILES['document'], $this->appConfig);

        $parser = $this->converterFactory->getParser($result['document']->getFullPath(), $result['document']->getDocType(), $this->appConfig);
        $resultContent = $parser->convertToHtml();

        if ($resultContent['content'] != '')
        {
            $result['document']->setDocContent($resultContent['content']);
            $result['document']->setDocIsParsed(true);
        }

        return $this->createRequestEnvelopJSON($result);
    }


    /**
     * @return Response
     *
     * @Route("/api/v1/upload", name = "pdt_upload_run")
     */
    public function run_upload_file (): Response
    {
        $result['document'] = $this->fileService->uploadFileToStorage($_FILES['document'], $this->appConfig);

        return $this->createRequestEnvelopJSON($result);
    }

}