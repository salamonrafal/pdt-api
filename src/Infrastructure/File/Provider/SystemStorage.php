<?php

namespace PDT\Infrastructure\File\Provider;

use PDT\Domain\Exception\ExceptionStorage;
use PDT\Infrastructure\File\IStorage;

class SystemStorage implements IStorage
{

    public function upload($tempfile, string $target)
    {
        if (!$this->move_uploaded_file($tempfile, $target))
        {
            throw new ExceptionStorage("Problem with upload file on System Storage (Local Server)");
        }
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function copy()
    {
        // TODO: Implement copy() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function get()
    {
        // TODO: Implement save() method.
    }

    /**
     * @param string $tempfile
     * @param string $target
     *
     * @return mixed
     */
    private function move_uploaded_file(string $tempfile, string $target)
    {
        return move_uploaded_file($tempfile, $target);
    }
}