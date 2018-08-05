<?php
/**
 * Created by PhpStorm.
 * User: rafcio0584
 * Date: 05.08.2018
 * Time: 16:26
 */

namespace PDT\Domain;


class Document
{
    /**
     * @var int
     */
    private $docId;

    /**
     * @var string
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
     * @return string
     */
    public function getDocType(): string
    {
        return $this->docType;
    }

    /**
     * @param string $docType
     */
    public function setDocType(string $docType): void
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