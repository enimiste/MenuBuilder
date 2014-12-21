<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:15
 */

namespace Nouni\Menu\Api;

/**
 * Interface VisibilityInterface
 * @package Nouni\Menu
 * @author NOUNI EL BACHIR
 */
interface VisibilityInterface
{
    /**
     * @return bool
     */
    function is_visible();

    /**
     * @param bool $value
     */
    function set_visibility($value);
} 