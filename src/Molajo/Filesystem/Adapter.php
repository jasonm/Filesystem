<?php
/**
 * Request for Filesystem Services Class
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
namespace Molajo\Filesystem;

defined('MOLAJO') or die;

use Molajo\Filesystem\Adapter\FilesystemInterface;
use Molajo\Filesystem\Exception\FilesystemException;

/**
 * Request for Filesystem Services Class
 *
 * @package   Molajo
 * @license   MIT
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
Class Adapter implements FilesystemInterface
{
    /**
     * Filesystem Type
     *
     * @var     string
     * @since   1.0
     */
    public $fsType;

    /**
     * Construct
     *
     * @param   string  $action
     * @param   string  $path
     * @param   string  $filesystem_type
     * @param   array   $options
     *
     * @since   1.0
     */
    public function __construct($action = '', $path = '', $filesystem_type = 'Local', $options = array())
    {
        $options = $this->getTimeZone($options);

        if ($filesystem_type == '') {
            $filesystem_type = 'Local';
        }
        $this->getFilesystemType($filesystem_type);

        $this->connect($options);

        if ($path == '') {
            throw new FilesystemException
            ('Filesystem Path is required, but was not provided.');
        }
        $this->setPath($path);

        $this->getMetadata();

        $this->doAction($action);

        $this->close();

        return $this->fsType;
    }

    /**
     * Get the Filesystem Type (ex., Local, Ftp, Virtual, etc.)
     *
     * @param   string  $filesystem_type
     *
     * @return  void
     * @since   1.0
     * @throws  FilesystemException
     */
    protected function getFilesystemType($filesystem_type)
    {
        $class = 'Molajo\\Filesystem\\Type\\' . $filesystem_type;

        if (class_exists($class)) {
        } else {
            throw new FilesystemException
            ('Filesystem Type Class ' . $class . ' does not exist.');
        }

        $this->fsType = new $class($filesystem_type);

        return;
    }

    /**
     * Connect to the Filesystem Type
     *
     * @param   array   $options
     *
     * @return  void
     * @since   1.0
     */
    public function connect($options = array())
    {
        $this->fsType->connect($options);

        return;
    }

    /**
     * Set the Path
     *
     * @param   string  $path
     *
     * @return  void
     * @since   1.0
     */
    public function setPath($path)
    {
        $this->fsType->setPath($path);

        return;
    }

    /**
     * Retrieves and sets metadata for the file specified in path
     *
     * @return  void
     * @since   1.0
     */
    public function getMetadata()
    {
        $this->fsType->getMetadata();

        return;
    }

    /**
     * Execute the action requested
     *
     * @param   string  $action
     *
     * @return  void
     * @since   1.0
     * @throws  Exception\FilesystemException
     */
    public function doAction($action = '')
    {
        var_dump($this->fsType);
        die;

        try {
            $this->fsType->doAction($action);

        } catch (\Exception $e) {

            throw new FilesystemException
            ('Filesystem Adapter Method ' . $action . ' $action. ' . $e->getMessage());
        }

        return;
    }

    /**
     * Close the Connection
     *
     * @return  null
     * @since   1.0
     */
    public function close()
    {
        $this->fsType->close();
    }

    /**
     * Get timezone
     *
     * @param   array  $options
     *
     * @return  array
     * @since   1.0
     */
    protected function getTimeZone($options)
    {
        $timezone = '';

        if (is_array($options)) {
        } else {
            $options = array();
        }

        if (isset($options['timezone'])) {
            $timezone = $options['timezone'];
        }

        if ($timezone === '') {
            if (ini_get('date.timezone')) {
                $timezone = ini_get('date.timezone');
            }
        }

        if ($timezone === '') {
            $timezone = 'UTC';
        }

        ini_set ('date.timezone', $timezone);
        $options['timezone'] = $timezone;

        return $options;
    }
}
