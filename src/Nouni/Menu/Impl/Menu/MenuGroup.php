<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 21/12/14
 * Time: 01:12
 */

namespace Nouni\Menu\Impl\Menu;


use Nouni\Menu\Api\Exception\MenuException;
use Nouni\Menu\Api\Menu\MenuGroupInterface;
use Nouni\Menu\Api\Menu\MenuItemInterface;
use Nouni\Menu\Api\Menu\SubMenuInterface;

class MenuGroup implements MenuGroupInterface
{

    /**
     * @var string
     */
    protected $titre;
    /**
     * @var string
     */
    protected $permission;
    /**
     * @var \SplObjectStorage
     */
    protected $sub_menus;
    /**
     * @var \SplObjectStorage
     */
    protected $menu_items; //Has url
    /**
     * @var string
     */
    protected $icon;
    /**
     * @var bool
     */
    protected $visibility;

    /**
     * @param string $titre
     * @param string $permission
     * @param string $icon
     * @param bool $visibility
     */
    function __construct($titre = '', $permission = '', $icon = '', $visibility = true)
    {
        $this->icon = $icon;
        $this->titre = $titre;
        $this->permission = $permission;
        $this->sub_menus = new \SplObjectStorage();
        $this->menu_items = new \SplObjectStorage();
        $this->visibility = $visibility;
    }


    /**
     * icon name
     * @return string
     */
    function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    function get_permission()
    {
        return $this->permission;
    }

    /**
     * @return string
     */
    function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return array array of SubMenuInterface Object
     */
    function getSub_menus()
    {
        return iterator_to_array($this->sub_menus);
    }

    /**
     * @param array $sub_menus array of SubMenuInterface object
     * @return SubMenuInterface for chaining
     */
    function setSub_menus(array $sub_menus)
    {
        $this->sub_menus = new \SplObjectStorage($sub_menus);
        return $this;
    }

    /**
     * @param SubMenuInterface $submenu
     * @throws MenuException
     * @return SubMenuInterface for chaining
     */
    function addSub_menu(SubMenuInterface $submenu)
    {
        if ($this->sub_menus->contains($submenu))
            throw new MenuException('Le sous menu existe déjà');
        $this->sub_menus->attach($submenu);
        return $this;
    }

    /**
     * @param MenuItemInterface $item
     * @throws MenuException
     * @return SubMenuInterface for chaining
     */
    function add_menu_item(MenuItemInterface $item)
    {
        if ($this->menu_items->contains($item))
            throw new MenuException('Le menu item existe déjà');
        $this->menu_items->attach($item);
        return $this;
    }

    /**
     * @return bool
     */
    function is_visible()
    {
        return $this->visibility;
    }

    /**
     * @param bool $value
     */
    function set_visibility($value)
    {
        $this->visibility = $value;
    }

    /**
     * @return array
     */
    function to_array()
    {
        if(!$this->is_visible()) return array();

        $sub_menus = array_map(function (SubMenuInterface $item) {
            return $item->to_array();
        }, array_filter($this->getSub_menus(), function (SubMenuInterface $item) {
            return $item->is_visible();
        }));

        $menu_items = array_map(function (MenuItemInterface $item) {
            return $item->to_array();
        }, array_filter($this->getMenu_items(), function (MenuItemInterface $item) {
            return $item->is_visible();
        }));
        return array(
            'title' => $this->titre,
            'permission' => $this->permission,
            'icon' => $this->icon,
            'sub_menus' => $sub_menus,
            'menu_items' => $menu_items
        );
    }

    /**
     * @return array ana array of MenuItemInterface object
     */
    function getMenu_items()
    {
        return iterator_to_array($this->menu_items);
    }

    /**
     * Get all menu group items count in deep
     * @return int
     */
    function getMenuItemsCount()
    {
        $f = array_filter($this->getMenu_items(), function (MenuItemInterface $item) {
            return $item->is_visible();
        });

        return count($f) + array_reduce($this->getSub_menus(), function ($acc, SubMenuInterface $sub_menu) {
            return $sub_menu->is_visible() ? $acc + $sub_menu->getMenuItemsCount() : $acc;
        }, 0);
    }
}