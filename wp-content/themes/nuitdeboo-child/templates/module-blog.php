<div class="section">
    <div class="section__title">
        <?php get_template_part('templates/page', 'header'); ?>
    </div>
    <?php
    while (have_posts()) : the_post(); ?>
    <div class="section__content">
        <div class="post post-loop-item">
            <h3 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
  			<div class="entry-meta">
            	<?php get_template_part('templates/entry-meta'); ?>
            </div>

            <div class="entry-content noCommune">
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
        </div>
    </div>
	<?php endwhile; ?>
	<!--
    <div class="section__content">
        <div class="navigation text-center padded border-grey-bottom"><?php the_posts_navigation(); ?></div>
    </div>
    !-->
</div>
