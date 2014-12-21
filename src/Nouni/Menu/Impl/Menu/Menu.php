<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 20/12/14
 * Time: 23:17
 */

namespace Nouni\Menu\Impl\Menu;


use Nouni\Menu\Api\Exception\MenuException;
use Nouni\Menu\Api\Menu\MenuGroupInterface;
use Nouni\Menu\Api\Menu\MenuInterface;

class Menu implements MenuInterface
{
    /**
     * @var string
     */
    protected $nom;
    /**
     * @var \SplObjectStorage of MenuGroupInterface
     */
    protected $groupe_menus;

    function __construct($nom = '')
    {
        $this->groupe_menus = new \SplObjectStorage();
    }


    /**
     * @param MenuGroupInterface $groupe
     * @return MenuInterface for chaining
     */
    function add_menu_group(MenuGroupInterface $groupe)
    {
        $this->groupe_menus->attach($groupe);
    }

    /**
     * @return string
     */
    function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return array array of MenuGroupInterface object
     */
    function getGroup_menus()
    {
        return iterator_to_array($this->groupe_menus);
    }

    /**
     * @param array $sub_menus an array of MenuGroupInterface object
     * @return MenuInterface for chaining
     * @throws MenuException
     */
    function setGroup_menus(array $sub_menus)
    {
        array_walk($sub_menus, function ($item) {
            if (!($item instanceof MenuGroupInterface))
                throw new MenuException("Les sous menu du Menu doivent être des instances de l'interface MenuGroupInterface");
        });
        $this->groupe_menus = new \SplObjectStorage($sub_menus);
    }

    /**
     * @return array
     */
    function to_array()
    {
        $filtred = array_filter($this->getGroup_menus(), function (MenuGroupInterface $item) {
            return $item->is_visible();
        });
        return array_map(function (MenuGroupInterface $item) {
            return $item->to_array();
        }, $filtred);
    }
}