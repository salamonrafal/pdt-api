<?php
namespace PDT\Infrastructure\File;

interface IStorage
{
    public function upload();
    public function delete();
    public function copy();
    public function save();
    public function get();
}