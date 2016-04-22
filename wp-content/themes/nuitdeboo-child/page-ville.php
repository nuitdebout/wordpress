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
      <div class="post padded-top">
   		<?php the_content(); ?>
      	<?php edit_post_link('edit', '<p>', '</p>'); ?>
      </div>
    </div>
  </div>
</div>
<?php get_template_part('templates/module', 'home-social'); ?>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="padded text-center">
      <h2>Contribuez</h2>
      <p>Vous voulez compléter cette page, ajouter des liens ?</p>
      <p><a class="btn btn-primary" href="https://wiki.nuitdebout.fr/wiki/Villes/<?php echo get_the_title(); ?>">Venez sur le wiki</a></p>
    </div>
  </div>
 </div>

<div class="bg-grey">
  <div class="row">
   <div class="col-md-6 col-md-offset-3">
     <div class="padded text-center">
       <h2>Activez le site de votre ville</h2>
       <p>Pour déployer un site de votre ville debout et le gérer comme vous le souhaitez :</p>
       <p><a class="btn btn-primary" href="mailto:homeof+nb@gmail.com">Faire une demande de site</a></p>
      <p>Vous avez déja un site ? <a href="mailto:homeof+nb@gmail.com">Envoyez-nous</a> le lien</p>
     </div>
   </div>
  </div>
</div>

<?php endwhile; ?>

