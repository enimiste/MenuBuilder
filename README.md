#Php Menu Builder :
- A composer module that lets you build menus easily. Its support permissions, database loading
- You can implement your MenuLoader and Filter

#Example :
## Without using a loader and no filter
 ```require_once '../vendor/autoload.php';
 //Menu principale
 $m = new \Nouni\Menu\Impl\Menu\Menu();
 $m->setNom('Menu principale');
 
 //Groupe Menu 1
 $g1 = new \Nouni\Menu\Impl\Menu\MenuGroup("Administration", "Menu.Group.Admin");
 
 $gu = new \Nouni\Menu\Impl\Menu\MenuGroup('Gestion des utilisateurs', 'Menu.UsersManagement.Show');
 $item1 = new \Nouni\Menu\Impl\Menu\MenuItem("Liste des utilisateurs", '/users', 'Menu.UsersManagement.All');
 $item2 = new \Nouni\Menu\Impl\Menu\MenuItem("Ajouter un nouvel utilisateur", '/users/add', 'Menu.UsersManagement.Add');
 $gu->add_menu_item($item1)->add_menu_item($item2);
 $g1->addSub_menu($gu);
 
 //Ajouter le groupe au menu principale
 $m->add_menu_group($g1);
 
 //afficher le menu au format tableau
 print_r($m->to_array());```
 
 ##Using Menu loader
 ##Using Menu Filter
- To be continued ....