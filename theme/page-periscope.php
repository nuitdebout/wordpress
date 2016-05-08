<?php
/**
 * Template Name: Page Periscope
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php while (have_posts()) : the_post(); ?>

<div class="section">
    <h2 class="section__title"><?php the_title() ?></h2>
    <div class="section__content">
        <?php the_content() ?>
    </div>
</div>

<div class="container">
	<div id="periscope-wall" class="row">
		<div class="progress">
		  	<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
		    	0%
		  	</div>
		</div>
	</div>
</div>

<script>window.twttr=function(t,e,r){var n,i=t.getElementsByTagName(e)[0],w=window.twttr||{};return t.getElementById(r)?w:(n=t.createElement(e),n.id=r,n.src="https://platform.twitter.com/widgets.js",i.parentNode.insertBefore(n,i),w._e=[],w.ready=function(t){w._e.push(t)},w)}(document,"script","twitter-wjs")</script>
<?php endwhile; ?>
