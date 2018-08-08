<?php
namespace PDT\Tests\Exposed;


use PDT\Infrastructure\File\Adapter;
use PDT\Infrastructure\File\FileService;
use PDT\Infrastructure\File\IStorage;

class FileServiceExposed extends FileService
{
    public function getClientStorage(): IStorage
    {
        return parent::getClientStorage();
    }

    public function getAdapterStorage(IStorage $clientStorage, array $appConfig): Adapter
    {
        return parent::getAdapterStorage($clientStorage, $appConfig);
    }

    public function getFullPathFile(string $pathDir, string $filePath): string
    {
        return parent::getFullPathFile($pathDir, $filePath);
    }
}