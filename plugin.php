<?php
/*
Plugin Name: Wordpress Post Type Excerpts
Description: Adds an option page in the WP admin that allows setting excerpts for any post type
Version: 1.0.0
Author: Arthvadrr
License: GNU AFFERO GENERAL PUBLIC LICENSE
License URI: https://github.com/arthvadrr/wordpress-post-type-excerpts/blob/main/LICENSE
*/

/*
 * Exits if not accessed from WP. May generate apocalyptic black hole.
 */
if (!defined('ABSPATH')) {
  exit;
}

function require_post_excerpts_page()
{
  require 'admin-pages/post_excerpts.php';
}

if (is_admin()) {
  add_action('admin_menu', 'register_admin_submenu');
}

function register_admin_submenu()
{
  add_submenu_page(
    'tools.php',
    'Post Excerpts',
    'Post Excerpts',
    'edit_pages',
    'post-excerpts',
    'require_post_excerpts_page'
  );
}
