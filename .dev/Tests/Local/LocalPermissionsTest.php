<?php
namespace Local;

use Exception;
use Molajo\Filesystem\Exception\NotFoundException;
use Molajo\Filesystem\Exception\FilesystemException;

use Molajo\Filesystem\Adapter as fsAdapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-26 at 06:27:20.
 */
class LocalPermissionsTest extends Data
{
    /**
     * Initialises Adapter
     */
    protected function setUp()
    {
        parent::setUp();

        $this->filesystem_type = 'Local';
        $this->options         = array();
    }

    /**
     * @covers Molajo\Filesystem\Type\Local::read
     */
    public function testPermissionsTTTSuccess()
    {
        $this->options = array(
            'change_readable'   => true,
            'change_writable'   => true,
            'change_executable' => true
        );
        $this->path    = BASE_FOLDER . '/.dev/Tests/Data/Testcases/test1.txt';
        $this->action  = 'changePermission';

        var_dump(stat($this->path ));
        $stat = stat($this->path );
        print_r(posix_getpwuid($stat['uid']));
        die;

        $adapter = new fsAdapter($this->action, $this->path, $this->filesystem_type, $this->options);

        $this->assertEquals(true, is_readable($this->path));
        $this->assertEquals(true, is_writeable($this->path));
        $this->assertEquals(true, is_executable($this->path));

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
