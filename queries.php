<?php
/* 
Plugin Name: Rozana Queries
Plugin URI:
Description: Holds utility code for the Rozana site
Version: 1.0.0
Author: Kevin Soto
Author URI:
License:
*/

/*
** Query Calls
	
	r_Queries::getCPTPosts( 'locations' ) ;

	*/

class Query_Class
{
    public static function getPostType($postType)
    {
        $args = array(
            'post_type' => $postType,
            'order' => 'ASC',
            'orderby' => 'date',
            'posts_per_page' => 1000,    // <========= ASSUMING THERE WILL NEVER BE MORE THAN 1000.
            'no_found_rows' => true,    // Use if no pagination required.
        );

        $myPosts = new WP_Query($args);
        return $myPosts;
    }
    //for the blog section on the home page
    public static function getBlogPosts($postType)
    {
        $args = array(
            'post_type' => $postType,
            'order' => 'ASC',
            'orderby' => 'date',
            'posts_per_page' => 3,    // <========= ASSUMING THERE WILL NEVER BE MORE THAN 1000.
            'no_found_rows' => true,    // Use if no pagination required.
        );

        $myPosts = new WP_Query($args);
        return $myPosts;
    }

    public static function getPostTypeAndId($postType, $thisPostID)
    {
        $args = array(
            'post_type' => $postType,
            'p' => $thisPostID,
            'order' => 'ASC',
            'orderby' => 'date',
            'posts_per_page' => 1000,    // <========= ASSUMING THERE WILL NEVER BE MORE THAN 1000.
            'no_found_rows' => true,    // Use if no pagination required.
        );

        $myPosts = new WP_Query($args);
        return $myPosts;
    }

    public static function getPageContent($thisPageSlug)
    {
        $args = array(
            'pagename' => $thisPageSlug,
            'posts_per_page' => 100,        // Return all posts.
            'no_found_rows' => true,    // Use if no pagination required.
        );

        $myPosts = new WP_Query($args);
        return $myPosts;
    }


    public static function my_SampleQuery($thisThing)
    {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,        // Return all posts.
            'no_found_rows' => true,    // Use if no pagination required.
        );

        $myPosts = new WP_Query($args);
        return $myPosts;
    }


    public static function getPostById($thisPostID)
    {
        $args = array(
            'post_type' => 'post',
            'p' => $thisPostID,
            'posts_per_page' => -1,        // Return all posts.
            'no_found_rows' => true,    // Use if no pagination required.
        );

        $myPosts = new WP_Query($args);
        return $myPosts;
    }
    public static function getPostByTag($postTag)
    {
        $args = array(
            'tag' => $postTag,
            'order' => 'ASC',
            'orderby' => 'date',
            'posts_per_page' => 1000,    // <========= ASSUMING THERE WILL NEVER BE MORE THAN 1000.
            'no_found_rows' => true,    // Use if no pagination required.
        );

        $myPosts = new WP_Query($args);
        return $myPosts;
    }
} // end class mmi_Queries\
