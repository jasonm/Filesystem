<?php
namespace Tests\Integration;

use \PHPUnit_Framework_TestCase;

use Molajo\Filesystem\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-26 at 06:27:20.
 */
class LocalReadTest extends Data
{
    /**
     * @var Adapter Name
     */
    protected $filesystem_type;

    /**
     * @var Path
     */
    protected $path;

    /**
     * @var Options
     */
    protected $options = array();

    /**
     * @var Filesystem
     */
    protected $fs;

    /**
     * Initialises Adapter
     */
    protected function setUp()
    {
        parent::setUp();

        $this->fs_name = 'Local';
        $this->action       = 'Read';
        $this->path         = BASE_FOLDER . '/Tests/Data/test1.txt';
        $this->options      = array();
    }

    /**
     * @covers Molajo\Filesystem\Targetinterface\Local::read
     */
    public function testSuccessfulRead()
    {
        $connect = new Adapter($this->fs_name, $this->path, $this->action, $this->options = array());

        $this->assertEquals('Local', $connect->fs->filesystem_type);
        $this->assertEquals('/', $connect->fs->root);
        $this->assertEquals(1, $connect->fs->persistence);
        $this->assertEquals(0755, $connect->fs->default_directory_permissions);
        $this->assertEquals(0644, $connect->fs->default_file_permissions);
        $this->assertEquals(1, $connect->fs->read_only);
        $this->assertEquals(true, $connect->fs->is_readable);
        $this->assertEquals(true, $connect->fs->is_writable);
        $this->assertEquals(false, $connect->fs->is_executable);
        $this->assertEquals(
            BASE_FOLDER . '/Tests/Data/test1.txt',
            $connect->fs->path
        );
        $this->assertEquals(true, $connect->fs->exists);
        $this->assertEquals(
            BASE_FOLDER . '/Tests/Data/test1.txt',
            $connect->fs->absolute_path
        );
        $this->assertEquals(true, $connect->fs->is_absolute_path);
        $this->assertEquals(false, $connect->fs->is_directory);
        $this->assertEquals(true, $connect->fs->is_file);
        $this->assertEquals(false, $connect->fs->is_link);
        $this->assertEquals('file', $connect->fs->type);
        $this->assertEquals('test1.txt', $connect->fs->name);
        $this->assertEquals(
            BASE_FOLDER . '/Tests/Data',
            $connect->fs->parent
        );
        $this->assertEquals('txt', $connect->fs->extension);
        $this->assertEquals(18, $connect->fs->size);
        $this->assertEquals('text/plain; charset=us-ascii', $connect->fs->mime_type);

        $this->assertEquals('yabba, dabba, doo', trim($connect->fs->action_results));

        return;
    }

    /**
     * @covers Molajo\Filesystem\Targetinterface\Local::read
     * @expectedException Molajo\Filesystem\Exception\FileNotFoundException
     */
    public function testUnsuccessfulRead()
    {
        $this->path = BASE_FOLDER . '/Tests/Data/testreally-is-not-there.txt';
        $connect    = new Adapter($this->fs_name, $this->path, $this->action, $this->options = array());

        return;
    }

    /**
     * @covers Molajo\Filesystem\Targetinterface\Local::read
     * @expectedExceptionMolajo\Filesystem\Exception\FileException
     */
    public function testNotAFile()
    {
        $this->path = BASE_FOLDER . '/Tests';
        $connect    = new Adapter($this->fs_name, $this->path, $this->action, $this->options = array());

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
