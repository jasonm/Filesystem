<?php
namespace Tests\Integration;

use \PHPUnit_Framework_TestCase;

use Molajo\Filesystem\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-26 at 06:27:20.
 */
class LocalWriteTest extends Data
{
    /**
     * @var Adapter Name
     */
    protected $filesystem_type;

    /**
     * @var Action
     */
    protected $action;

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
        $this->action       = 'Write';
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::write
     */
    public function testSuccessfulWrite()
    {
        if (file_exists(BASE_FOLDER . '/Tests' . '/' . 'test2.txt')) {
            \unlink(BASE_FOLDER . '/Tests' . '/' . 'test2.txt');
        }

        $temp = 'test2.txt';

        $this->options = array(
            'file'    => $temp,
            'replace' => false,
            'data'    => 'Here are the words to write.',
        );


        $this->path = BASE_FOLDER . '/Tests';

        $this->assertfileNotExists($this->path . '/' . $temp);

        $connect = new Adapter($this->fs_name, $this->path, $this->action, $this->options);

        $this->assertfileExists($this->path . '/' . $temp);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::write
     */
    public function testSuccessfulRewrite()
    {
        $temp = 'test2.txt';

        $this->options = array(
            'file'    => $temp,
            'replace' => true,
            'data'    => 'Here are the words to write.',
        );

        $this->path = BASE_FOLDER . '/Tests';

        if (file_exists($this->path . '/' . $temp)) {
        } else {
            \file_put_contents($this->path . '/' . $temp, 'data');
        }

        $this->assertfileExists($this->path . '/' . $temp);

        $connect = new Adapter($this->fs_name, $this->path, $this->action, $this->options);

        $this->assertfileExists($this->path . '/' . $temp);

        return;
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::write
     * @expectedException Molajo\Filesystem\Exception\FileException
     */
    public function testUnsuccessfulRewrite()
    {

        $temp = 'test2.txt';

        $this->options = array(
            'file'    => $temp,
            'replace' => false,
            'data'    => 'Here are the words to write.',
        );

        $this->path = BASE_FOLDER . '/Tests';

        $connect = new Adapter($this->fs_name, $this->path, $this->action, $this->options);

        return;

    }

    /**
     * @covers Molajo\Filesystem\Type\Local::write
     */
    public function testCreateSingleFolder()
    {
        $temp = 'OneMoreFolder';

        $this->options = array(
            'file'    => $temp,
            'replace' => false,
            'data'    => ''
        );

        $this->path = BASE_FOLDER . '/Tests/Data';

        $this->assertfileNotExists($this->path . '/' . $temp);

        $connect = new Adapter($this->fs_name, $this->path, $this->action, $this->options);

        $this->assertfileExists($this->path . '/' . $temp);

        return;
    }

    /**
     * rmdir($filePath);
     *  unlink($filePath);
     *
     * @covers Molajo\Filesystem\Type\Local::write
     */
    public function testCreateMultipleFolders()
    {
        $temp = 'sometimes.txt';

        $this->options = array(
            'file'    => $temp,
            'replace' => false,
            'data'    => 'Poop'
        );

        $this->path = BASE_FOLDER . '/Tests/Data/OneMoreFolder/Cats/love/Dogs';

        $this->assertfileNotExists($this->path . '/' . $temp);

        $connect = new Adapter($this->fs_name, $this->path, $this->action, $this->options);

        $this->assertfileExists($this->path . '/' . $temp);

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
