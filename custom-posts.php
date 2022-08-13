<?php
/* 
Plugin Name: Rozana Custom Post Types
Plugin URI:
Description: Registers custom post types for the Rozana website
Version: 1.0.0
Author: Kevin Soto
Author URI:
License:
*/

//Registers global, updatable links 
function rozana_register_links()

{
    $labels = array(
        'name' => 'Links to External',
        'add_new' => 'Add New Link',
        'add_new_item' => 'Add Link',
        'edit_item' => 'Edit Link',
        'new_item' => 'New Link',
        'all_items' => "All Links",
        'view_item' => 'View Link'
    );


    register_post_type('links', array(
        'labels' => $labels,
        'public' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    ));
}
add_action('init', 'rozana_register_links');

//Rozana Home Posts
function rozana_register_home_posts()

{
    $labels = array(
        'name' => 'Home Posts',
        'add_new' => 'Add New Post',
        'add_new_item' => 'Add Post',
        'edit_item' => 'Edit Post',
        'new_item' => 'New Post',
        'all_items' => "All Post",
        'view_item' => 'View Post'
    );


    register_post_type('home_posts', array(
        'labels' => $labels,
        'public' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'show_in_rest' => true
    ));
}
add_action('init', 'rozana_register_home_posts');

//home slider cards
function rozana_register_home_slider_cards()

{
    $labels = array(
        'name' => 'Home Slider Cards',
        'add_new' => 'Add New Card',
        'add_new_item' => 'Add Card',
        'edit_item' => 'Edit Card',
        'new_item' => 'New Card',
        'all_items' => "All Cards",
        'view_item' => 'View Card'
    );


    register_post_type('home_slider_cards', array(
        'labels' => $labels,
        'public' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'show_in_rest' => true
    ));
}
add_action('init', 'rozana_register_home_slider_cards');

//Registers the main menu post type
function rozana_register_main_menu_post_type()

{
    $labels = array(
        'name' => 'Main Menu',
        'add_new' => 'Add New Food Item',
        'add_new_item' => 'Add Food Item',
        'edit_item' => 'Edit Food item',
        'new_item' => 'New Menu Item',
        'all_items' => "All Menu Items",
        'view_item' => 'View Menu Item'
    );


    register_post_type('main', array(
        'labels' => $labels,
        'public' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    ));
}
add_action('init', 'rozana_register_main_menu_post_type');


//Registers the brunch menu post type
function rozana_register_brunch_menu_post_type()

{
    $labels = array(
        'name' => 'Brunch Menu',
        'add_new' => 'Add Brunch Items',
        'add_new_item' => 'Add Brunch Item',
        'edit_item' => 'Edit Brunch Item',
        'new_item' => 'New Brunch Item',
        'all_items' => "All Brunch Items",
        'view_item' => 'View Brunch Items'
    );


    register_post_type('brunch', array(
        'labels' => $labels,
        'public' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    ));
}

add_action('init', 'rozana_register_brunch_menu_post_type');

//Registers the coffee menu post type
function rozana_register_coffee_menu_post_type()

{
    $labels = array(
        'name' => 'Coffee Menu',
        'add_new' => 'Add Coffee Item',
        'add_new_item' => 'Add Coffee Item',
        'edit_item' => 'Coffee Item',
        'new_item' => 'New Coffee Item',
        'all_items' => "All Coffee Items",
        'view_item' => 'View Coffee Item'
    );


    register_post_type('coffee', array(
        'labels' => $labels,
        'public' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    ));
}

add_action('init', 'rozana_register_coffee_menu_post_type');
