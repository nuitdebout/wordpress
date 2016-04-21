<?php
/**
 * Template Name: page global debout
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php
	get_template_part('templates/module', 'screen');
?>
<div class="container">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', 'page'); ?>
    	<div class="col s12 bg-grey share-btns">
	     	<div class="center-block">
   				<div class="fb-share-button" data-layout="button_count"></div>
				<span class="wrap"><a href="https://twitter.com/share" class="twitter-share-button" data-via="globaldebout" data-hashtags="nuitdebout">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</span>
			</div>
		</div>

   	<div class="col s12">
	      <div class="center-block bg-grey padded ">
	        <h3>more infos:</h3>
	        <p>
	            <a href="http://twitter.com/GlobalDebout">twitter.com/GlobalDebout</a>
	        </p>
	        <p>
	        	<a href="https://www.facebook.com/events/254751298208004/">facebook.com/events/254751298208004/</a>
	      	</p>
	      	<p>
	        	<a href="mailto:intnuitdebout@riseup.net">intnuitdebout@riseup.net</a>
	      	</p>
	      	<?php edit_post_link('edit', '<p>', '</p>'); ?>
	      </div>
    </div>
  <?php endwhile; ?>
</div>
