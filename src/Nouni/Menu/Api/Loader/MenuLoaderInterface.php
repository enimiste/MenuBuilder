<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:16
 */

namespace Nouni\Menu\Api\Loader;

use Nouni\Menu\Api\Menu\MenuInterface;

/**
 * Class MenuLoaderInterface
 * @package Nouni\Menu\Loader
 * @author NOUNI EL BACHIR
 */
interface MenuLoaderInterface
{
    /**
     * @return MenuInterface
     */
    function load();
} 