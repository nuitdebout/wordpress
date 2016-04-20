<?php
/**
 * Template Name: page ville
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="text-center ">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
    <p>Vous voulez compléter cette page, ajouter des liens ? <br><br><a class="btn btn-primary" href="https://wiki.nuitdebout.fr/wiki/Villes/Agen"> Venez sur lewiki</a></p>
    <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>



