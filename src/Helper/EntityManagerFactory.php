<?php

namespace Alura\Doctrine\Helper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../..';
        $config = Setup::createAnnotationMetadataConfiguration(
            [$rootDir . '/src'],
            true
        );

        $connection = [
            'driver' => 'pdo_mysql',
            'host' => '172.17.0.2',
            'dbname' => 'curso_doctrine',
            'user' => 'root',
            'password' => '123456'
        ];

        return EntityManager::create($connection, $config);
    }
}