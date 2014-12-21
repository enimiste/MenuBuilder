<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 21/12/14
 * Time: 00:19
 */

namespace Nouni\Menu\Api\Exception;


use Exception;

class MenuException extends \Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


} 