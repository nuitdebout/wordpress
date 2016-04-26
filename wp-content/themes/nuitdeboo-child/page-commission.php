<?php
/**
 * Template Name: page commission
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/module', 'screen') ?>
<section class="section">
	<div class="section__content">
		<div class="post padded-top">
			<?php the_content(); ?>
			<?php edit_post_link('edit', '<p>', '</p>') ?>
		</div>
	</div>
</section>
<?php endwhile; ?>
