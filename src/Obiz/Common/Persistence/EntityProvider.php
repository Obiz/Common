<?php

namespace Obiz\Common\Persistence;

/**
 * Provider interface for different data access and persistence strategies.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
interface EntityProvider
{
    /**
     * Find one database record and return it as an Entity.
     *
     * @param int $id
     * @param string $entityClassNamespace
     * @return \Obiz\Common\Entity
     * @throws \Obiz\Common\Entity\Exception\NotFoundException
     */
    public function get($id, $entityClassNamespace);
}