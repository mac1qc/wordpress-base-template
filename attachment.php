<?php get_header(); ?>
<?php global $post; ?>
<main id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="header">
                <h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
                <?php get_template_part('entry', 'meta'); ?>
                <a href="<?= esc_url(get_permalink($post->post_parent)); ?>" title="<?php printf(esc_html__('Return to %s', 'theme_language'), esc_html(get_the_title($post->post_parent), 1)); ?>" rev="attachment"><?php printf(esc_html__( '%s Return to ', 'theme_language'), '<span class="meta-nav">&larr;</span>'); ?><?= get_the_title($post->post_parent); ?></a>
                <nav id="nav-above" class="navigation">
                    <div class="nav-previous"><?php previous_image_link(false, '&lsaquo;'); ?></div>
                    <div class="nav-next"><?php next_image_link(false, '&rsaquo;'); ?></div>
                </nav>
            </header>
            <div class="entry-content">
                <div class="entry-attachment">
                    <?php if (wp_attachment_is_image($post->ID)) : $att_image = wp_get_attachment_image_src($post->ID, 'full'); ?>
                        <p class="attachment"><a href="<?= esc_url(wp_get_attachment_url($post->ID)); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><img src="<?= esc_url($att_image[0]); ?>" width="<?= esc_attr($att_image[1]); ?>" height="<?= esc_attr( $att_image[2] ); ?>" class="attachment-full" alt="<?php $post->post_excerpt; ?>" /></a></p>
                    <?php else : ?>
                        <a href="<?= esc_url( wp_get_attachment_url( $post->ID ) ); ?>" title="<?= esc_attr(get_the_title($post->ID), 1); ?>" rel="attachment"><?= esc_url(basename($post->guid)); ?></a>
                    <?php endif; ?>
                </div>
                <div class="entry-caption"><?php if (!empty($post->post_excerpt)) {the_excerpt();} ?></div>
                <?php if (has_post_thumbnail()) {the_post_thumbnail();} ?>
            </div>
        </article>
        <?php comments_template(); ?>
    <?php endwhile; endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>