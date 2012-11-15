<?php

namespace Obiz\Common\Persistence;

use Obiz\Common\Persistence\EntityProvider;

class EntityRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityStub;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityProviderStub;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityRepositoryStub;

    public function setUp()
    {
        $this->entityStub = $this->getMockForAbstractClass('Obiz\Common\Entity');

        $this->entityProviderStub = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\EntityProvider');

        $this->entityRepositoryStub = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\EntityRepository', array(
            'Obiz\Common\Entity',
            $this->entityProviderStub
        ));
    }

    public function tearDown()
    {
        unset($this->entityStub);
        unset($this->entityProviderStub);
        unset($this->entityRepositoryStub);
    }

    public function concreteProviderInvalidReturnValues()
    {
        return array(
            array(null),
            array(true),
            array(false),
            array('foo'),
            array(array('foo' => 'bar')),
        );
    }

    public function assertPreConditions()
    {
        $this->assertTrue(
            interface_exists($interface = 'Obiz\Common\Entity'),
            'Interface not found: ' . $interface
        );

        $this->assertTrue(
            interface_exists($interface = 'Obiz\Common\Persistence\EntityProvider'),
            'Interface not found: ' . $interface
        );

        $this->assertTrue(
            class_exists($class = 'Obiz\Common\Entity\Exception\NotFoundException'),
            'Class not found: ' . $class
        );

        $this->assertTrue(
            class_exists($class = 'Obiz\Common\Persistence\EntityRepository'),
            'Class not found: ' . $class
        );
    }

    public function testInstantiateConcreteEntityRepository()
    {
        $this->assertInstanceOf('Obiz\Common\Persistence\EntityRepository',
            $this->entityRepositoryStub);
    }

    /**
     * @expectedException \Exception
     */
    public function testInstantiateConcreteEntityRepositoryWithoutArgumentsThrowsException()
    {
        $this->getMockForAbstractClass('Obiz\Common\Persistence\EntityRepository');
    }

    public function testGetMethodWhenConcreteProviderReturnsEntity()
    {
        $this->entityProviderStub->expects($this->once())
            ->method('get')
            ->will($this->returnValue($this->entityStub));

        $this->assertInstanceOf(
            'Obiz\Common\Entity', $this->entityRepositoryStub->get(1));
    }

    /**
     * @dataProvider concreteProviderInvalidReturnValues
     * @expectedException \Obiz\Common\Entity\Exception\NotFoundException
     */
    public function testGetMethodThrowsExceptionWhenConcreteProviderReturnsNonEntity($returnValue)
    {
        $this->entityProviderStub->expects($this->once())
            ->method('get')
            ->will($this->returnValue($returnValue));

        $this->assertInstanceOf(
            'Obiz\Common\Entity', $this->entityRepositoryStub->get(1));
    }
}