<?php

namespace Obiz\Common\Time;

use \DateTime;

/**
 * Provides an abstration to get system time, so that
 * time management can be mocked in tests.
 *
 * @author Julien Roubieu <julien@obiz.com.br>
 */
class SystemTimeMaster implements TimeMaster
{
    /**
     * @return \DateTime
     */
    public function time()
    {
    	return new DateTime();
    }
}