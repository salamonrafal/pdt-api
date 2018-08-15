<?php
namespace PDT\Tests\Infrastructure\File\Provider;

use PDT\Tests\Exposed\SystemStorageExposed;
use PDT\Tests\Infrastructure\File\TestDataProvider;
use PHPUnit\Framework\MockObject\MockObject;

class SystemStorageTest extends TestDataProvider
{
    /**
     * @var MockObject
     */
    private $_model;

    public function setUp()
    {
        parent::setUp();

        $this->_model = $this->getMockBuilder(SystemStorageExposed::class)
            ->setMethods(
                [
                    '_move_uploaded_file',
                    '_is_file_exists',
                    '_filesize',
                    '_getFileMimeType',
                    '_pathInfo',
                ]
            )
            ->disableProxyingToOriginalMethods()
            ->getMock();
    }

    public function test_move_uploaded_file_success(): void
    {
        $testData = $this->getMockDataFileScope();

        $this->_model->expects($this->once())
            ->method('_move_uploaded_file')
            ->with($testData['tmp_name'], $testData['name'])
            ->willReturn(true);

        $this->_model->upload($testData['tmp_name'], $testData['name']);
    }

    /**
     * @expectedException PDT\Domain\Exception\ExceptionStorage
     */
    public function test_move_uploaded_file_exception(): void
    {
        $testData = $this->getMockDataFileScope();

        $this->_model->method('_move_uploaded_file')
            ->with($testData['tmp_name'], $testData['name'])
            ->willReturn(false);

        $this->_model->upload($testData['tmp_name'], $testData['name']);
    }

    public function test_get_file_information(): void
    {
        $testData = $this->getTestData();

        $this->_model->method('_pathInfo')
            ->willReturn([
                'extension' => $testData['extension'],
                'dirname' => $testData['dirname'],
                'basename' => $testData['fileName']
            ]);

        $this->_model->method('_filesize')
            ->willReturn($testData['fileSize']);

        $this->_model->method('_getFileMimeType')
            ->willReturn($testData['fileType']);

        $results = $this->_model->getInfo($testData['fullPath']);

        $this->assertEquals($testData['fileType'], $results['fileType']);
        $this->assertEquals($testData['fileSize'], $results['fileSize']);
        $this->assertEquals($testData['fullPath'], $results['fullPath']);
        $this->assertEquals($testData['extension'], $results['extension']);
        $this->assertEquals($testData['dirname'], $results['dirname']);
        $this->assertEquals($testData['fileName'], $results['fileName']);
    }
}