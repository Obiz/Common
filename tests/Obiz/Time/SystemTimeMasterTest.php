<?php

namespace Obiz\Common\Time;

use \DateTime;

/**
 * Provides an abstration to get system time, so that
 * time management can be mocked in tests.
 *
 * @author Julien Roubieu <julien@obiz.com.br>
 */
class SystemTimeMasterTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'Obiz\Common\Time\SystemTimeMaster'),
            'Class not found: ' . $class);
    }

    public function testTimeMethod()
    {
        $systemTimeMaster = $this->getMock('Obiz\Common\Time\SystemTimeMaster');

        $systemTimeMaster->expects($this->once())
                         ->method('time')
                         ->will($this->returnValue(new DateTime()));

        $this->assertEquals(new DateTime(), $systemTimeMaster->time());
    }
}