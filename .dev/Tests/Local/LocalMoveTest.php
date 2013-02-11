<?php
namespace Local;

use Molajo\Filesystem\Adapter as fsAdapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-26 at 06:27:20.
 */
class LocalMoveTest extends Data
{
    /**
     * Initialises Adapter
     */
    protected function setUp()
    {
        parent::setUp();

        /** initialise call */
        $this->filesystem_type = 'Local';
        $this->action          = 'Move';

        return;
    }

    /**
     * Should default target directory to $this->path
     *
     * @covers Molajo\Filesystem\Type\Local::copyOrMove
     */
    public function testSuccessfulMoveSingleFileBlankDirectory()
    {
        $temp = BASE_FOLDER . '/.dev/Tests/Data/Testcases';

        $this->options = array(
            'target_directory'       => '',
            'target_name'            => 'test2.txt',
            'replace'                => false,
            'target_filesystem_type' => 'Local'
        );

        $this->path = BASE_FOLDER . '/.dev/Tests/Data/Testcases/test1.txt';

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileExists($temp . '/test2.txt');
        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::copyOrMove
     */
    public function testSuccessfulMoveSingleFile()
    {
        $temp = BASE_FOLDER . '/.dev/Tests/Data/Testcases';

        $this->options = array(
            'target_directory'       => '',
            'target_name'            => 'test2.txt',
            'replace'                => false,
            'target_filesystem_type' => 'Local'
        );
        $this->path    = BASE_FOLDER . '/.dev/Tests/Data/Testcases/test1.txt';

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileExists($temp . '/test2.txt');
        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::copyOrMove
     */
    public function testMoveSingleFolder()
    {
        $temp = BASE_FOLDER . '/.dev/Tests/Data';

        $this->options = array(
            'target_directory'       => $temp,
            'target_name'            => 'didit',
            'replace'                => false,
            'target_filesystem_type' => 'Local'
        );
        $this->path    = BASE_FOLDER . '/.dev/Tests/Data/doit';

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileExists($temp . '/didit');
        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::copyOrMove
     */
    public function testMoveMultipleFolder()
    {
        $temp = BASE_FOLDER . '/.dev/Tests/Data';

        $this->options = array(
            'target_directory'       => $temp,
            'target_name'            => 'Amy',
            'replace'                => false,
            'target_filesystem_type' => 'Local'
        );
        $this->path    = BASE_FOLDER . '/.dev/Tests/Data/Testcases';

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertfileExists($temp . '/Amy');
        $this->assertfileNotExists($this->path);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::copyOrMove
     * @expectedException Molajo\Filesystem\Exception\FilesystemException
     */
    public function testNotAFile()
    {
        $this->options = array(
            'target_directory'       => BASE_FOLDER . '/.dev/Tests/Data',
            'target_name'            => 'Amy',
            'replace'                => false,
            'target_filesystem_type' => 'Local'
        );

        $this->path = BASE_FOLDER . '/.dev/Tests/Dataeeeeee';
        $adapter    = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

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
