

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    	<?php get_template_part('templates/page', 'header'); ?>
	</div>
  </div>


<?php
  while (have_posts()) : the_post(); ?>
  <div class="row ">
  	<div class="col-md-8 col-md-offset-2">
        <div class="post post-loop-item">

			<h3 class="entry-title">

				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>

      		<?php get_template_part('templates/entry-meta'); ?>

		    <div class="entry-content noCommune">
		      <?php the_content(); ?>
		    </div>
    		<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      	</div>
	</div>
  </div>
  <?php
  endwhile; ?>
	<div class="row ">
	  	<div class="col-md-8 col-md-offset-2">
			<div class="navigation text-center padded border-grey-bottom"><?php the_posts_navigation(); ?></div>
		</div>
	</div>
<?php
?>
</div>
