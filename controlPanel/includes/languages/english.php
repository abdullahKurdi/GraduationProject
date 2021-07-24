<?php
    function lang($en){
        static $lang = array(
            //homepage
            'Home' => 'Dashboard',
            'Categories' => 'Categories',
            'Members' => 'Members',
            'Items' => 'Items',
            'Notifications' => 'Notifications',
            'Visit Shop' => 'Visit Auction',
            'Edit' => 'Edit Profile',
            'Logout' => 'Logout',
            'edit profile' => 'Edit Member',
            'update' => 'Update Member',
            'add' => 'Add New Member',
            'insert' => 'Insert New Member',
            'manage' => 'Manage Members',
            'delete'=>'Delete Member',
            'Approval Members'=>'Approval Members',
            'addcat' => 'Add New Category',
            'insertcat' => 'Insert Category',
            'manageCategories'=>'Manage Categories',
            'editcat'=>'Edit Category',
            'updatecat'=>'Update Category',
            'deletecat'=>'Delete Category',
            'additem'=>'Add New Item',
            'insertit'=>'Insert Item',
            'items page'=>'Manage Items',
            'editItem'=>'Edit Item',
            'updateitem'=>'Update Item',
            'deleteitem'=>'Delete Item',
            'activeitem'=>'Active Item',
            'managenot'=>'Manage Notifications',
            'editcom'=>'Edit Comment',
            'updatecom'=>'Update Comment',
            'deleteCOM'=>'Delete Comment',
            'Approval Comment'=>'Approval Comment',
            'Orders'=>'Orders',

        );
        return $lang[$en];
    }
?>