<?php
the_posts_navigation(
    [
        'prev_text' => sprintf(esc_html__('%s older', 'theme_language'), '<span class="meta-nav">&larr;</span>'),
        'next_text' => sprintf(esc_html__('newer %s', 'theme_language'), '<span class="meta-nav">&rarr;</span>')
    ]
);
?>