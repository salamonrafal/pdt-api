<?php
namespace PDT\Tests\Infrastructure\File;

use PDT\Domain\Document\Document;
use PDT\Domain\Document\DocumentType;
use PDT\Infrastructure\File\StorageAdapter;
use PDT\Infrastructure\File\Provider\SystemStorage;
use PDT\Tests\Exposed\FileServiceExposed;

final class FileServiceTest extends TestDataProvider
{
    /**
     * @var array $file
     * @var array $mockAppConfig
     *
     */
    public function test_upload_file (): void
    {
        $mockTestData = $this->getTestData();
        $mockFileScope = $this->getMockDataFileScope();
        $mockAppConfig = $this->getMockAppConfig();

        $mockClient = $this->getMockBuilder(SystemStorage::class)
            ->setMethods(['upload','getInfo'])
            ->getMock();


        $mockClient->method('upload')
            ->with($mockFileScope['tmp_name'], $mockTestData['fullPath']);

        $mockClient->method('getInfo')
            ->with($mockTestData['fullPath'])
            ->willReturn($mockTestData);


       $mockAdapter = $this->getMockBuilder(StorageAdapter::class)
            ->setConstructorArgs([
                $mockClient,
                $mockAppConfig
            ])
            ->setMethods(['uploadFile', 'getFile'])
            ->enableProxyingToOriginalMethods()
            ->getMock();


        $model = $this->getMockBuilder(FileServiceExposed::class)
            ->setConstructorArgs([
                $mockAdapter
            ])
            ->setMethods(
                [
                    'getFullPathFile'
                ]
            )
            ->disableProxyingToOriginalMethods()
            ->getMock();

        $model->method('getFullPathFile')
            ->willReturn($mockTestData['fullPath']);

        $result = $model->uploadFileToStorage($mockFileScope, $mockAppConfig);


        $this->assertInstanceOf(Document::class, $result);
        $this->assertTrue($result->isSupported());
        $this->assertEquals(DocumentType::PDF(), $result->getDocType());
        $this->assertEquals($mockTestData['fileName'], $result->getFilename());
    }

}