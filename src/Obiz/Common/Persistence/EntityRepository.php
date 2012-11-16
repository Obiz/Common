<?php

namespace Obiz\Common\Persistence;

use Obiz\Common\Entity;
use Obiz\Common\Persistence\StrategyProvider;
use Doctrine\ORM\EntityRepository as DoctrineEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Entity repository that provides a set of useful data fecthing methods.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
abstract class EntityRepository extends DoctrineEntityRepository
{
    /**
     * Strategy for different data access strategies.
     *
     * @var \Obiz\Common\Persistence\StrategyProvider
     */
    protected $provider;

    /**
     * Initializes a new EntityRepository.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param \Doctrine\ORM\Mapping\ClassMetadata $class
     * @param \Obiz\Common\Persistence\StrategyProvider $provider
     */
    public function __construct($em, ClassMetadata $class, StrategyProvider $provider)
    {
        $this->provider = $provider;
        parent::__construct($em, $class);
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
        $entity = $this->provider->get($id, $this->getClassMetadata()->getName());

        if(!$entity instanceof Entity) {
            throw new EntityNotFoundException();
        }

        return $entity;
    }
}