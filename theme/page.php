<?php while (have_posts()) : the_post();

if(get_field('page_include_screen') == 1){
	get_template_part('templates/module', 'screen');
}
?>
<section class="section">
	<div class="section__content">
		<div class="post">
		 	<?php
				if(get_field('page_include_screen') == 0){
					get_template_part('templates/page', 'header');
				}
				get_template_part('templates/content', 'page');
				if(!is_page('contact')){ ?>
					<div class="share-btns">
				     	<div class="">
							<div class="fb-share-button" data-layout="button_count"></div>
							<span class="wrap"><a href="https://twitter.com/share" class="twitter-share-button" data-via="globaldebout" data-hashtags="nuitdebout">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							</span>
						</div>
					</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php endwhile; ?>
