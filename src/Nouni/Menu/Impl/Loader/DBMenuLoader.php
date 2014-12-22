<?php
namespace Nouni\Menu\Impl\Loader;

use \Nouni\Menu\Impl\Menu\Menu;
use \Nouni\Menu\Api\Menu\MenuInterface;
use \Nouni\Menu\Api\Loader\MenuLoaderInterface;
use \Nouni\Menu\Api\Exception\MenuException;
use \Nouni\Menu\Impl\Menu\FilteredMenuDecorator;
use \Nouni\Menu\Impl\Menu\MenuGroup;
use \Nouni\Menu\Impl\Menu\MenuItem;

class DBMenuLoader implements MenuLoaderInterface
{

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $dbname;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    protected $sql_query = 'Select menu.id as menu_id, menu.nom as menu_nom, menu.actived as menu_actived, submenu.id as submenu_id, submenu.titre as submenu_titre, submenu.permission as submenu_permission, submenu.icon as submenu_icon, item.id as item_id, item.titre as item_titre, item.permission as item_permission, item.url as item_url
from m_menu_items as item
inner join m_submenus as submenu on submenu.id=item.id_submenu
inner join m_menus as menu on menu.id=submenu.id_menu_parent
where menu.id=:id_menu and menu.actived=1';

    function __construct($userId, $id_menu = 1, $dbname = '', $username = '', $password = '')
    {
        $this->userId = $userId;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->id_menu = $id_menu;
    }

    /**
     * @return MenuInterface
     * @throws MenuException
     */
    function load()
    {
        $m = new Menu();//Menu principale
        $this->get_menu($m);
        return $m;
    }

    private function get_menu(MenuInterface $m)
    {
        $db = new \PDO('mysql:host=localhost;dbname=' . $this->dbname, $this->username, $this->password);

        try {
            //Menu
            $stmt = $db->prepare('select * from m_menus where id=:id_menu');
            $stmt->bindParam(':id_menu', $this->id_menu, \PDO::PARAM_INT);
            $stmt->execute();

            $menu = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($menu as $key => $value) {
                $m->setNom($value['nom']);
                break;
            }

            //Les sous menus
            $stmt = $db->prepare($this->sql_query);
            $stmt->bindParam(':id_menu', $this->id_menu, \PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $groups = array();
            foreach ($result as $key => $value) {
                if (!array_key_exists($value['submenu_id'], $groups)) {
                    $g = new MenuGroup($value['submenu_titre'], $value['submenu_permission'], $value['submenu_icon']);
                    $groups[$value['submenu_id']] = $g;
                    $m->add_menu_group($g);
                }
                $g = $groups[$value['submenu_id']];
                $item = new MenuItem($value['item_titre'], $value['item_url'], $value['item_permission']);
                $g->add_menu_item($item);
            }
        } catch (\Exception $ex) {
            throw new MenuException('Error : ' . $ex->getMessage());
        }
        return $m;
    }
}