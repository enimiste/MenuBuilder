<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 22:23
 */

namespace Nouni\Menu\Api\Menu;

use Nouni\Menu\Api\Filter\MenuFilterInterface;

/**
 * class FilteredMenuDecorator
 * @package Nouni\Menu\Api
 * @author NOUNI EL BACHIR
 */
class FilteredMenuDecorator implements MenuInterface
{
    /**
     * @var MenuInterface
     */
    private $menu;
    /**
     * @var MenuFilterInterface
     */
    private $filter;

    function __construct(MenuInterface $menu, MenuFilterInterface $filter)
    {
        $this->filter = $filter;
        $this->menu = $filter->do_filter($menu);
    }

    /**
     * @return MenuInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param MenuInterface $menu
     */
    public function setMenu(MenuInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return MenuFilterInterface
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param MenuFilterInterface $filter
     */
    public function setFilter(MenuFilterInterface $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return array
     */
    function to_array()
    {
        return $this->menu->to_array();
    }

    /**
     * @param MenuGroupInterface $groupe
     * @return MenuInterface for chaining
     * @throws MenuException
     */
    function add_menu_group(MenuGroupInterface $groupe)
    {
        $this->menu->add_menu_group($groupe);
        return $this;
    }

    /**
     * @return string
     */
    function getNom()
    {
        return $this->menu->getNom();
    }

    /**
     * @param string $nom
     */
    function setNom($nom)
    {
        $this->menu->setNom($nom);
    }

    /**
     * @return array array of MenuGroupInterface object
     */
    function getGroup_menus()
    {
        return $this->menu->getGroup_menus();
    }

    /**
     * @param array $sub_menus an array of MenuGroupInterface object
     * @return MenuInterface for chaining
     * @throws MenuException
     */
    function setGroup_menus(array $sub_menus)
    {
        $this->menu->setGroup_menus($sub_menus);
        return $this;
    }

    /**
     * Get all menu items count in deep
     * @return int
     */
    function getMenuItemsCount()
    {
        return $this->menu->getMenuItemsCount();
    }
} 