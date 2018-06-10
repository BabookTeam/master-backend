<?php
declare(strict_types=1);
namespace App\User;

use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Helper\UrlHelper;

class CreateUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateUserHandler
    {
        $filters = $container->get('InputFilterManager');
        $em = $container->get('doctrine.entity_manager.orm_default');
        return new CreateUserHandler(
            $container->get(ResourceGenerator::class),
            $container->get(HalResponseFactory::class),
            $container->get(UrlHelper::class),
            $filters->get(UserInputFilter::class),
            $em
        );
    }
}
