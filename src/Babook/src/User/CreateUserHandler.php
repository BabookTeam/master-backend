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
use App\Entity\User as User;

class CreateUserHandler implements RequestHandlerInterface
{
    private $em;
    private $helper;
    private $inputFilter;
    use RestDispatchTrait;
    public function __construct(
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory,
        UrlHelper $helper,
        UserInputFilter $inputFilter,
        \Doctrine\ORM\EntityManager $em
    ) {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->helper = $helper;
        $this->inputFilter = $inputFilter;
        $this->em = $em;
    }
    public function post(ServerRequestInterface $request) : ResponseInterface
    {
        $model = $this->em->getRepository(User::class);
        $id = $model->addUser($request->getParsedBody(), $this->inputFilter);
        $response = $this->createResponse($request, $model->getUser($id));
        return $response->withStatus(201)->withHeader(
            'Location',
            $this->helper->generate('api.users', ['id' => $id])
        );
    }
}
