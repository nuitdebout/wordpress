<?php
/**
 * Template Name: page commission
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
      <div class="post padded-top">
   		<?php the_content(); ?>
      	<?php edit_post_link('edit', '<p>', '</p>'); ?>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="padded text-center">
      <h2>Contribuez</h2>
      <p>Vous voulez compléter cette page, ajouter des liens ?</p>
      <p><a class="btn btn-primary" href="https://wiki.nuitdebout.fr/wiki/Commissions/<?php echo get_the_title(); ?>">Venez sur le wiki</a></p>
    </div>
  </div>
 </div>

<?php endwhile; ?>

