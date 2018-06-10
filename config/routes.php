<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Authentication;
use Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', Babook\Handler\UsersCollectionHandler::class, 'home');
 * $app->post('/album', Babook\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', Babook\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', Babook\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', Babook\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', Babook\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', Babook\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     Babook\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get('/api/users[/{id}]', App\User\UsersCollectionHandler::class, 'api.users');
    $app->post('/api/users', [
     
        BodyParamsMiddleware::class,
        App\User\CreateUserHandler::class
    ]);
        // API docs
    $app->get('/api/doc/invalid-parameter', App\Doc\InvalidParameterHandler::class);
    $app->get('/api/doc/method-not-allowed-error', App\Doc\MethodNotAllowedHandler::class);
    $app->get('/api/doc/resource-not-found', App\Doc\ResourceNotFoundHandler::class);
    $app->get('/api/doc/parameter-out-of-range', App\Doc\OutOfBoundsHandler::class);
    $app->get('/api/doc/runtime-error', App\Doc\RuntimeErrorHandler::class);
};
