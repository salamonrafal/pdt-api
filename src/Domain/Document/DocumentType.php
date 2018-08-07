<?php
namespace PDT\Domain\Document;

use MyCLabs\Enum\Enum;

class DocumentType extends Enum {
    private const PDF = 'pdf';
    private const DOC = 'doc';
    private const DOCX = 'docx';
    private const HTML = 'html';
}