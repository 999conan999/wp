<?php







/**
 * Add a page to the dashboard menu.
 */

 add_filter( 'xmlrpc_enabled', '__return_false' );
if(is_user_logged_in()){
    global $wp_roles; 
    $wp_roles->add_cap( 'administrator', 'view_custom_menu' ); 
    $wp_roles->add_cap( 'subscriber', 'view_custom_menu' );
    function admin_show_theme_meme() {
        add_menu_page( 'Main ', 'Main<style>.wp-menu-image>img{width: 26px; opacity: 1 !important; position: absolute; left: 10px; top: -7px;}</style>', 'view_custom_menu', 'giao-dien', 'theme_meme_init',get_home_url().'/wp-content/themes/theme_meme/build/gg.png',1 );

    }

    add_action('admin_menu', 'admin_show_theme_meme');
    function theme_meme_init() {
        require_once(get_stylesheet_directory().'/build/index.php');
    }
}

    /**
     * @ khai bao hang gia tri
     * @ THEME_URL =lay duong dan thu muc theme
     * @ CORE = lay duong dan cua thu muc /core
     */
     /** */
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
        }
        add_filter('upload_mimes', 'cc_mime_types');
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL."/templates/fs.php");
    /**
     * @ Nhung file /core/init.php
     */
require_once(CORE);

if(!function_exists('danhdev_setup')){
    function danhdev_setup() {
            add_theme_support( 'post-thumbnails' );
            // Theme menu
            register_nav_menu('danhdev-menu', 'Danhdev Menu');
    }
    add_action('init', 'danhdev_setup');
}














?>