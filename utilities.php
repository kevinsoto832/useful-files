<?php
/*
Plugin Name: Rozana Utilities
Plugin URI:
Description: Various useful utilities
Version: 0.1.3
Author: Kevin Soto
Author URI:
License:
*/

/* TOC
    =FILTERS
    - function filter_attributes_wp__nav_menu($var)
    - function filter_ptags_on_images($content)
    - filter_ver_numbers_in_head( $src )
    - function lrm_body_classes( $classes )
    - function lrm_custom_classes( $classes )

    =FUNCTIONS
    - get_the_slug( $id=null )
    - the_slug( $id=null )
    - function rational_head_clean()
*/


//This function will ADD the 'menuType' Query Vars to the existing list of Query Vars that Wordpress already has
function rozana_add_query_vars($arrVars)
{
    $arrVars[] = 'menuType';
    return $arrVars;
}
add_filter('query_vars', 'rozana_add_query_vars');

//CANT FIGURE THIS OUT YET. TURN PERMALINK PRETTY
//3 21 22 FIGURED IT OUT 
//Dependent on page.php using get_the_slug in conjunction with $myPageTemplatePart variable.
function myplugin_rewrite_tag_rule()
{

    add_rewrite_tag('%menuType%', '([^&]+)');
    //where it says ^menu, that is the page name and where it says ([^/]*) that's where the cooresponding query url goes
    add_rewrite_rule('^menu/([^/]*)/?', 'index.php?pagename=menu&menuType=$matches[1]', 'top');
}
add_action('init', 'myplugin_rewrite_tag_rule', 10, 0);


function get_the_slug($id = null)
{

    if (empty($id)) {

        global $post;
        if (empty($post)) : // No global $post var available.
            return '';
        endif;
        $id = $post->ID;
    }

    $slug = basename(get_permalink($id));
    return $slug;
}

//This removes all the HTML tags from the_content(); except 
//REALLY USEFUL.
function my_wp_content_function($content)
{
    return strip_tags($content, "<video>"); //add any tags here you want to preserve
}
add_filter('the_content', 'my_wp_content_function');

/**
 * Display the page or post slug
 *
 * Uses get_the_slug() and applies 'the_slug' filter.
 */
function the_slug($id = null)
{

    echo apply_filters('the_slug', get_the_slug($id));
}

//add_filter('nav_menu_css_class', 'filter_attributes_wp__nav_menu', 100, 1);l
add_filter('nav_menu_item_id', 'filter_attributes_wp__nav_menu', 100, 1);
add_filter('page_css_class', 'filter_attributes_wp__nav_menu', 100, 1);
// Removes most classes and ids from the menu generated by wp_nav_menu.
function filter_attributes_wp__nav_menu($var)
{
    return is_array($var) ? array_intersect($var, array('current-menu-item', 'current-menu-parent', 'menu-item-has-children')) : '';
}


add_filter('acf_the_content', 'filter_ptags_on_images');
add_filter('the_content', 'filter_ptags_on_images');
// Removes p tags from around images (WP sometimes adds them).
function filter_ptags_on_images($content)
{
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}

add_filter('script_loader_src', 'filter_ver_numbers_in_head', 15, 1);
add_filter('style_loader_src', 'filter_ver_numbers_in_head', 15, 1);
function filter_ver_numbers_in_head($src)
{
    $parts = explode('?ver', $src);
    return $parts[0];
}

add_filter('body_class', 'lrm_body_classes', 10, 2);
function lrm_body_classes($wp_classes, $extra_classes)
{

    // List of the only WP generated classes allowed
    $whitelist = array('home', 'blog', 'error404', 'page', 'logged-in', 'admin-bar');

    // Filter the body classes
    $wp_classes = array_intersect($wp_classes, $whitelist);

    // Add the extra classes back untouched
    return array_merge($wp_classes, (array) $extra_classes);
}

add_filter('body_class', 'lrm_custom_body_classes', 10, 2);
function lrm_custom_body_classes($classes)
{
    if (is_front_page() || is_home()) {
        $classes[] = 'lrm-home';
    } else {
        $classes[] = 'lrm-' . get_the_slug();
    }

    return $classes;
}

add_filter('post_class', 'lrm_post_classes', 10, 3);
function lrm_post_classes($classes, $class, $post_id)
{

    $classes = array_diff($classes, array(
        'hentry',
        'post-' . $post_id,
        'type-' . get_post_type($post_id),
        'status-' . get_post_status($post_id),
    ));

    return $classes;
}


// end of tcbarrentt.com get_the_slug the_slug

/**
 * Removes actions and filters to clean up the head
 */
add_action('init', 'rational_head_clean');
function rational_head_clean()
{
    // https://scotch.io/tutorials/removing-wordpress-header-junk
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    // http://wordpress.stackexchange.com/a/185578/26817
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('emoji_svg_url', '__return_false');

    // http://wordpress.stackexchange.com/a/211469/26817
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}


/***** =SHORTCODES (use sparingly) *****/

// Allows adding a comment in the post editor which will not be output to the page.
// Usage [comment]Your comment here.[/comment]
// Note: comment can be multiple lines.
add_shortcode('comment', 'lrm_comment');
function lrm_comment($atts, $content = null)
{
    return '';
}