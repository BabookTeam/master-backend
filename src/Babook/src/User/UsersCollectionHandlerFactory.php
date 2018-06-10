<?php

declare(strict_types=1);

namespace App\User;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class UsersCollectionHandlerFactory
{

    /**
     * Undocumented function
     *
     * @param ContainerInterface $container
     * @return UsersCollectionHandler
     */
    public function __invoke(ContainerInterface $container) : UsersCollectionHandler
    {


        $em = $container->get('doctrine.entity_manager.orm_default');

        return new UsersCollectionHandler($container->get(ResourceGenerator::class), $container->get(HalResponseFactory::class), $em);
    }
}
