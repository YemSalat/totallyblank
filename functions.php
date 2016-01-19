<?php

// :: CONSTANTS
define('TEMPLATE_URI', get_template_directory_uri());
define('TEMPLATE_PATH', get_template_directory());

// :: SETUP THEME
add_action( 'after_setup_theme', 'blank_setup' );
function blank_setup()
{
	load_theme_textdomain( 'blank', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'blank' ) )
		);
}

// :: SET ADMIN POST ORDER
function set_post_order_in_admin( $wp_query ) {
  if ( is_admin() ) {
    $wp_query->set( 'orderby', 'menu_order' );
    $wp_query->set( 'order', 'ASC' );
  }
}
add_filter('pre_get_posts', 'set_post_order_in_admin' );


// :: REMOVE DEFAULT TUMBNAILS
function tb_filter_image_sizes( $sizes) {

	unset( $sizes['medium'] );
	unset( $sizes['large'] );

	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'tb_filter_image_sizes');

// :: OPTIONAL :: ADDITIONAL THUMBNAILS
// add_image_size( 'custom-thumb', 580, 420 ); // custom thumnail

// :: WYSIWYG EDITOR STYLES
add_editor_style( 'css/layout.css' );


// REMOVE JUNK
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version

remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

// REMOVE EMOJI
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// REMOVE WORDPRESS JQUERY
function tb_dequeue_script() {
	wp_dequeue_script( 'jquery' );
}
add_action('wp_print_scripts', 'tb_dequeue_script', 100);

// DISABLE EDITOR
define( 'DISALLOW_FILE_EDIT', true );

// DISABLE COMMENTS ALLTOGETHER
// Disable support for comments and trackbacks in post types
function tb_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'tb_disable_comments_post_types_support');
// Close comments on the front-end
function tb_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'tb_disable_comments_status', 20, 2);
add_filter('pings_open', 'tb_disable_comments_status', 20, 2);
// Hide existing comments
function tb_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'tb_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function tb_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'tb_disable_comments_admin_menu');
// Redirect any user trying to access comments page
function tb_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(home_url()); exit;
	}
}
add_action('admin_init', 'tb_disable_comments_admin_menu_redirect');
// Remove comments metabox from dashboard
function tb_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'tb_disable_comments_dashboard');
// Remove comments links from admin bar
function tb_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('admin_menu', 'tb_disable_comments_admin_bar');

// :: OPTIONAL :: REMOVE POSTS
// function tb_menu_page_removing_posts() {
//     remove_menu_page( 'edit.php' );
// }
// add_action( 'admin_menu', 'tb_menu_page_removing_posts' );
// :: OPTIONAL :: REMOVE TOOLS
// function tb_menu_page_removing_tools() {
//     remove_menu_page( 'tools.php' );
// }
// add_action( 'admin_menu', 'tb_menu_page_removing_tools' );
