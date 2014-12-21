#Php Menu Builder :
- A composer module that lets you build menus easily. Its support permissions, database loading
- You can implement your MenuLoader and Filter

#Example :
## Without using a loader and no filter
 ```
 require_once '../vendor/autoload.php';
 use \Nouni\Menu\Impl\Menu\Menu;
 use \Nouni\Menu\Impl\Menu\MenuGroup;
 use \Nouni\Menu\Impl\Menu\MenuItem;
 
 //Menu principale
 $m = new Menu();
 $m->setNom('Menu principale');
 
 //Groupe Menu 1
 $g1 = new MenuGroup("Administration", "Menu.Group.Admin");
 
 $gu = new MenuGroup('Gestion des utilisateurs', 'Menu.UsersManagement.Show');
 $item1 = new MenuItem("Liste des utilisateurs", '/users', 'Menu.UsersManagement.All');
 $item2 = new MenuItem("Ajouter un nouvel utilisateur", '/users/add', 'Menu.UsersManagement.Add');
 $gu->add_menu_item($item1)->add_menu_item($item2);
 $g1->addSub_menu($gu);
 
 //Ajouter le groupe au menu principale
 $m->add_menu_group($g1);
 
 //afficher le menu au format tableau
 print_r($m->to_array());
 ```
 
 ##Using Menu loader
 ```
 require_once '../vendor/autoload.php';
 
 use \Nouni\Menu\Impl\Menu\Menu;
 use \Nouni\Menu\Impl\Menu\MenuGroup;
 use \Nouni\Menu\Impl\Menu\MenuItem;
 use \Nouni\Menu\Api\Menu\MenuInterface;
 use \Nouni\Menu\Api\Loader\MenuLoaderInterface;
 use \Nouni\Menu\Api\Exception\MenuException;
 
 class StaticMenuLoader implements MenuLoaderInterface
 {
 
     /**
      * @return MenuInterface
      * @throws MenuException
      */
     function load()
     {
         $m = new Menu();//Menu principale
         $m->setNom('Menu principale');
 
         $g1 = new MenuGroup("Administration", "Menu.Group.Admin");//Groupe Menu 1
 
         $gu = new MenuGroup('Gestion des utilisateurs', 'Menu.UsersManagement.Show');
         $item1 = new MenuItem("Liste des utilisateurs", '/users', 'Menu.UsersManagement.All');
         $item2 = new MenuItem("Ajouter un nouvel utilisateur", '/users/add', 'Menu.UsersManagement.Add');
         $gu->add_menu_item($item1)->add_menu_item($item2);
         $g1->addSub_menu($gu);
 
         $m->add_menu_group($g1);//Ajouter le groupe au menu principale
         return $m;
     }
 }
 
 $menu_loader = new StaticMenuLoader();
 $menu = $menu_loader->load();
 //afficher le menu au format tableau
 print_r($menu->to_array());
 ``` 
 ##Using Menu Filter
- To be continued ....