 <?php
  /*
Plugin Name: Wordpress Post Type Excerpts
Description: Adds an option page in the WP admin that allows setting excerpts for any post type
Version: 1.0.0
Author: Arthvadrr
License: GNU AFFERO GENERAL PUBLIC LICENSE
License URI: https://github.com/arthvadrr/wordpress-post-type-excerpts/blob/main/LICENSE
*/

  if (!defined('ABSPATH')) {
    exit;
  }

  function cpte_init()
  {
    function cpte_require_post_excerpts_page()
    {
      require 'admin-pages/post_excerpts.php';
    }

    function cpte_register_admin_submenu()
    {
      add_submenu_page(
        'tools.php',
        'Set Excerpt Lengths',
        'Set Excerpt Lengths',
        'edit_pages',
        'post-excerpts',
        'cpte_require_post_excerpts_page'
      );
    }

    function cpte_register_admin_scripts()
    {
      wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . '/admin-pages/post_excerpts.css');
    }

    if (is_admin()) {
      add_action('admin_menu', 'cpte_register_admin_submenu');
      add_action('admin_enqueue_scripts', 'cpte_register_admin_scripts');
    }
  }
  add_action('init', 'cpte_init');

  function cpte_set_excerpt_length()
  {
    global $post;
    $option_prefix = 'cpte_excerpt_length__';
    $option = get_option('cpte_excerpt_length__' . $post->post_type);

    if (!$option) {
      add_option($option_prefix . $post->post_type, 55);
      $option = 55;
    }

    return $option;
  }
  add_filter('excerpt_length', 'cpte_set_excerpt_length');

  function cpte_deactivate()
  {
    flush_rewrite_rules();
  }
  register_deactivation_hook(__FILE__, 'cpte_deactivate');
