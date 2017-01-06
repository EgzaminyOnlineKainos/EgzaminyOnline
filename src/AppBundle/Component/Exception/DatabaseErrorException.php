<?php
namespace AppBundle\Component\Exception;

use Exception;

class DatabaseErrorException extends Exception
{
    const ERROR_CODE           = 1000;
    const ERROR_DEFAULT_MESSAGE = "A database error has occured.";

    public function __construct(Exception $previous = null)
    {
        parent::__construct(self::ERROR_DEFAULT_MESSAGE, self::ERROR_CODE, $previous);
    }
}