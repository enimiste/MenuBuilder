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
 * Interface AbstractFilteredMenuDecorator
 * @package Nouni\Menu\Api
 * @author NOUNI EL BACHIR
 */
abstract class AbstractFilteredMenuDecorator implements MenuInterface
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
        $this->menu = $menu;
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
        $m = $this->filter->do_filter($this->menu);
        $this->setNom($m->getNom());
        $this->setGroup_menus($m->getGroup_menus());
        return $m->to_array();
    }
} 