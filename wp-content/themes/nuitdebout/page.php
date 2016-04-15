<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="container">
  <div class="row">
      <div class="col s12" style="padding-top:100px;">
      <?php
		// Start the loop.
		while ( have_posts() ) : the_post(); ?>
       	<?php the_title( '<h1>','</h1>'); ?>
        <p class="center">Vous voulez compléter cette page, ajouter des liens ? Venez sur le <a href="http://chat.nuitdebout.fr">chat</a>.</p>
        <h3 class="header">Liens</h2>
        <div class="collection">
        	<?php
        	the_content();
        	?>
        </div>
        <h3 class="header">Wiki</h2>
        <p>Pour collecter les informations et la mémoire, venez sur le Wiki.</p>
        <div class="collection">
          <a href="https://wiki.nuitdebout.fr/" class="collection-item">https://wiki.nuitdebout.fr</a>
        </div>
        <?php 
		endwhile;
		?>
      </div>
  </div>
</div>
<?php get_footer(); ?>
