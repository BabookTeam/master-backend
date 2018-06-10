<?php
declare(strict_types=1);
namespace App\Exception;

use DomainException;
use Zend\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Zend\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

/**
 * Handle NoResourceFoundException
 * @method self create()
 */
class NoResourceFoundException extends DomainException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;
    /**
     * Create NoResourceFoundException
     *
     * @param string $message custom error message
     * @return self
     */
    public static function create(string $message) : self
    {
        $e = new self($message);
        $e->status = 404;
        $e->detail = $message;
        $e->type = '/api/doc/resource-not-found';
        $e->title = 'Resource not found';
        return $e;
    }
}
