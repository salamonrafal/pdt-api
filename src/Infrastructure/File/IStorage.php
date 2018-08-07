<?php
namespace PDT\Infrastructure\File;

interface IStorage
{
    public function upload(string $tempfile, string $target): void;
    public function delete(string $filename): void;
    public function copy(string $filename_source, string $filename_target): void;
    public function save(string $filename, $content): void;
    public function getInfo(string $filename): array;
}