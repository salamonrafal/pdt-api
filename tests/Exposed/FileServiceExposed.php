<?php
namespace PDT\Tests\Exposed;

use PDT\Infrastructure\File\FileService;

class FileServiceExposed extends FileService
{
    public function getFullPathFile(string $pathDir, string $filePath): string
    {
        return parent::getFullPathFile($pathDir, $filePath);
    }
}