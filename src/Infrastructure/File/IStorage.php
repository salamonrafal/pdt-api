<?php
namespace PDT\Infrastructure\File;

interface IStorage
{
    public function upload($tempfile, string $target);
    public function delete();
    public function copy();
    public function save();
    public function get();
}