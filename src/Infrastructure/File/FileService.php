<?php
namespace PDT\Infrastructure\File;

use PDT\Domain\Document\Document;

class FileService
{
    private $storageAdapter;

    public function __construct(StorageAdapter $storageAdapter)
    {
        $this->storageAdapter = $storageAdapter;
    }

    /*
     * Public methods
     */

    public function uploadFileToStorage(array $file, array $appConfig): Document
    {
        $fullPath = $this->getFullPathFile($appConfig['directories']['documents'], $file['name']);

        $this->storageAdapter->uploadFile($file['tmp_name'], $fullPath);

        return $this->storageAdapter->getFileInfo($fullPath);
    }

    /*
     * Private methods
     */
    protected function getFullPathFile(string $pathDir, string $filePath): string
    {
        return dirname(__DIR__)
            . $pathDir
            . basename($filePath);
    }
}