<?php
function app_setup(): void
{
  register_nav_menus(
    [
      'main-menu'   => esc_html__('Main Menu', 'theme_language'),
      'footer-menu' => esc_html__('Menu footer', 'theme_language')
    ]
  );
}
add_action( 'after_setup_theme', 'app_setup' );

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

function remove_head_scripts(): void
{
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);

  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('wp_enqueue_scripts','remove_head_scripts');

function my_deregister_scripts(): void
{
  wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'my_deregister_scripts');

function wpassist_remove_block_library_css(): void
{
    wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'wpassist_remove_block_library_css');

function app_image_insert_override(array $sizes): array
{
  unset($sizes['medium_large']);
  return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'app_image_insert_override');

function app_widgets_init(): void
{
  register_sidebar(
    [
      'name'          => esc_html__('Sidebar Widget Area', 'theme_language'),
      'id'            => 'primary-widget-area',
      'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
      'after_widget'  => '</li>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ]
  );
}
add_action('widgets_init', 'app_widgets_init');

function app_register_assets(): void
{
  wp_deregister_script('jquery');

  wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
  wp_register_script('general', get_stylesheet_directory_uri() . '/js/scripts.min.js', ['jquery']);
  wp_enqueue_script('general');

  wp_register_style('generalStyle', get_stylesheet_directory_uri() . '/style.css');
  wp_enqueue_style('generalStyle');
}
add_action('wp_enqueue_scripts','app_register_assets');

add_theme_support('post-thumbnails');

function add_file_types_to_uploads(array $file_types): array
{
    $new_filetypes         = [];
    $new_filetypes['svg']  = 'image/svg+xml';
    $new_filetypes['webp'] = 'image/webp';

    return array_merge($file_types, $new_filetypes );
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function wpb_disable_feed(): void
{
  wp_die(
    sprintf(
        esc_html__('No RSS feed available, go back <a href="%s">home</a>!'), get_bloginfo('url')
    )
  );
}
add_action('do_feed', 'wpb_disable_feed', 1);
add_action('do_feed_rdf', 'wpb_disable_feed', 1);
add_action('do_feed_rss', 'wpb_disable_feed', 1);
add_action('do_feed_rss2', 'wpb_disable_feed', 1);
add_action('do_feed_atom', 'wpb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'wpb_disable_feed', 1);
add_action('do_feed_atom_comments', 'wpb_disable_feed', 1);