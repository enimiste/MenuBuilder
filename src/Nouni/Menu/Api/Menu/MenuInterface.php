<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:17
 */

namespace Nouni\Menu\Api\Menu;

use Nouni\Menu\Api\ConvertibleToArrayInterface;
use Nouni\Menu\Api\Exception\MenuException;

/**
 * Interface MenuInterface
 * @package Nouni\Menu
 * @author NOUNI EL BACHIR
 */
interface MenuInterface extends ConvertibleToArrayInterface
{
    /**
     * @param MenuGroupInterface $groupe
     * @return MenuInterface for chaining
     */
    function add_menu_group(MenuGroupInterface $groupe);

    /**
     * @return string
     */
    function getNom();

    /**
     * @param string $nom
     */
    function setNom($nom);

    /**
     * @return array array of MenuGroupInterface object
     */
    function getGroup_menus();

    /**
     * @param array $sub_menus an array of MenuGroupInterface object
     * @return MenuInterface for chaining
     * @throws MenuException
     */
    function setGroup_menus(array $sub_menus);
} 