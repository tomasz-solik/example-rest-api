<?php
/**
 * rest_api - ApiInterface.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 16.02.22 / 14:34
 */

namespace App\Exception;

use Throwable;

class AppException extends \RuntimeException
{
    /**
     * AppException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}