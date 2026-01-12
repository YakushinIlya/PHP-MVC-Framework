<?php
declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class HttpException extends RuntimeException
{
    public function __construct(
        string $message = 'HTTP Error',
        private int $statusCode = 500
    ) {
        parent::__construct($message, $statusCode);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}