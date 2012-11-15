<?php

namespace Obiz\Common\Persistence;

use Obiz\Common\Persistence\EntityProvider;

class EntityRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        $this->assertTrue(
            $class = class_exists('Obiz\Common\Persistence\EntityRepository'),
            'Class not found: ' . $class
        );
    }

    /**
     * @expectedException \Exception
     */
    public function testInstantiateConcreteWithoutArgumentsThrowsException()
    {
        $this->getMockForAbstractClass('Obiz\Common\Persistence\EntityRepository');
    }

    public function testInstantiateConcrete()
    {
        $entityProviderStub = $this->getMock(
            'Obiz\Common\Persistence\Provider\DrupalProvider');

        $stub = $this->getMockForAbstractClass(
            'Obiz\Common\Persistence\EntityRepository', array(
            'Obiz\Common\Entity',
            $entityProviderStub
        ));

        $this->assertInstanceOf('Obiz\Common\Persistence\EntityRepository', $stub);
    }
}