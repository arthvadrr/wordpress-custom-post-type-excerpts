<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

$option_prefix = 'cpte_excerpt_length__';
$post_types = get_post_types();

$ignored_post_types = [
  'attachment',
  'revision',
  'nav_menu_item',
  'custom_css',
  'customize_changeset',
  'oembed_cache',
  'user_request',
  'wp_block',
  'wp_template',
  'wp_template_part',
  'wp_global_styles',
  'wp_navigation'
];

foreach ($post_types as $type) {
  if (!in_array($type, $ignored_post_types)) {
    delete_option($option_prefix . $type);
  }
}
