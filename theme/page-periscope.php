<?php
/**
 * Template Name: Page Periscope
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

use NuitDebout\Wordpress\Periscope;

?>
<?php while (have_posts()) : the_post(); ?>

<?php $periscopers = Periscope\get_periscopers($post); ?>

<div class="section">
    <h2 class="section__title"><?php the_title() ?></h2>
    <div class="section__content">
        <?php the_content() ?>
    </div>
</div>

<div class="container">
	<div class="row">
		<?php foreach ($periscopers as $periscoper) : ?>
		<div class="col-xs-12 col-sm-3">
			<div class="periscoper">
				<img src="<?php echo $periscoper['profile_image'] ?>">
	        	<a class="periscope-on-air" data-size="large" href="https://www.periscope.tv/<?php echo $periscoper['username'] ?>">
	        	@<?php echo $periscoper['username'] ?>
	        	</a>
	        </div>
		</div>
		<?php endforeach; ?>
	</div>

</div>

<?php endwhile; ?>

<script>window.twttr=function(t,e,r){var n,i=t.getElementsByTagName(e)[0],w=window.twttr||{};return t.getElementById(r)?w:(n=t.createElement(e),n.id=r,n.src="https://platform.twitter.com/widgets.js",i.parentNode.insertBefore(n,i),w._e=[],w.ready=function(t){w._e.push(t)},w)}(document,"script","twitter-wjs")</script>
