<?php
declare(strict_types=1);
namespace App\Exception;

use DomainException;
use Zend\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Zend\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

/**
 * Handele OutOfBoundsException
 * @method self create()
 */
class OutOfBoundsException extends DomainException implements ProblemDetailsExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;

    /**
     * Create OutOfBoundsException
     *
     * @param string $message custom error message
     * @return self
     */
    public static function create(string $message) : self
    {
        $e = new self($message);
        $e->status = 400;
        $e->detail = $message;
        $e->type = '/api/doc/parameter-out-of-range';
        $e->title = 'Parameter out of range';
        return $e;
    }
}
