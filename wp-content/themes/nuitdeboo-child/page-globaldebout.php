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
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="padded">
        <div class="post">
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/content', 'page'); ?>
        </div>
      	<div class="share-btns">
  	     	<div class="center-block">
     				<div class="fb-share-button" data-layout="button_count"></div>
  				<span class="wrap"><a href="https://twitter.com/share" class="twitter-share-button" data-via="globaldebout" data-hashtags="nuitdebout">Tweet</a>
  				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  				</span>
  			 </div>
  		  </div>
      </div>
    </div>
  </div>
</div>

<div class="center-block bg-grey padded row">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2>More infos</h2>
        <ul class='list-unstyled'>
          <li><a href="http://twitter.com/GlobalDebout">twitter.com/GlobalDebout</a></li>
          <li><a href="https://www.facebook.com/events/254751298208004/">facebook.com/events/254751298208004/</a></li>
          <li><a href="mailto:intnuitdebout@riseup.net">intnuitdebout@riseup.net</a></li>
        </ul>
        <?php edit_post_link('edit', '<p>', '</p>'); ?>
      </div>
    </div>
  </div>
</div>

  <?php endwhile; ?>
