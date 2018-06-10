<?php

declare(strict_types=1);

namespace App\User;

use App\RestDispatchTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Helper\UrlHelper;
use Doctrine\ORM\EntityManager;
use App\Entity\User as User;

use Zend\Expressive\Hal\HalResource;
use Zend\Expressive\Hal\Link;

class UsersCollectionHandler implements RequestHandlerInterface
{

    use RestDispatchTrait;
    private $entityManager;
    
    /**
     * 
     * @param ResourceGenerator $resourceGenerator
     * @param HalResponseFactory $responseFactory
     * @param EntityManager $entityManager
     */
    public function __construct(ResourceGenerator $resourceGenerator, HalResponseFactory $responseFactory, EntityManager $entityManager)
    {
        //
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->entityManager = $entityManager;
    }
	/**
	 * @param ResponseInterface $request
	 */
    public function get(ServerRequestInterface $request) : ResponseInterface
    {

        $id = $request->getAttribute('id', false);
        return false === $id
            ? $this->getAllUsers($request)
            : $this->getUser((int) $id, $request);
    }

    private function getUser(int $id, ServerRequestInterface $request): ResponseInterface
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->getUser($id);
        return $this->createResponse(
            $request,
            $user
        );
    }
    private function getAllUsers(ServerRequestInterface $request): ResponseInterface
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->getAll();

        return $this->createResponse($request, $users);
    }
}
