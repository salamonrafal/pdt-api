<?php
namespace PDT\Tests\Domain;

use PDT\Domain\Document\Document;
use PDT\Domain\Document\DOCUMENTTYPE;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

final class DocumentTest extends TestCase
{

    /**
     * @param int $docId
     * @param string $docType
     * @param string $docContent
     * @param boolean $docIsParsed
     *
     * @dataProvider dataProvider
     */
    public function testDocumentValue(int $docId, string $docType, string $docContent, bool $docIsParsed): void
    {
        $document = new Document();
        $document->setDocId($docId);
        $document->setDocType(DocumentType::PDF());
        $document->setDocContent($docContent);
        $document->setDocIsParsed($docIsParsed);

        $this->assertEquals($docId, $document->getDocId(), 'docId is not same');
        $this->assertEquals(DocumentType::PDF(), $document->getDocType(), 'docType is not same');
        $this->assertEquals($docContent, $document->getDocContent(), 'docContent is not same');
        $this->assertEquals($docIsParsed, $document->isDocIsParsed(), 'docContent is not same');
    }

    public function dataProvider(): array
    {
        return [
            [
                1234,   // docId
                'PDF',  // docType
                'Test', // docContent
                false   // docIsParsed
            ]
        ];
    }
}