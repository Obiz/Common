<?php

namespace Obiz\Common\Persistence\Database;

interface Query
{
    /**
     * Executes an SQL query.
     *
     * @param $query
     * @return mixed
     */
    public function execute($query);
}