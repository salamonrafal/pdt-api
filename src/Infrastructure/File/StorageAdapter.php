<?php

namespace PDT\Infrastructure\File;

use PDT\Domain\Document\Document;

class StorageAdapter
{
    private $Storage;
    private $appConfig;

    public function __construct(IStorage $StorageClient, $appConfig)
    {
        $this->Storage = $StorageClient;
        $this->appConfig = $appConfig;
    }

    public function uploadFile($tempfile, string $target)
    {
        $this->Storage->upload($tempfile, $target);
    }

    public function saveFile()
    {
        $this->Storage->save();
    }

    public function copyFile()
    {
        $this->Storage->copy();
    }

    public function deleteFile()
    {
        $this->Storage->delete();
    }

    public function getFileInfo(string $filename): Document
    {
        $fileInfo = $this->Storage->getInfo($filename);
        $document = new Document();

        $document->setFilename($fileInfo['fileName']);
        $document->setSize($fileInfo['fileSize']);
        $document->setFormatDocument($fileInfo['fileType'], $this->appConfig['supported_formats']);

        return $document;
    }
}