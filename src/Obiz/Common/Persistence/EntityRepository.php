<?php

namespace Obiz\Common\Persistence;

use Obiz\Common\Entity;
use Obiz\Common\Persistence\StrategyProvider;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Entity repository that provides a set of useful data fecthing methods.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
abstract class EntityRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $conn;

    /**
     * @var string
     */
    protected $entityClassNamespace;

    /**
     * Strategy for different data access strategies.
     *
     * @var \Obiz\Common\Persistence\StrategyProvider
     */
    protected $provider;

    /**
     * Initializes a new EntityRepository.
     *
     * @param \Doctrine\DBAL\Connection
     * @param string $entityClassNamespace
     * @param \Obiz\Common\Persistence\StrategyProvider $provider
     */
    public function __construct($conn, $entityClassNamespace, StrategyProvider $provider)
    {
        $this->conn = $conn;
        $this->entityClassNamespace = $entityClassNamespace;
        $this->provider = $provider;
    }

    /**
     * Find one database record and return it as an Entity.
     *
     * @param int $id The record id
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @return \Obiz\Common\Entity
     */
    public function get($id)
    {
        $entity = $this->provider->get($id);

        if(!$entity instanceof Entity) {
            throw new EntityNotFoundException();
        }

        return $entity;
    }
}