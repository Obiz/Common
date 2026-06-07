<?php

namespace Obiz\Common\Persistence;

interface DatabaseStatementBase
{
    public function execute($args = array(), $options = array());

    public function getQueryString();

    public function rowCount();

    public function fetchField($index = 0);

    public function fetchAssoc();

    public function fetchCol($index = 0);

    public function fetchAllKeyed($key_index = 0, $value_index = 1);

    public function fetchAllAssoc($key, $fetch = NULL);
}

