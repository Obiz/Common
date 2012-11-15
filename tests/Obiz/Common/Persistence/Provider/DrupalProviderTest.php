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

    /**
     * @expectedException \Obiz\Common\Entity\Exception\NotFoundException
     */
    public function testGetThrowsExceptionWhenConcreteProviderReturnsFalse()
    {
        $stub = $this->getMock('Obiz\Common\Persistence\Provider\DrupalProvider');

        $stub->expects($this->any())
             ->method('nodeToEntity')
             ->will($this->returnValue(FALSE));

        $stub->get(1, 'EntityClassNamespace');
    }
}