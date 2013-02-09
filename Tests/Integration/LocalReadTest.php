<?php
namespace Integration;

use Exception;
use Molajo\Filesystem\Exception\NotFoundException;
use Molajo\Filesystem\Exception\FilesystemException;

use Molajo\Filesystem\Adapter as fsAdapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-26 at 06:27:20.
 */
class LocalReadTest extends Data
{
    /**
     * Initialises Adapter
     */
    protected function setUp()
    {
        parent::setUp();

        $this->filesystem_type = 'Local';
        $this->action          = 'Read';
        $this->path            = BASE_FOLDER . '/Tests/Data/test1.txt';
        $this->options         = array();
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::read
     */
    public function testReadSuccessful()
    {
        $adapter = new fsAdapter($this->action, $this->path);

        $this->assertEquals('Local', $adapter->fs->filesystem_type);
        $this->assertEquals('/', $adapter->fs->root);
        $this->assertEquals(true, $adapter->fs->persistence);
        $this->assertEquals(0755, $adapter->fs->default_directory_permissions);
        $this->assertEquals(0644, $adapter->fs->default_file_permissions);
        $this->assertEquals(false, $adapter->fs->read_only);
        $this->assertEquals(true, $adapter->fs->is_readable);
        $this->assertEquals(true, $adapter->fs->is_writable);
        $this->assertEquals(false, $adapter->fs->is_executable);

        $this->assertEquals(
            BASE_FOLDER . '/Tests/Data/test1.txt',
            $adapter->fs->path
        );
        $this->assertEquals(true, $adapter->fs->exists);
        $this->assertEquals(
            BASE_FOLDER . '/Tests/Data/test1.txt',
            $adapter->fs->absolute_path
        );
        $this->assertEquals(true, $adapter->fs->is_absolute_path);
        $this->assertEquals(false, $adapter->fs->is_directory);
        $this->assertEquals(true, $adapter->fs->is_file);
        $this->assertEquals(false, $adapter->fs->is_link);
        $this->assertEquals('file', $adapter->fs->type);
        $this->assertEquals('test1.txt', $adapter->fs->name);
        $this->assertEquals(
            BASE_FOLDER . '/Tests/Data',
            $adapter->fs->parent
        );
        $this->assertEquals('txt', $adapter->fs->extension);
        $this->assertEquals(18, $adapter->fs->size);
        $this->assertEquals('text/plain; charset=us-ascii', $adapter->fs->mime_type);

        $this->assertEquals('yabba, dabba, doo', trim($adapter->fs->data));

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::read
     * @expectedException Molajo\Filesystem\Exception\NotFoundException
     */
    public function testReadUnsuccessful()
    {
        $this->path = BASE_FOLDER . '/Tests/Data/testreally-is-not-there.txt';
        $adapter    = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options = array());

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::read
     * @expectedException Molajo\Filesystem\Exception\NotFoundException
     */
    public function testReadNotAFile()
    {
        $this->path = BASE_FOLDER . '/Tests';
        $adapter    = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options = array());

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
