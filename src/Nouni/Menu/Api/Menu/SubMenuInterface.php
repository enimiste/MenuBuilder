<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:47
 */

namespace Nouni\Menu\Api\Menu;

use Nouni\Menu\Api\ConvertibleToArrayInterface;
use Nouni\Menu\Api\Exception\MenuException;
use Nouni\Menu\Api\Permission\PermissionInterface;
use Nouni\Menu\Api\VisibilityInterface;

/**
 * Interface SubMenuInterface
 * @package Nouni\Menu\Api\Menu
 * @author NOUNI EL BACHIR
 */
interface SubMenuInterface extends PermissionInterface, ConvertibleToArrayInterface, VisibilityInterface
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
     * @return array array of SubMenuInterface Object
     */
    function getSub_menus();

    /**
     * @param array $sub_menus array of SubMenuInterface object
     * @return SubMenuInterface for chaining
     */
    function setSub_menus(array $sub_menus);

    /**
     * @param SubMenuInterface $submenu
     * @return SubMenuInterface for chaining
     * @throws MenuException
     */
    function addSub_menu(SubMenuInterface $submenu);

    /**
     * @param MenuItemInterface $item
     * @return SubMenuInterface for chaining
     * @throws MenuException
     */
    function add_menu_item(MenuItemInterface $item);

    /**
     * @return array ana array of MenuItemInterface object
     */
    function getMenu_items();
} 