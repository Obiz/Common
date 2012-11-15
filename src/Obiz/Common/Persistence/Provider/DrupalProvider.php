<?php

namespace Obiz\Common\Persistence\Provider;

use Obiz\Common\Persistence\EntityProvider;
use Obiz\Common\Entity\Exception\NotFoundException;
use Obiz\Common\Entity;

/**
 * Abstract provider for data access and persistence based on Drupal's data
 * model. This class provides the basic strategy interface necessary for a
 * specific entity provider to implement.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
abstract class DrupalProvider implements EntityProvider
{
    /**
     * {@inheritdoc}
     */
    public function get($id, $entityClassNamespace)
    {
        $entity = $this->nodeToEntity($id, $entityClassNamespace);

        if(!$entity instanceof Entity) {
            throw new NotFoundException();
        }

        return $entity;
    }

    /**
     * Loads a Drupal node and converts it to an Entity.
     *
     * @param int $nid The node id
     * @param string $entityClassNamespace The entity class namespace
     * @return \Obiz\Common\Entity
     */
    abstract public function nodeToEntity($nid, $entityClassNamespace);
}