<?php

namespace PDT\Infrastructure\File\Provider;

use PDT\Domain\Exception\ExceptionStorage;
use PDT\Infrastructure\File\IStorage;

class SystemStorage implements IStorage
{

    public function upload(string $tempfile, string $target): void
    {
        if (!$this->_move_uploaded_file($tempfile, $target))
        {
            throw new ExceptionStorage("Problem with upload file on System Storage (Local Server)");
        }
    }

    public function delete(string $filename): void
    {
        // TODO: Implement delete() method.
    }

    public function copy(string $filename_source, string $filename_target): void
    {
        // TODO: Implement copy() method.
    }

    public function save(string $filename, $content): void
    {
        // TODO: Implement save() method.
    }

    public function getInfo(string $filename): array
    {
        $results = array ();

        $pathInfo = $this->_pathInfo($filename);

        $results['fileType'] = $this->_getFileMimeType($filename);
        $results['fileSize'] = $this->_filesize($filename);
        $results['fullPath'] = $filename;
        $results['extension'] = $pathInfo['extension'];
        $results['dirname'] = $pathInfo['dirname'];
        $results['fileName'] = $pathInfo['basename'];

        return $results;
    }

    /**
     * @param string $tempfile
     * @param string $target
     *
     * @return bool
     */
    protected function _move_uploaded_file(string $tempfile, string $target): bool
    {
        return move_uploaded_file($tempfile, $target);
    }

    protected function _is_file_exists($filename): bool
    {
        return file_exists($filename);
    }

    protected function _filesize(string $filename): int
    {
        return filesize($filename);
    }

    protected function _getFileMimeType(string $filename): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_mime_type = finfo_file($finfo, $filename);
        finfo_close($finfo);

        return $file_mime_type;
    }

    protected function _pathInfo(string $filename): array
    {
        return pathinfo($filename);
    }
}