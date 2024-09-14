<?php get_header(); ?>
  <main id="content">
    <div class="grid-container">
      <div class="grid-x">
        <article class="cell large-9 medium-8">
          <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <?php get_template_part('entry'); ?>
            
            <?php
            if (comments_open() && !post_password_required()){
              comments_template('', true);
            }
            ?>

          <?php endwhile; endif; ?>
          <?php get_template_part('nav', 'below-single'); ?>
        </article>
        <aside class="cell large-3 medium-4">
          <?php get_sidebar(); ?>
        </aside>
      </div>
    </div>
  </main>
<?php get_footer(); ?>
