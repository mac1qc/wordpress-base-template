<?php get_header(); ?>
  <main id="content">
    <?php if (has_post_thumbnail()) {
      the_post_thumbnail();
    } ?>
    <div class="grid-container">
      <div class="grid-x">
        <section class="cell large-9 medium-8">
          <div class="grid-container">
            <div class="grid-x">
              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="cell large-4 medium-6">
                  <?php get_template_part('entry'); ?>
                  <?php comments_template(); ?>
                </article>
              <?php endwhile; endif;?>
            </div>
          </div>
          <?php get_template_part('nav', 'below'); ?>
        </section>
        <aside class="cell large-3 medium-4">
          <?php get_sidebar(); ?>
        </aside>
      </div>
    </div>
  </main>
<?php get_footer(); ?>
