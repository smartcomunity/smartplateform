<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: Oussama Limam
 * Date: 18/01/2017
 * Time: 11:03
 */

return array(

    'error/index'               => __DIR__ . '/error/index.phtml',
    'error/404'                 => __DIR__ . '/error/404.phtml',
    'layout/footer'             => __DIR__ . '/layout/footer.phtml',
    'layout/header'             => __DIR__ . '/layout/header.phtml',
    'layout/css'                => __DIR__ . '/ressources/css.phtml',
    'layout/js'                 => __DIR__ . '/ressources/js.phtml',
    'layout/scriptjs'           => __DIR__ . '/ressources/scriptjs.phtml',
    'layout/table'              => __DIR__ . '/ressources/table.phtml',


///Main nav bar
'layout/LeftNavbar'             => __DIR__ . '/layout/mainsidebar/Leftnavbarlinks.phtml',
'layout/MainNavbar'             => __DIR__ . '/layout/mainsidebar/Navbar.phtml',
'layout/RightNavbar'            => __DIR__ . '/layout/mainsidebar/Rightnavbarlinks.phtml',
'layout/SearcheForm'            => __DIR__ . '/layout/mainsidebar/Searcheform.phtml',
//elements
'layout/MessagesMenu'           => __DIR__ . '/layout/mainsidebar/elements/MessagesDropdownMenu.phtml',
'layout/NotificationsMenu'      => __DIR__ . '/layout/mainsidebar/elements/NotificationsDropdownMenu.phtml',
//elements-Menu
'layout/MessagesMenuLink'       => __DIR__ . '/layout/mainsidebar/elements/menu/Message.phtml',
'layout/NotificationMenuLink'  => __DIR__ . '/layout/mainsidebar/elements/menu/Notification.phtml',
//LeftNav bar Menu
'layout/LeftNavLink'  => __DIR__ . '/layout/mainsidebar/menu/LeftNavLink.phtml',
///End Main nav bar
   
//// SideBar
 
'layout/ControlSidebar'=> __DIR__ . '/layout/sidebar/ControlSidebar.phtml',
'layout/MainSidebar'=> __DIR__ . '/layout/sidebar/MainSidebar.phtml',

//Main SideBar
'layout/BrandLogo'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/BrandLogo.phtml',
'layout/SidebarMenu'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/SidebarMenu.phtml',
'layout/SidebarUserPanel'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/Sidebaruserpanel.phtml',



'layout/DashBordTree'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/menu/dashbordtree.phtml',
'layout/DashBordLink'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/menu/link/dashbordLink.phtml',

'layout/ItemTree'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/menu/itemtree.phtml',
'layout/SimpleLink'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/menu/link/simpleLink.phtml',
'layout/LiHeader'=> __DIR__ . '/layout/sidebar/MainSidebarContainer/elements/menu/liHeader.phtml',

 

///End Main SideBar

///Content
 
'layout/MainContent'=> __DIR__ . '/layout/corps/content/MainContent.phtml',
'layout/HeaderContent'=> __DIR__ . '/layout/corps/content/contentheader.phtml',
'layout/Content'=> __DIR__ . '/layout/corps/content.phtml',

 //End Content
 'layout/Footer'=> __DIR__ . '/layout/corps/footer.phtml',




    'Mail/invitecoordinateur'               => __DIR__ .  "/layout/mailstemplate/invitecoordinateur.phtml",
    'Mail/invite'               => __DIR__ .  "/layout/mailstemplate/invite.phtml",


);