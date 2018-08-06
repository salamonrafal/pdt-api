<?php

namespace PDT\Infrastructure\File\Provider;

use PDT\Domain\Exception\ExceptionStorage;
use PDT\Infrastructure\File\IStorage;

class SystemStorage implements IStorage
{

    public function upload($tempfile, string $target)
    {
        if (!move_uploaded_file($tempfile, $target))
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
}