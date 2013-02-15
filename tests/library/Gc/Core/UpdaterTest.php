<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Library
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Gc\Core;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class UpdaterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Updater
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_object = new Updater;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->_object);
    }

    /**
     * @covers Gc\Core\Updater::init
     * @covers Gc\Version::getLatest
     */
    public function testInit()
    {
        $this->assertNull($this->_object->init());
    }

    /**
     * @covers Gc\Core\Updater::load
     */
    public function testLoad()
    {
        $this->assertTrue($this->_object->load('git'));
        $this->assertFalse($this->_object->load('ssh'));
    }

    /**
     * @covers Gc\Core\Updater::update
     */
    public function testUpdate()
    {
        $this->_object->load('git');
        $this->assertTrue($this->_object->update());
    }

    /**
     * @covers Gc\Core\Updater::update
     */
    public function testUpdateWithoutAdapter()
    {
        $this->assertFalse($this->_object->update());
    }

    /**
     * @covers Gc\Core\Updater::upgrade
     */
    public function testUpgrade()
    {
        $this->_object->load('git');
        $this->assertTrue($this->_object->upgrade());
    }

    /**
     * @covers Gc\Core\Updater::rollback
     */
    public function testRollback()
    {
        $this->_object->load('git');
        $this->assertTrue($this->_object->rollback('version'));
    }

    /**
     * @covers Gc\Core\Updater::rollback
     */
    public function testRollbackWithoutAdapter()
    {
        $this->assertFalse($this->_object->rollback('version'));
    }

    /**
     * @covers Gc\Core\Updater::upgrade
     */
    public function testUpgradeWithoutAdapter()
    {
        $this->assertFalse($this->_object->upgrade());
    }

    /**
     * @covers Gc\Core\Updater::updateDatabase
     */
    public function testUpdateDatabase()
    {
        $existed = in_array('zend.view', stream_get_wrappers());
        if($existed)
        {
            stream_wrapper_unregister('zend.view');
        }

        stream_wrapper_register('zend.view', '\Gc\View\Stream');

        file_put_contents('zend.view://test-updater', 'SELECT * FROM core_config_data');
        $this->_object->load('git');
        $this->assertTrue($this->_object->updateDatabase());
    }

    /**
     * @covers Gc\Core\Updater::updateDatabase
     */
    public function testUpdateDatabaseWithEmptyFiles()
    {
        $existed = in_array('zend.view', stream_get_wrappers());
        if($existed)
        {
            stream_wrapper_unregister('zend.view');
        }

        stream_wrapper_register('zend.view', '\Gc\View\Stream');
        file_put_contents('zend.view://test-updater', ' ');

        $this->_object->load('git');
        $this->assertTrue($this->_object->updateDatabase());
    }

    /**
     * @covers Gc\Core\Updater::updateDatabase
     */
    public function testUpdateDatabaseWithSqlError()
    {
        $existed = in_array('zend.view', stream_get_wrappers());
        if($existed)
        {
            stream_wrapper_unregister('zend.view');
        }

        stream_wrapper_register('zend.view', '\Gc\View\Stream');
        file_put_contents('zend.view://test-updater', 'SELECT FROM core_config_data');

        $this->_object->load('git');
        $this->assertFalse($this->_object->updateDatabase());
    }

    /**
     * @covers Gc\Core\Updater::updateDatabase
     */
    public function testUpdateDatabaseWithoutAdapter()
    {
        $this->assertFalse($this->_object->updateDatabase());
    }


    /**
     * @covers Gc\Core\Updater::getMessages
     */
    public function testGetMessages()
    {
        $this->_object->load('git');
        $this->assertInternalType('array', $this->_object->getMessages());
    }
}
