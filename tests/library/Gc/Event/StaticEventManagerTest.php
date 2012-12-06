<?php
namespace Gc\Event;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class StaticEventManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StaticEventManager
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * @covers Gc\Event\StaticEventManager::setInstance
     * @covers Gc\Event\StaticEventManager::__construct
     */
    protected function setUp()
    {
        $this->_object = StaticEventManager::getInstance();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->_object->resetInstance();
        unset($this->_object);
    }

    /**
     * @covers Gc\Event\StaticEventManager::getInstance
     */
    public function testGetInstance()
    {
        $this->tearDown();
        $this->setUp();
        $this->assertInstanceOf('Gc\Event\StaticEventManager', StaticEventManager::getInstance());
    }

    /**
     * @covers Gc\Event\StaticEventManager::setInstance
     */
    public function testSetInstance()
    {
        StaticEventManager::setInstance($this->_object);
        $this->assertInstanceOf('Gc\Event\StaticEventManager', StaticEventManager::getInstance());
    }

    /**
     * @covers Gc\Event\StaticEventManager::hasInstance
     */
    public function testHasInstance()
    {
        $this->assertTrue(StaticEventManager::hasInstance());
    }

    /**
     * @covers Gc\Event\StaticEventManager::resetInstance
     */
    public function testResetInstance()
    {
        $this->_object->resetInstance();
        $this->assertFalse($this->_object->hasInstance());
    }

    /**
     * @covers Gc\Event\StaticEventManager::getEvent
     */
    public function testGetEventWithoutRegisteredEvent()
    {
        $this->assertFalse($this->_object->getEvent('null'));
    }

    /**
     * @covers Gc\Event\StaticEventManager::getEvent
     */
    public function testGetEvent()
    {
        $this->_object->attach('Event', 'do', function($e)
        {
            //Fake declare to create Event
        });


        $this->assertInstanceOf('Zend\EventManager\EventManager', $this->_object->getEvent('Event'));
    }

    /**
     * @covers Gc\Event\StaticEventManager::trigger
     */
    public function testTrigger()
    {
        $this->_object->attach('Event', 'do', function($e)
        {
            return $e->getName();
        });

        $this->assertInstanceOf('Zend\EventManager\ResponseCollection', $this->_object->trigger('Event', 'do'));
    }

    /**
     * @covers Gc\Event\StaticEventManager::trigger
     */
    public function testTriggerWithoutRegisteredEvent()
    {
        $this->assertFalse($this->_object->trigger('Event', 'do'));
    }
}
