<?php

namespace CupCake2\Core;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class CupDataBase {

    /**
     * EntityManager do Projeto 
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;

    public function __construct(array $config, $isDevMode = false) {
        $dbParams = $config['dbParams'];
        $cupcakePath = array("/cupcake2/models");
        $paths = array_merge($cupcakePath, $config['models_dir']);
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    public function buscarUmPorId($entidade, $id) {
        return $this->getEntityManager()->find($entidade, $id);
    }

    public function buscarUmPorCriteria($entity, array $criteria, array $orderBy = null) {
        return $this->getEntityManager()->getRepository($entity)->findOneBy($criteria, $orderBy);
    }

    public function buscarTodos($entidade) {
        return $this->getEntityManager()->getRepository($entidade)->findAll();
    }

    /**
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

}
