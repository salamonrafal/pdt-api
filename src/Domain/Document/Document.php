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

}