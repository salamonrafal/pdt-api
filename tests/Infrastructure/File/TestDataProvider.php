<?php
namespace PDT\Tests\Infrastructure\File;

use PHPUnit\Framework\TestCase;

class TestDataProvider extends TestCase
{

    protected function getMockDataFileScope(): array
    {
        return [
            'tmp_name' => '/var/temp/test_file.pdf',
            'name' => 'test_file.pdf'
        ];
    }

    protected function getMockAppConfig(): array
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

    protected function getTestData(
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