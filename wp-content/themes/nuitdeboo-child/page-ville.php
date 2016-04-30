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

<?php get_template_part('templates/module', 'screen') ?>

<section class="section">
	<div class="section__content">
		<div class="post city-post">
			<?php the_content(); ?>
			<?php edit_post_link('edit', '<p>', '</p>') ?>
		</div>
	</div>
</section>

<?php get_template_part('templates/module', 'home-social') ?>

<section class="section">
	<h2 class="section__title">Contribuez</h2>
	<div class="section__content section__content--center ">
		<p>Vous voulez compléter cette page, ajouter des liens ?</p>
	</div>
	<div class="section__actions-container">
		<a class="primary-button" href="https://wiki.nuitdebout.fr/wiki/Villes/<?php echo get_the_title(); ?>">
			Venez sur le wiki
		</a>
	</div>
</section>

<section class="section section--gray">
	<h2 class="section__title">Activez le site de votre ville</h2>
	<div class="section__content section__content--center ">
		<p>Pour déployer un site de votre ville debout et le gérer comme vous le souhaitez :</p>
	</div>
	<div class="section__actions-container">
		<a class="primary-button" href="<?php echo get_bloginfo('home').'/contact' ?>">Faire une demande de site</a>
	</div>
	<div class="section__content section__content--center ">
		<p>Vous avez déja un site ? <a href="<?php echo get_bloginfo('home').'/contact' ?>">Envoyez-nous</a> le lien</p>
	</div>
</section>

<?php endwhile; ?>
