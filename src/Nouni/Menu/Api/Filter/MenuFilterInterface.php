<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:28
 */

namespace Nouni\Menu\Api\Filter;

use Nouni\Menu\Api\Menu\MenuInterface;


/**
 * Interface MenuFilterInterface
 * @package Nouni\Menu\Api\Filter
 * @author NOUNI EL BACHIR
 */
interface MenuFilterInterface
{
    /**
     *
     * @param MenuInterface $menu
     * @throws MenuException
     * @return MenuInterface filtered
     */
    function do_filter(MenuInterface $menu);
} 