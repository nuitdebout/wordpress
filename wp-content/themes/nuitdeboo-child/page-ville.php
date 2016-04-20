<?php
/**
 * Template Name: page ville
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php use Roots\Sage\Titles; ?>

    <?php while (have_posts()) : the_post(); ?>



		<?php
		$img = get_the_post_thumbnail('page-banner');

		$thumb =  get_post_thumbnail_id(  );
		$i = wp_get_attachment_image_src($thumb , 'page-banner' );
		$url = $i['0'];



		?>
<div class="homepagescreen">
			<div class="row-----">
				<div class="col-xs-12">
         			<div class="banner-homepage" style="
                      background: url(<?= $url ?>);
                      background-size: cover !important;
                      background-position: center center;
                      background-repeat: no-repeat;">
            			<div class="text-center container">

              				<div id="site_title">
               					<h1><?= Titles\title(); ?></h1>


              				</div>

          				</div>
					</div>
				</div>
			</div>
		</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="text-center ">
   		<?php the_content();
	 	?>

   		 <p>Vous voulez compléter cette page, ajouter des liens ? <br><br><a class="btn btn-primary" href="https://wiki.nuitdebout.fr/wiki/Villes/Agen"> Venez sur lewiki</a></p>
    		<?php endwhile; ?>
      </div>
    </div>
  </div>
</div>



