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

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="padded-top">
        <h2 class="text-center">Agenda</h2>
        <div class="agenda scroll">
             <!-- <div class="cbpgmp cibulMap" data-oamp data-cbctl="27805494/8131954" data-lang="fr" ></div> -->
            <iframe style="width:100%;" frameborder="0" scrolling="no" allowtransparency="allowtransparency" class="cibulFrame cbpgbdy" data-oabdy src="//openagenda.com/agendas/27805494/embeds/8131954/events"></iframe>

          <div class="cbpgcl cibulCalendar" data-oacl data-cbctl="<?php echo get_field('agenda_page_id') ?>" data-lang="fr"></div>


             <script type="text/javascript" src="//openagenda.com/js/embed/cibulCalendarWidget.js"></script>
              <script type="text/javascript" src="//openagenda.com/js/embed/cibulBodyWidget.js"></script>
              <script type="text/javascript" src="//openagenda.com/js/embed/cibulMapWidget.js"></script>
        </div>
      </div>

    </div>
  </div>
</div>

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
       <p><a class="btn btn-primary" href="https://wiki.nuitdebout.fr/wiki/Villes/<?php echo get_the_title(); ?>">Faire une demande de site</a></p>
      <p>Vous avez déja un site ? <a href="mailto:homeof+nb@gmail.com">Envoyez-nous</a> le lien</p>
     </div>
   </div>
  </div>
</div>

<?php endwhile; ?>

