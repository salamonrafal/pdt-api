<?php
namespace PDT\Domain\Document;


class Document
{
    /**
     * @var int
     */
    private $docId;

    /**
     * @var DocumentType
     */
    private $docType;

    /**
     * @var string
     */
    private $docContent;

    /**
     * @var boolean
     */
    private $docIsParsed;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var bool
     */
    private $isSupported;

    /**
     * @var int
     */
    private $size;


    public function __construct()
    {
        $this->setIsSupported(false);
        $this->setDocType(DocumentType::NOT_SUPPORTED_FORMAT());
        $this->setSize(0);
        $this->setFilename('');
        $this->setDocContent('');
        $this->setDocId(0);
        $this->setDocIsParsed(false);
    }

    /**
     * @return int
     */
    public function getDocId(): int
    {
        return $this->docId;
    }

    /**
     * @param int $docId
     */
    public function setDocId(int $docId): void
    {
        $this->docId = $docId;
    }

    /**
     * @return DocumentType
     */
    public function getDocType(): DocumentType
    {
        return $this->docType;
    }

    /**
     * @param DocumentType $docType
     */
    public function setDocType(DocumentType $docType): void
    {
        $this->docType = $docType;
    }

    /**
     * @return string
     */
    public function getDocContent(): string
    {
        return $this->docContent;
    }

    /**
     * @param string $docContent
     */
    public function setDocContent(string $docContent): void
    {
        $this->docContent = $docContent;
    }

    /**
     * @return bool
     */
    public function isDocIsParsed(): bool
    {
        return $this->docIsParsed;
    }

    /**
     * @param bool $docIsParsed
     */
    public function setDocIsParsed(bool $docIsParsed): void
    {
        $this->docIsParsed = $docIsParsed;
    }

    /**
     * @return bool
     */
    public function isSupported(): bool
    {
        return $this->isSupported;
    }

    /**
     * @param bool $isSupported
     */
    public function setIsSupported(bool $isSupported): void
    {
        $this->isSupported = $isSupported;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @param $mimeType
     * @param $supportedTypes
     */
    public function setFormatDocument(string $mimeType, array $supportedTypes): void
    {
        $fileType = "";

        for($i=0; $i < count($supportedTypes); $i++)
        {
            if ($mimeType == $supportedTypes[$i]['mime'])
            {
                $fileType = $supportedTypes[$i]['type'];
            }
        }

        switch ($fileType)
        {
            case 'PDF':
                $this->setIsSupported(true);
                $this->setDocType(DocumentType::PDF());
                break;
            case 'DOCX':
                $this->setIsSupported(true);
                $this->setDocType(DocumentType::DOCX());
                break;
            case 'DOC':
                $this->setIsSupported(true);
                $this->setDocType(DocumentType::DOC());
                break;
            case 'HTML':
                $this->setIsSupported(true);
                $this->setDocType(DocumentType::HTML());
                break;
            default:
                $this->setIsSupported(false);
                $this->setDocType(DocumentType::NOT_SUPPORTED_FORMAT());
                break;
        }

    }

}