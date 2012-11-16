<?php

namespace Obiz\Common\Persistence\Strategy;

use Obiz\Common\Persistence\StrategyProvider;

/**
 * Abstract provider for data access and persistence based on Drupal's data
 * model. This class provides the basic strategy interface necessary for a
 * specific strategy provider to implement.
 *
 * @author Daniel Ribeiro <daniel@obiz.com.br>
 */
abstract class DrupalProvider implements StrategyProvider
{
    /**
     * {@inheritdoc}
     */
    public function get($id, $entityClassNamespace)
    {
        return $this->nodeToEntity($id, $entityClassNamespace);
    }

    /**
     * Loads a Drupal node and converts it to an Entity.
     *
     * @param int $nid The node id
     * @param string $entityClassNamespace The entity class namespace
     * @return mixed The entity, if found, and false otherwise
     */
    abstract public function nodeToEntity($nid, $entityClassNamespace);
}