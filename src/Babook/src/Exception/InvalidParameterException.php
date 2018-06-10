<?php
declare(strict_types=1);
namespace App\Exception;

use DomainException;
use Zend\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Zend\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

/**
 * Handele InvalidParameterException
 * @method self create()
 */
class InvalidParameterException extends DomainException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;
    /**
     * Create InvalidParameterException
     * @param string $message custom error message
     * @param array $additionalData array with aditional information to fix invalids parameters
     * @return self
     */
    public static function create(string $message, array $additionalData = []) : self
    {
        $e = new self($message);
        $e->status = 400;
        $e->detail = $message;
        $e->type = '/api/doc/invalid-parameter';
        $e->title = 'Invalid parameter';
        $e->additional['parameters'] = $additionalData;
        return $e;
    }
}
