<?php
namespace PDT\Tests\Domain;

use PDT\Domain\Document\Document;
use PDT\Domain\Document\DocumentType;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

final class DocumentTest extends TestCase
{

    /**
     * @param int $docId
     * @param string $docType
     * @param string $docContent
     * @param boolean $docIsParsed
     * @param string $filename
     * @param int $size
     * @param bool $isSupported
     *
     * @dataProvider dataProvider
     */
    public function test_document_value_passed(
        int $docId,
        DocumentType $docType,
        string $docContent,
        bool $docIsParsed,
        string $filename,
        int $size,
        bool $isSupported
    ): void
    {
        $document = new Document();
        $document->setDocId($docId);
        $document->setDocType($docType);
        $document->setDocContent($docContent);
        $document->setDocIsParsed($docIsParsed);
        $document->setFilename($filename);
        $document->setSize($size);
        $document->setIsSupported($isSupported);

        $this->assertEquals($docId, $document->getDocId(), 'docId is not same');
        $this->assertEquals($docType, $document->getDocType(), 'docType is not same');
        $this->assertEquals($docContent, $document->getDocContent(), 'docContent is not same');
        $this->assertEquals($docIsParsed, $document->isDocIsParsed(), 'docIsParsed is not same');
        $this->assertEquals($filename, $document->getFilename(), 'filename is not same');
        $this->assertEquals($size, $document->getSize(), 'size is not same');
        $this->assertEquals($isSupported, $document->isSupported(), 'isSupported is not same');

    }

    public function test_check_supported_ok(): void
    {
        $document = new Document();
        $document->setFormatDocument('application/pdf', $this->createMockSupportedConfig());

        $this->assertTrue($document->isSupported(), 'isSupported should have true');
        $this->assertEquals(DocumentType::PDF(), $document->getDocType(), 'docType is not same');
    }

    public function test_check_not_supported(): void
    {
        $document = new Document();
        $document->setFormatDocument('application/ogg', $this->createMockSupportedConfig());

        $this->assertFalse($document->isSupported(), 'isSupported should have false');
        $this->assertEquals(DocumentType::NOT_SUPPORTED_FORMAT(), $document->getDocType(), 'docType is not same');
    }

    public function dataProvider(): array
    {
        return [
            [
                1234,                   // docId
                DocumentType::PDF(),    // docType
                'Test',                 // docContent
                false,                  // docIsParsed
                'test.pdf',             // filename
                100,                    // size
                true                    // isSupported
            ]
        ];
    }

    private function createMockSupportedConfig() {
        return array(
            array(
                'mime' => 'application/pdf',
                'type' => 'PDF'
            )
        );
    }


}