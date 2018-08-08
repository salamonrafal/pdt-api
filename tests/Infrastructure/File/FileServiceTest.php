<?php
namespace PDT\Tests\Infrastructure\File;

use \PDT\Infrastructure\File\FileService;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

final class FileServiceTest extends TestCase
{
    /**
     * @var array $file
     * @var array $mockAppConfig
     *
     * @skip
     */
    public function test_upload_file (): void
    {
        $model = $this->getMockBuilder(FileService::class)
            ->getMock();

        $result = $model->uploadFileToStorage($this->getMockDataFileScope(), $this->getMockAppConfig());

        // $this->assertEquals(array(),$result);
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
                'documents' => '/var/uploads/'
            ]
        ];
    }

}