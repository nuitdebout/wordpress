<article <?php post_class(); ?>>
  <header>
  	<div class="entry-meta"><?php get_template_part('templates/entry-meta'); ?></div>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
