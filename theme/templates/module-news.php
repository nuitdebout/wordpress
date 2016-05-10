<div id="news" class="section section--gray">
	<h2 class="section__title">Actualités</h2>
	<div class="container news-container">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<h3>Derniers posts</h3>
				<div class="list-group">
					<?php $i = 0; while (have_posts()) : the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="list-group-item">
						<h4 class="list-group-item-heading"><?php the_title(); ?></h4>
						<p class="list-group-item-text"><?php echo strip_tags(get_the_excerpt()); ?></p>
					</a>
					<?php if (++$i === 3) : break; endif; endwhile; ?>
				</div>
			</div>
			<div class="col-xs-12 col-md-4 news-container__rss">
				<h3>Dernières news</h3>
				<?php
				if(function_exists('wprss_display_feed_items')) :
					wprss_display_feed_items(array(
						'links_before' => '<ul class="list-group">',
						'links_after' => '</ul>',
						'link_before' => '<li class="list-group-item">',
						'link_after' => '</li>',
						'limit' => '6',
					));
				endif;
				?>
			</div>
			<div class="col-xs-12 col-md-4 hidden-sm hidden-xs">
				<h3>Facebook</h3>
				<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FNuitDebout%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=false&hide_cover=true&show_facepile=false&appId=353426784843236" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</div>
		</div>
	</div>
</div>
