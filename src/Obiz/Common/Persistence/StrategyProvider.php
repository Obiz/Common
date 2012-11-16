<?php

namespace Obiz\Common\Persistence;

/**
 * Strategy interface for different data access and persistence strategies.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
interface StrategyProvider
{
    /**
     * Find one database record and return it as an Entity.
     *
     * @param int $id
     * @param string $entityClassNamespace
     * @return mixed The entity, if found, and false otherwise
     */
    public function get($id, $entityClassNamespace);
}