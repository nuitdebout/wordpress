<div class="container">
	 <div class="row">

	 	<div class="col-md-8 col-md-offset-2">
		<?php get_template_part('templates/page', 'header'); ?>
		<?php if (!have_posts()) : ?>
		  <div class="alert alert-warning">
		    <?php _e('Sorry, no results were found.', 'sage'); ?>
		  </div>
		<?php endif; ?>

		<?php while (have_posts()) : the_post(); ?>
		  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
		<?php endwhile; ?>

		</div>
	</div>
	<div class="row">
	  	<div class="col-md-8 col-md-offset-2">
			<div class="navigation text-center padded border-grey-bottom"><?php the_posts_navigation(); ?></div>
		</div>
	</div>

</div>
