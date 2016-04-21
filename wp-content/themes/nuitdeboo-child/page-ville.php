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
      <div class="text-center post">
   		<?php the_content(); ?>

   		<p>Vous voulez compléter cette page, ajouter des liens ? <a class="btn btn-primary" href="https://wiki.nuitdebout.fr/wiki/Villes/<?php echo get_the_title(); ?>"> Venez sur le wiki</a></p>

      	<?php edit_post_link('edit', '<p>', '</p>'); ?>
      </div>
    </div>

  </div>
</div>




        <div class="cbpgmp cibulMap" data-oamp data-cbctl="27805494/8131954" data-lang="fr" ></div>
             <iframe style="width:100%;" frameborder="0" scrolling="no" allowtransparency="allowtransparency" class="cibulFrame cbpgbdy" data-oabdy src="//openagenda.com/agendas/27805494/embeds/8131954/events"></iframe>

       <div class="cbpgcl cibulCalendar" data-oacl data-cbctl="<?php echo get_field('agenda_page_id') ?>" data-lang="fr"></div>


        <script type="text/javascript" src="//openagenda.com/js/embed/cibulCalendarWidget.js"></script>
         <script type="text/javascript" src="//openagenda.com/js/embed/cibulBodyWidget.js"></script>
         <script type="text/javascript" src="//openagenda.com/js/embed/cibulMapWidget.js"></script>



<?php get_template_part('templates/module', 'home-social'); ?>

  <div class="row">
 			 <div class="col-md-8 col-md-offset-2">
      			<div class="">
      			</div>
      		</div>
 </div>



<?php endwhile; ?>
