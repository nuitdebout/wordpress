<?php
/**
 * Template Name: page global debout
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_template_part('templates/module', 'screen') ?>

<?php $schedule_page = get_field('globaldebout_schedule_page', get_the_ID()) ?>

<div class="container">
	<div class="row section">
		<div class="col-xs-12 <?php if ($schedule_page) : echo 'col-md-7'; endif ?>">
			<?php while (have_posts()) : the_post(); endwhile; ?>
			<?php get_template_part('templates/content', 'page'); ?>
			<hr>
			<ul class='list-unstyled'>
	            <li><a href="http://twitter.com/GlobalDebout">twitter.com/GlobalDebout</a></li>
	            <li><a href="https://www.facebook.com/events/254751298208004/">facebook.com/events/254751298208004/</a></li>
	            <li><a href="mailto:intnuitdebout@riseup.net">intnuitdebout@riseup.net</a></li>
	        </ul>
			<hr>
			<p><div class="fb-share-button" data-layout="button_count"></div></p>
			<p><a href="https://twitter.com/share"	class="twitter-share-button" data-via="globaldebout" data-hashtags="nuitdebout">Tweet</a></p>
		</div>
		<?php if ($schedule_page) : ?>
		<div class="col-xs-12 col-md-5">
			<div class="panel panel-default">

				<div class="panel-heading"><span class="glyphicon glyphicon-time"></span> <strong><?php echo apply_filters('the_title', $schedule_page->post_title) ?></strong></div>
				<div class="panel-body">
				<?php echo apply_filters('the_content', $schedule_page->post_content) ?>
				</div>
			</div>
		</div>
		<?php endif ?>
	</div>
</div>

<?php get_template_part('templates/module', 'global') ?>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
