<?php

declare(strict_types=1);

namespace App;

use Zend\Expressive\Hal\Metadata\MetadataMap;
use Zend\Expressive\Hal\Metadata\RouteBasedCollectionMetadata;
use Zend\Expressive\Hal\Metadata\RouteBasedResourceMetadata;
use Zend\Hydrator\ObjectProperty as ObjectPropertyHydrator;

/**
 * The configuration provider for the Babook module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            MetadataMap::class => $this->getHalConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [

            ],
            'factories'  => [
                User\UsersCollectionHandler::class => User\UsersCollectionHandlerFactory::class,
                User\CreateUserHandler::class => User\CreateUserHandlerFactory::class,
            ],
        ];
    }

    public function getHalConfig() : array
    {
        return [
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => User\UserEntity::class,
                'entity_identifier_name' => 'id',
                'route' => 'api.users',
                'extractor' => ObjectPropertyHydrator::class,
            ],
            [
                '__class__' => RouteBasedResourceMetadata::class,
                'resource_class' => Entity\User::class,
                'entity_identifier_name' => 'id',
                'route' => 'api.users',
                'extractor' => ObjectPropertyHydrator::class,
            ],
            [
                '__class__' => RouteBasedCollectionMetadata::class,
                'collection_class' => User\UserCollection::class,
                'collection_relation' => 'users',
                'route' => 'api.users',
            ]
        ];
    }
}
