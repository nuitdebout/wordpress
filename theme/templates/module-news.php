<?php

use NuitDebout\Wordress\Homepage;

$featured = Homepage\get_featured_post();
$important = Homepage\get_important_post();

$exclude = [];

?>

<div class="row news-container">
	<div class="col-xs-12 col-md-8">

		<div class="news-headlines">
			<?php while ($featured->have_posts()) : $featured->the_post(); $exclude[] = get_the_ID(); ?>
			<div class="news-headlines__first" style="background-image: url(<?php the_post_thumbnail_url( 'large' ) ?>)">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<h2><?php the_title(); ?></h2>
				</a>
			</div>
			<?php endwhile; ?>
			<?php while ($important->have_posts()) : $important->the_post(); $exclude[] = get_the_ID(); ?>
			<div class="news-headlines__second" style="background-image: url(<?php the_post_thumbnail_url( 'large' ) ?>)">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<h2><?php the_title(); ?></h2>
				</a>
			</div>
			<?php endwhile; ?>
		</div>

		<!-- Sticky posts -->
		<?php

		$sticky = Homepage\get_sticky_posts(12, $exclude);

		?>
		<div class="row">
			<div class="col-xs-12">
				<div data-columns>
					<?php while ($sticky->have_posts()) : $sticky->the_post(); ?>
					<div class="news-tile">
						<?php if (has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium') ?>
							</a>
			    		<?php elseif (Homepage\get_first_image(the_content())) : ?>
							<a href="<?php the_permalink(); ?>">
								<img width="300" class="attachment-medium size-medium wp-post-image" src="<?php echo Homepage\get_first_image(the_content()); ?>"></img>
							</a>
						<?php endif; ?>
						<div class="news-tile__caption">
							<a href="<?php the_permalink(); ?>">
								<h4><?php the_title(); ?></h4>
								<p><?php echo strip_tags(get_the_excerpt()); ?></p>
								<small><?php echo get_post_meta(get_the_ID(), 'source_title', true) ?></small>
							</a>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<?php get_template_part('templates/module', 'agenda'); ?>
	</div>
</div>
