<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:34
 */

namespace Nouni\Menu\Api\Menu;


/**
 * Interface MenuGroupInterface
 * @package Nouni\Menu\Api
 * @author NOUNI EL BACHIR
 */
interface MenuGroupInterface extends SubMenuInterface
{

    /**
     * icon name
     * @return string
     */
    function getIcon();

    /**
     * @param string $icon
     */
    function setIcon($icon);
} 