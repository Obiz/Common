<?php

namespace Obiz\Common\Time;

/**
 * Provides an abstration to get system time, so that
 * time management can be mocked in tests.
 *
 * @author Julien Roubieu <julien@obiz.com.br>
 */
class SystemTimeMaster implements TimeMaster
{
    /**
     * Returns the current unix timestamp.
     *
     * @return timestamp
     */
    public function time()
    {
    	return time();
    }
}