<?php get_header(); ?>
<main id="content" class="grid-x">
  <section class="grid-container">
    <div class="grid-x">
      <article class="cell">
        <h1><?= esc_html__('Error 404 | Not found!', 'theme_language')?></h1>
        <p><?= esc_html__('No page has been found while using that URL. The page might has been moved.', 'theme_language')?></p>
        <a href="<?= esc_url(home_url('/'));?>" class="button"><?= esc_html__('Back to home', 'theme_language')?></a>
      </article>
    </div>
  </section>
</main>
<?php get_footer(); ?>
