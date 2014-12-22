#Php Menu Builder :
- A composer module that lets you build menus easily. Its support permissions, database loading
- To use the module you should run the command :
 ```php
composer.phar install 
 ``` 
- You can implement your MenuLoader and Filter

#Examples :
## Without using a loader and no filter
 ```php
 require_once '../vendor/autoload.php';
 use \Nouni\Menu\Impl\Menu\Menu;
 use \Nouni\Menu\Impl\Menu\MenuGroup;
 use \Nouni\Menu\Impl\Menu\MenuItem;
 
 //Menu principale
 $m = new Menu();
 $m->setNom('Menu principale');
 
 //Groupe Menu 1
 $g1 = new MenuGroup("Administration", "Menu.Group.Admin");
 
 $gu = new MenuGroup('Gestion des utilisateurs', 'Menu.Group.UsersManagement');
 $item1 = new MenuItem("Liste des utilisateurs", '/users', 'Menu.UsersManagement.All');
 $item2 = new MenuItem("Ajouter un nouvel utilisateur", '/users/add', 'Menu.UsersManagement.Add');
 $gu->add_menu_item($item1)->add_menu_item($item2);
 $g1->addSub_menu($gu);
 
 //Ajouter le groupe au menu principale
 $m->add_menu_group($g1);
 
 //afficher le menu au format tableau
 print_r($m->to_array());
 ```
 
 ## Using Menu loader
 ```php
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
 
         $gu = new MenuGroup('Gestion des utilisateurs', 'Menu.Group.UsersManagement');
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
 ## Using Menu Filter
 ```php
 require_once '../vendor/autoload.php';
 use \Nouni\Menu\Impl\Menu\Menu;
 use \Nouni\Menu\Impl\Menu\MenuGroup;
 use \Nouni\Menu\Impl\Menu\MenuItem;
 use \Nouni\Menu\Api\Menu\MenuInterface;
 use \Nouni\Menu\Api\Loader\MenuLoaderInterface;
 use \Nouni\Menu\Api\Exception\MenuException;
 use \Nouni\Menu\Impl\Filter\FilterBasedOnPermission;
 use \Nouni\Menu\Api\Menu\FilteredMenuDecorator;
 
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
         $gu = new MenuGroup('Gestion des utilisateurs', 'Menu.Group.UsersManagement');
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
 
 $filter = new FilterBasedOnPermission(array(
     'Menu.Group.Admin',
     'Menu.Group.UsersManagement',
     'Menu.UsersManagement.Add'
 ));
 $menu_filtered = new FilteredMenuDecorator($menu, $filter);
 //afficher le menu au format tableau
 print_r($menu->to_array());
 print_r($menu_filtered->to_array());
 ```
 The result after execution is :
 
 ```php
 Array
 (
     [nom] => Menu principale
     [groups] => Array
         (
             [0] => Array
                 (
                     [title] => Administration
                     [permission] => Menu.Group.Admin
                     [icon] => 
                     [sub_menus] => Array
                         (
                             [0] => Array
                                 (
                                     [title] => Gestion des utilisateurs
                                     [permission] => Menu.Group.UsersManagement
                                     [icon] => 
                                     [sub_menus] => Array
                                         (
                                         )
 
                                     [menu_items] => Array
                                         (
                                             [1] => Array
                                                 (
                                                     [title] => Ajouter un nouvel utilisateur
                                                     [url] => /users/add
                                                     [permission] => Menu.UsersManagement.Add
                                                 )
 
                                         )
 
                                 )
 
                         )
 
                     [menu_items] => Array
                         (
                         )
 
                 )
 
         )
 
 )
 ``` 
 ## Menu Loader that use a database
 ```php
 require_once '../vendor/autoload.php';
 use \Nouni\Menu\Impl\Loader\DBMenuLoader;
 
 /*
  * given a logged in user whose ID is 12
  */
 $menu_loader = new DBMenuLoader(12, 'DBNAME', 'USERNAME', 'PASSWORD');
 $menu = $menu_loader->load();
 //afficher le menu au format tableau
 print_r($menu->to_array());
 ```
 
 ## Diagramme UML
 
 [Click here to view the UML diagram](https://raw.githubusercontent.com/enimiste/MenuBuilder/dev/diagram.png "This diagram is generated using PHPStorm IDE")
