<?php

namespace Obiz\Common\Persistence\Provider;

class DrupalProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityStub;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $drupalProviderStub;

    public function setUp()
    {
        $this->entityStub = $this->getMockForAbstractClass('Obiz\Common\Entity');
        $this->drupalProviderStub = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\Provider\DrupalProvider');
    }

    public function tearDown()
    {
        unset($this->entityStub);
        unset($this->drupalProviderStub);
    }

    public function assertPreConditions()
    {
        $this->assertTrue(
            $class = interface_exists('Obiz\Common\Entity'),
            'Class not found: ' . $class
        );

        $this->assertTrue(
            $class = class_exists('Obiz\Common\Persistence\Provider\DrupalProvider'),
            'Class not found: ' . $class
        );
    }

    public function testGetMethodWhenDrupalProviderReturnsEntity()
    {
        $this->drupalProviderStub->expects($this->once())
                                 ->method('nodeToEntity')
                                 ->will($this->returnValue($this->entityStub));

        $this->assertInstanceOf('Obiz\Common\Entity',
            $this->drupalProviderStub->get(1, 'Obiz\Common\Entity'));
    }

    public function testGetMethodWhenDrupalProviderReturnsNonEntity()
    {
        $this->drupalProviderStub->expects($this->once())
                                 ->method('nodeToEntity')
                                 ->will($this->returnValue(false));

        $this->assertFalse($this->drupalProviderStub->get(1, 'Obiz\Common\Entity'));
    }
}