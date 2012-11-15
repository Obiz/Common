<?php

namespace Obiz\Common\Persistence;

use Obiz\Common\Persistence\EntityProvider;
use Obiz\Common\Entity;
use Obiz\Common\Entity\Exception\NotFoundException;

/**
 * Entity repository that provides a set of useful data fecthing methods.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
abstract class EntityRepository
{
    /**
     * @var string
     */
    protected $entity;

    /**
     * @var \Obiz\Common\Persistence\EntityProvider
     */
    protected $provider;

    /**
     * @param string $entity
     * @param \Obiz\Common\Persistence\EntityProvider $provider
     */
    public function __construct($entity, EntityProvider $provider)
    {
        $this->entity   = $entity;
        $this->provider = $provider;
    }

    /**
     * Find one database record and return it as an Entity.
     *
     * @param int $id The record id
     * @throws \Obiz\Common\Entity\Exception\NotFoundException
     * @return \Obiz\Common\Entity
     */
    public function get($id)
    {
        $entity = $this->provider->get($id, $this->entity);

        if(!$entity instanceof Entity) {
            throw new NotFoundException();
        }

        return $entity;
    }
}