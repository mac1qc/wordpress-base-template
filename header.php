<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><?php
    $title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
    
    if (is_archive()) {
      $prefix = get_the_archive_title();
      
      if (is_category()) {
        $prefix = single_cat_title('', false);
      } else if (is_tag() ) {
        $prefix = single_tag_title('', false);
      } else if (is_author()) {
        $prefix = get_the_author();
      } else if (is_post_type_archive()) {
        $prefix = post_type_archive_title('', false);
      } else if (is_tax()) {
        $prefix = single_term_title('', false);
      }

      $title = $prefix . ' | ' . get_bloginfo('name');
    } else if (is_single() || (is_page() && !is_home() && !is_front_page())) {
      $title = get_the_title() . ' | ' . get_bloginfo('name');
    }
    ?>

    <title><?= $title ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <aside class="off-canvas clearfix position-left" id="offCanvas">
      <button class="close-button" aria-label="<?= esc_html__('Close the menu', 'theme_language')?>" type="button" data-close><span class="hide"><?= esc_html__('Close the menu', 'theme_language')?></span></button>
      <div class="drilldown-container">
        <?php wp_nav_menu(
          [
            'theme_location' => 'main-menu',
            'container'      => 'nav',
            'menu_class'     => 'menu drilldown'
          ]
        );?>
      </div>
    </aside>

    <div id="wrapper" class="hfeed off-canvas-content">
      <header id="header" class="sticky">
        <div class="top-bar">
          <div class="grid-container">
            <div class="grid-x">
              <div class="cell medium-5 small-8">
                <div class="logo">
                  <a href="<?= esc_url(home_url('/')); ?>" title="<?= esc_html(get_bloginfo('name')); ?>" rel="home"><img src="<?= get_template_directory_uri()?>/img/logo-placeholder.png" alt="YOUR LOGO" width="440" height="94" /></a>
                </div>
              </div>
              <div class="cell medium-7 small-4 clearfix">
                <button class="menu-icon float-right hide-for-large" type="button" data-toggle="offCanvas" aria-label="<?= esc_html__('Open the menu', 'theme_language')?>"><span class="hide"><?= esc_html__('Open the menu', 'theme_language')?></span></button>
                <div class="show-for-large">
                  <?php wp_nav_menu(
                    [
                      'theme_location' => 'main-menu',
                      'container'      => 'nav',
                      'menu_class'     => 'horizontal menu dropdown align-right'
                    ]
                  );?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div id="container">
