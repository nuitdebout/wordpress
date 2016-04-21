<?php
/**
 * Template Name: page ville
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php while (have_posts()) : the_post(); ?>
<?php
	get_template_part('templates/module', 'screen');
?>
<div class="container">
  <div class="row">

    <div class="col-md-8 col-md-offset-2">
      <div class="text-center ">
   		<?php the_content(); ?>
   		<p>Vous voulez compléter cette page, ajouter des liens ? <a class="btn btn-primary" href="https://wiki.nuitdebout.fr/wiki/Villes/<?php echo get_the_title(); ?>"> Venez sur le wiki</a></p>
      	<?php edit_post_link('edit', '<p>', '</p>'); ?>
      </div>
    </div>

  </div>
</div>
<?php endwhile; ?>
