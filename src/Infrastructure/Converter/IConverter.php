<?php
namespace PDT\Infrastructure\Converter;

interface IConverter
{
    public function convertToHtml(): array;
}