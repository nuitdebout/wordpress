


<?php while (have_posts()) : the_post(); ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="post">
      		<?php get_template_part('templates/page', 'header'); ?>
      		<?php get_template_part('templates/entry-meta'); ?>

	     	<div class="entry-content">
			      <?php the_content(); ?>
			</div>
		</div>

      	<div class="share-btns">
  	     	<div class="center-block">
     			<div class="fb-share-button" data-layout="button_count"></div>
  				<span class="wrap">
  					<a href="https://twitter.com/share" class="twitter-share-button" data-via="globaldebout" data-hashtags="nuitdebout">Tweet</a>
  					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  				</span>
  			</div>
  		</div>

    	<?php comments_template('/templates/comments.php'); ?>


      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>



