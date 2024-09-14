<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <main id="content" class="grid-x">
    
    <?php if (has_post_thumbnail()) {
      the_post_thumbnail();
    } ?>

    <?php edit_post_link(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <div class="entry-content">
        <?php the_content(); ?>
        <div class="entry-links"><?php wp_link_pages(); ?></div>
      </div>
    </article>
  </main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
