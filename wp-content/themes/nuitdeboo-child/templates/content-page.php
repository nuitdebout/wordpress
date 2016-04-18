<?php the_content(); ?>

<a href="<?php echo get_bloginfo('url'); ?>/ville"> liste des villes</a> :

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
