<?php
/**
 * Template Name: page global debout
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php
	get_template_part('templates/module', 'screen');
?>
<div class="container">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', 'page'); ?>
   	<div class="col s12">
	      <div class="center-block">
	        <h3>more infos:</h3>
	        <p>
	            <a href="http://twitter.com/GlobalDebout">twitter.com/GlobalDebout</a>
	        </p>
	        <p>
	        	<a href="https://www.facebook.com/events/254751298208004/">facebook.com/events/254751298208004/</a>
	      	</p>
	      	<p>
	        	<a href="mailto:intnuitdebout@riseup.net">intnuitdebout@riseup.net</a>
	      	</p>
	      	<?php edit_post_link('edit', '<p>', '</p>'); ?>
	      </div>
    </div>
  <?php endwhile; ?>
</div>
