<?php

namespace Obiz\Common\Persistence;

class EntityRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entity;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $classMetaData;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $strategyProvider;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityRepository;

    public function setUp()
    {
        $this->entity = $this->getMockForAbstractClass('Obiz\Common\Entity');

        $this->entityManager =
            $this->getMock(
                '\Doctrine\ORM\EntityManager',
                array(),
                array(),
                '',
                false
            );

        $this->classMetaData =
            $this->getMock(
                'Doctrine\ORM\Mapping\ClassMetadata',
                array(),
                array('Obiz\Common\Entity')
            );

        $this->strategyProvider =
            $this->getMockForAbstractClass(
                'Obiz\Common\Persistence\StrategyProvider'
            );

        $this->entityRepository = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\EntityRepository',
            array(
                $this->entityManager,
                $this->classMetaData,
                $this->strategyProvider
            )
        );
    }

    public function tearDown()
    {
        unset($this->entity);
        unset($this->entityManager);
        unset($this->classMetaData);
        unset($this->strategyProvider);
        unset($this->entityRepository);
    }

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Obiz\Common\Persistence\EntityRepository'),
            'Class not found: ' . $class
        );

        $this->assertClassHasAttribute(
            'provider', 'Obiz\Common\Persistence\EntityRepository');
    }

    public function strategyProviderInvalidReturnValues()
    {
        return array(
            array(null),
            array(true),
            array(false),
            array('foo'),
            array(array('foo' => 'bar')),
        );
    }


    public function testInstantiateConcrete()
    {
        $this->assertInstanceOf(
            'Obiz\Common\Persistence\EntityRepository',
            $this->entityRepository
        );
    }

    /**
     * @expectedException \Exception
     */
    public function testInstantiateConcreteWithoutArgumentsThrowException()
    {
        $this->getMock('Obiz\Common\Persistence\EntityRepository');
    }

    public function testGetMethodWhenStrategyProviderReturnsEntity()
    {
        $this->strategyProvider
             ->expects($this->once())
             ->method('get')
             ->will($this->returnValue($this->entity));

        $this->assertInstanceOf(
            'Obiz\Common\Entity', $this->entityRepository->get(1));
    }

    /**
     * @dataProvider strategyProviderInvalidReturnValues
     * @expectedException \Doctrine\ORM\EntityNotFoundException
     */
    public function testGetMethodThrowsExceptionWhenStrategyReturnsNonEntity($returnValue)
    {
        $this->strategyProvider
             ->expects($this->once())
             ->method('get')
             ->will($this->returnValue($returnValue));

        $this->assertInstanceOf(
            'Obiz\Common\Entity', $this->entityRepository->get(1));
    }
}