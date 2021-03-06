<?php
namespace Ftp;

use Molajo\Filesystem\Adapter as fsAdapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-26 at 06:27:20.
 */
class FtpDeleteTest extends Data
{
    /**
     * Initialises Adapter
     */
    protected function setUp()
    {
        parent::setUp();

        /** initialise call */
        $this->filesystem_type = 'Ftp';
        $this->action          = 'Delete';

        $this->options = array(
            'delete_empty' => false
        );

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Ftp::delete
     */
    public function testSuccessfulDeleteSingleFile()
    {
        $this->options = array(
            'delete_empty' => false
        );
        $this->path    = BASE_FOLDER . '/.dev/Tests/Data/Testcases/test1.txt';

        $this->assertfileExists($this->path);

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Ftp::delete
     */
    public function testDeleteSingleFolder()
    {
        $this->options = array(
            'delete_empty' => true
        );
        $this->path    = BASE_FOLDER . '/.dev/Tests/Data/doit';

        $this->assertfileExists($this->path);

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Ftp::delete
     */
    public function testDeleteMultipleFolderOnlyFiles()
    {
        $this->options = array(
            'delete_empty' => false
        );

        $this->path = BASE_FOLDER . '/.dev/Tests/Data/Testcases/Directorytree1';

        $this->assertfileExists($this->path);

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Ftp::delete
     */
    public function testDeleteMultipleFolderDeleteAll()
    {
        $this->options = array(
            'delete_empty' => true
        );

        $this->path = BASE_FOLDER . '/.dev/Tests/Data';

        $this->assertfileExists($this->path);

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Ftp::delete
     * @expectedException Molajo\Filesystem\Exception\NotFoundException
     */
    public function testNotAFile()
    {
        $this->options = array(
            'delete_empty' => true
        );

        $this->path = BASE_FOLDER . '/.dev/Tests/Dataeeeeee';

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        return;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
