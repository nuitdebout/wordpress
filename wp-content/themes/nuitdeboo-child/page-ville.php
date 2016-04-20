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
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>
  <p>Vous voulez compléter cette page, ajouter des liens ? Venez sur le <a href="https://wiki.nuitdebout.fr/wiki/Villes/Agen">wiki</a></p>
  <?php endwhile; ?>
</div>
