<?php

namespace Obiz\Common\Persistence\Provider;

class DrupalProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entity;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $concreteDrupalProvider;

    public function setUp()
    {
        $this->entity = $this->getMockForAbstractClass('Obiz\Common\Entity');

        $this->concreteDrupalProvider = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\Strategy\DrupalProvider'
        );
    }

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Obiz\Common\Persistence\Strategy\DrupalProvider'),
            'Class not found: ' . $class
        );
    }

    public function testGetMethodWhenConcreteProviderReturnsEntity()
    {
        $this->concreteDrupalProvider->expects($this->once())
             ->method('nodeToEntity')
             ->will($this->returnValue($this->entity));

        $this->assertInstanceOf('Obiz\Common\Entity',
            $this->concreteDrupalProvider->get(1, 'Obiz\Common\Entity'));
    }

    public function testGetMethodWhenDrupalProviderReturnsNonEntity()
    {
        $this->concreteDrupalProvider->expects($this->once())
             ->method('nodeToEntity')
             ->will($this->returnValue(false));

        $this->assertFalse($this->concreteDrupalProvider
                                ->get(1, 'Obiz\Common\Entity'));
    }
}