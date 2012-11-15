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

    public function concreteProviderInvalidReturnValues()
    {
        return array(
            array(null),
            array(true),
            array(false),
            array('foo'),
            array(array('foo' => 'bar'))
        );
    }

    /**
     * @dataProvider concreteProviderInvalidReturnValues
     * @expectedException \Obiz\Common\Entity\Exception\NotFoundException
     */
    public function testGetThrowsException($returnValue)
    {
        $stub = $this->getDrupalProviderStub();

        $stub->expects($this->any())
             ->method('nodeToEntity')
             ->will($this->returnValue($returnValue));

        $stub->get(1, 'Obiz\Common\Entity');
    }

    public function testGetWhenConcreteProviderReturnsObject()
    {
        $stub = $this->getDrupalProviderStub();
        $entityStub = $this->getMockForAbstractClass('Obiz\Common\Entity');

        $stub->expects($this->any())
            ->method('nodeToEntity')
            ->will($this->returnValue($entityStub));

        $this->assertInstanceOf('Obiz\Common\Entity',
            $stub->get(1, 'Obiz\Common\Entity'));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getDrupalProviderStub()
    {
        return $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\Provider\DrupalProvider');
    }
}