<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 21/12/14
 * Time: 01:38
 */

namespace Nouni\Menu\Impl\Menu;

use Nouni\Menu\Api\Menu\MenuItemInterface;

/**
 * Class MenuItem
 * @package Nouni\Menu\Impl\Menu
 * @author NOUNI EL BACHIR
 */
class MenuItem implements MenuItemInterface
{
    /**
     * @var string
     */
    protected $titre;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var string
     */
    protected $permission;
    /**
     * @var bool
     */
    protected $visibility;

    function __construct($titre = '', $url = '', $permission = '', $visibility = true)
    {
        $this->permission = $permission;
        $this->titre = $titre;
        $this->url = $url;
        $this->visibility = $visibility;
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
     * @return string
     */
    function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    function get_permission()
    {
        return $this->permission;
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
        if (!$this->is_visible())
            return array();
        return array(
            'title' => $this->titre,
            'url' => $this->url,
            'permission' => $this->permission,
        );
    }
}