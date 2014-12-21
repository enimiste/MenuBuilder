<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:38
 */

namespace Nouni\Menu\Api\Menu;

use Nouni\Menu\Api\ConvertibleToArrayInterface;
use Nouni\Menu\Api\Permission\PermissionInterface;
use Nouni\Menu\Api\VisibilityInterface;

/**
 * Interface MenuItemInterface
 * @package Nouni\Menu\Api
 * @author NOUNI EL BACHIR
 */
interface MenuItemInterface extends PermissionInterface, ConvertibleToArrayInterface, VisibilityInterface
{
    /**
     * @return string
     */
    function getTitre();

    /**
     * @param string $titre
     */

    function setTitre($titre);

    /**
     * @return string
     */

    function getUrl();

    /**
     * @param string $url
     */
    function setUrl($url);
} 