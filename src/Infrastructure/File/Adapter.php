<?php

namespace PDT\Infrastructure\File;

class Adapter
{
    private $Storage;

    public function __construct(IStorage $StorageClient)
    {
        $this->Storage = $StorageClient;
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

    public function getFile()
    {
        $this->Storage->get();
    }
}