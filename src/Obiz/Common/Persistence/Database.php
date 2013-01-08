<?php

namespace Obiz\Common\Persistence;

/**
 * Represents a database object.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
interface Database
{
    /**
     * Executes a query.
     *
     * @param string $query
     */
    public function query($query);
}
