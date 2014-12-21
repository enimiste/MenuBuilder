<?php
/**
 * Created by PhpStorm.
 * User: nounielbachir
 * Date: 21/12/14
 * Time: 02:37
 */

namespace Nouni\Menu\Impl\Menu;

use Nouni\Menu\Api\Filter\MenuFilterInterface;
use Nouni\Menu\Api\Menu\AbstractFilteredMenuDecorator;
use Nouni\Menu\Api\Menu\MenuInterface;

class FilteredMenuDecorator extends AbstractFilteredMenuDecorator
{
    function __construct(MenuInterface $menu, MenuFilterInterface $filter)
    {
        parent::__construct($menu, $filter);
    }
}