<?php
namespace PDT\Tests\Infrastructure\File;

use PDT\Domain\Document\Document;
use PDT\Domain\Document\DocumentType;
use PDT\Infrastructure\File\Adapter;
use PDT\Infrastructure\File\Provider\SystemStorage;
use PDT\Tests\Exposed\FileServiceExposed;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

final class FileServiceTest extends TestCase
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


       $mockAdapter = $this->getMockBuilder(Adapter::class)
            ->setConstructorArgs([
                $mockClient,
                $mockAppConfig
            ])
            ->setMethods(['uploadFile', 'getFile'])
            ->enableProxyingToOriginalMethods()
            ->getMock();


        $model = $this->getMockBuilder(FileServiceExposed::class)
            ->setMethods(
                [
                    'getClientStorage',
                    'getAdapterStorage',
                    'getFullPathFile'
                ]
            )
            ->disableProxyingToOriginalMethods()
            ->getMock();

        $model->method('getClientStorage')
            ->willReturn($mockClient);

        $model->method('getAdapterStorage')
            ->with($mockClient, $mockAppConfig)
            ->willReturn($mockAdapter);

        $model->method('getFullPathFile')
            ->willReturn($mockTestData['fullPath']);

        $result = $model->uploadFileToStorage($mockFileScope, $mockAppConfig);


        $this->assertInstanceOf(Document::class, $result);
        $this->assertTrue($result->isSupported());
        $this->assertEquals(DocumentType::PDF(), $result->getDocType());
        $this->assertEquals($mockTestData['fileName'], $result->getFilename());
    }

    private function getMockDataFileScope(): array
    {
        return [
            'tmp_name' => '/var/temp/test_file.pdf',
            'name' => 'test_file.pdf'
        ];
    }

    private function getMockAppConfig(): array
    {
        return [
            'directories' => [
                'documents' => 'var/uploads/'
            ],
            'supported_formats' => [
                [
                    'mime' => 'application/pdf',
                    'type' => 'PDF'
                ]
            ]

        ];
    }

    private function getTestData(
        string  $fileType = 'application/pdf',
        int     $fileSize = 1234,
        string  $fullPath = 'var/uploads/test_file.pdf',
        string  $extension = 'pdf',
        string  $dirname = 'var/uploads/',
        string  $fileName = 'test_file.pdf'
    ): array
    {
        $testData = array(
            'fileType' => $fileType,
            'fileSize' => $fileSize,
            'fullPath' => $fullPath,
            'extension' => $extension,
            'dirname' => $dirname,
            'fileName' => $fileName
        );

        return $testData;
    }

}