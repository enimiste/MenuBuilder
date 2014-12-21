<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 21/12/14
 * Time: 02:19
 */

namespace Nouni\Menu\Impl\Filter;


use Nouni\Menu\Api\Exception\MenuException;
use Nouni\Menu\Api\Filter\MenuFilterInterface;
use Nouni\Menu\Api\Menu\MenuGroupInterface;
use Nouni\Menu\Api\Menu\MenuInterface;
use Nouni\Menu\Api\Menu\MenuItemInterface;
use Nouni\Menu\Api\Menu\SubMenuInterface;

class FilterBasedOnPermission implements MenuFilterInterface
{

    /**
     * @var array of strings
     */
    protected $permissions;

    function __construct(array $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @param string $permission
     */
    function addPermission($permission = '')
    {
        $this->permissions[] = $permission;
    }

    /**
     * @return array ana array of string
     */
    function getPermissions()
    {
        return $this->permissions;
    }

    /**
     *
     * @param MenuInterface $menu
     * @throws MenuException
     * @return MenuInterface filtered
     */
    function do_filter(MenuInterface $menu)
    {
        if (empty($this->permissions))
            throw new MenuException('Permissions liste is empty');
        //Foreach group menu
        $permissions = $this->permissions;
        $obj = $this;
        array_walk($menu->getGroup_menus(), function (MenuGroupInterface $group) use ($permissions, $obj) {
            $obj->_sub_menu_visibility($group, $permissions);
        });
        return $menu;
    }

    protected function _sub_menu_visibility(SubMenuInterface $sub_menu, array $permissions)
    {
        if (!in_array($sub_menu->get_permission(), $permissions)) {
            //Hide all sub menu
            $sub_menu->set_visibility(false);
        } else {
            $sub_menu->set_visibility(true);
            array_walk($sub_menu->getMenu_items(), function (MenuItemInterface $item) use ($permissions) {
                $item->set_visibility(in_array($item->get_permission(), $permissions));
            });
            $obj = $this;
            array_walk($sub_menu->getSub_menus(), function (SubMenuInterface $sub_menu) use ($permissions, $obj) {
                $obj->_sub_menu_visibility($sub_menu, $permissions);
            });
        }
    }
}