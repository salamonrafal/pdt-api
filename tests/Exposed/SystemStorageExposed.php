<?php
namespace PDT\Tests\Exposed;

use PDT\Infrastructure\File\Provider\SystemStorage;

class SystemStorageExposed extends SystemStorage {

    public function _move_uploaded_file(string $tempfile, string $target): bool
    {
        return parent::_move_uploaded_file($tempfile, $target);
    }

    public function _is_file_exists($filename): bool
    {
        return parent::_is_file_exists($filename);
    }

    public function _filesize(string $filename): int
    {
        return parent::_filesize($filename);
    }

    public function _getFileMimeType(string $filename): string
    {
        return parent::_getFileMimeType($filename);
    }

    public function _pathInfo(string $filename): array
    {
        return parent::_pathInfo($filename);
    }
}