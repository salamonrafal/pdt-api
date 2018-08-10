<?php
namespace PDT\Tests\Infrastructure\File;

use PDT\Domain\Document\Document;
use PDT\Domain\Document\DocumentType;
use PDT\Infrastructure\File\Provider\SystemStorage;
use PDT\Infrastructure\File\StorageAdapter;

class StorageAdapterTest extends TestDataProvider
{
    public function test_upload_file()
    {
        $mockTestData = $this->getTestData();
        $mockFileScope = $this->getMockDataFileScope();
        $mockAppConfig = $this->getMockAppConfig();

        $mockClient = $this->getMockBuilder(SystemStorage::class)
            ->setMethods(['upload','getInfo'])
            ->getMock();

        $mockClient->method('upload')
            ->with($mockFileScope['tmp_name'], $mockTestData['fullPath']);


        $model = $this->getMockBuilder(StorageAdapter::class)
            ->setConstructorArgs([
                $mockClient,
                $mockAppConfig
            ])
            ->getMock();

        $results = $model->uploadFile('/var/temp/test_file.pdf', 'var/uploads/test_file.pdf');

        $this->assertEmpty($results);

    }

    public function test_get_info_file()
    {
        $mockTestData = $this->getTestData();
        $mockAppConfig = $this->getMockAppConfig();

        $mockClient = $this->getMockBuilder(SystemStorage::class)
            ->setMethods(['getInfo'])
            ->getMock();

        $mockClient->method('getInfo')
            ->with($mockTestData['fullPath'])
            ->willReturn($mockTestData);

        $model = $this->getMockBuilder(StorageAdapter::class)
            ->setConstructorArgs([
                $mockClient,
                $mockAppConfig
            ])
            ->enableProxyingToOriginalMethods()
            ->getMock();


        $results = $model->getFileInfo($mockTestData['fullPath']);


        $this->assertInstanceOf(Document::class, $results);
        $this->assertTrue($results->isSupported());
        $this->assertEquals(DocumentType::PDF(), $results->getDocType());
        $this->assertEquals($mockTestData['fileName'], $results->getFilename());
    }

}