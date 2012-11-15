<?php

namespace Obiz\Common\Persistence\Provider;

class DrupalProviderTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        $this->assertTrue(
            $class = class_exists('Obiz\Common\Persistence\Provider\DrupalProvider'),
            'Class not found: ' . $class
        );
    }

    public function testGetWhenConcreteProviderFindsRecord()
    {
        $stub = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\Provider\DrupalProvider');

        $entityStub = $this->getMockForAbstractClass('Obiz\Common\Entity');

        $stub->expects($this->any())
             ->method('nodeToEntity')
             ->will($this->returnValue($entityStub));

        $this->assertInstanceOf('Obiz\Common\Entity',
            $stub->get(1, 'Obiz\Common\Entity'));
    }

    public function testGetWhenConcreteProviderDoesNotFindRecord()
    {
        $stub = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\Provider\DrupalProvider');

        $stub->expects($this->any())
            ->method('nodeToEntity')
            ->will($this->returnValue(false));

        $this->assertFalse($stub->get(1, 'Obiz\Common\Entity'));
    }
}