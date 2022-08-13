<?php
//Custom Taxonomy for Food menu
function menu_post_type_taxonomy()
{

    $labels = array(
        'name' => _x('Category', 'taxonomy general name'),
        'singular_name' => _x('Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Categories'),
        'all_items' => __('All Categories'),
        'parent_item' => __('Parent Menu'),
        'parent_item_colon' => __('Parent Menu:'),
        'edit_item' => __('Edit Category'),
        'update_item' => __('Update Category'),
        'add_new_item' => __('Add New Category'),
        'new_item_name' => __('New Category Name'),
        'menu_name' => __('Categories'),
    );

    register_taxonomy('food-category', array('main', 'brunch', 'coffee'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'menu'),
    ));
}
add_action('init', 'menu_post_type_taxonomy', 0);

//Taxonomy for Page Parts
function page_parts_taxonomy()
{

    $labels = array(
        'name' => _x('Category', 'taxonomy general name'),
        'singular_name' => _x('Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Categories'),
        'all_items' => __('All Categories'),
        'parent_item' => __('Parent Menu'),
        'parent_item_colon' => __('Parent Menu:'),
        'edit_item' => __('Edit Category'),
        'update_item' => __('Update Category'),
        'add_new_item' => __('Add New Category'),
        'new_item_name' => __('New Category Name'),
        'menu_name' => __('Categories'),
    );

    register_taxonomy('page-parts-taxonomy', array('page_parts'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        //'rewrite' => array('slug' => 'menu'),
    ));
}
add_action('init', 'page_parts_taxonomy', 0);

//enabling categories and tags to the 'food_menu' custom post type
/* function add_category_tags_to_cpt()
{
	register_taxonomy_for_object_type('category', 'food_menu');
	register_taxonomy_for_object_type('post_tag', 'food_menu');
}
add_action('init', 'add_category_tags_to_cpt'); */
