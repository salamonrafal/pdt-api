<?php
namespace PDT\Infrastructure\File;

use PDT\Domain\Document\Document;
use PDT\Infrastructure\File\Provider\SystemStorage;

class FileService
{

    /*
     * Public methods
     */

    public function uploadFileToStorage(array $file, array $appConfig): Document
    {
        $LocalStorage = $this->getClientStorage();
        $StorageAdapter = $this->getAdapterStorage($LocalStorage, $appConfig);

        $fullPath = $this->getFullPathFile($appConfig['directories']['documents'], $file['name']);


        $StorageAdapter->uploadFile($file['tmp_name'], $fullPath);


        return $StorageAdapter->getFile($fullPath);
    }

    /*
     * Private methods
     */

    protected function getClientStorage(): IStorage
    {
        return new SystemStorage();
    }

    protected function getAdapterStorage(IStorage $clientStorage, array $appConfig): Adapter
    {
        return new Adapter($clientStorage, $appConfig);
    }

    protected function getFullPathFile(string $pathDir, string $filePath): string
    {
        return dirname(__DIR__)
            . $pathDir
            . basename($filePath);
    }
}