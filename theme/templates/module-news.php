<?php

use NuitDebout\Wordpress\Homepage;

$featured = Homepage\get_featured_post();
$important = Homepage\get_important_post();
$category_slugs = ['action', 'nuitdebout-en-france', 'analyses'];

$exclude = [];

?>

<div class="news-container">
<div class="section section--container">
	<div class="row">
		<div class="col-md-8">

			<div class="news-headlines-container">
				<?php while ($featured->have_posts()) : $featured->the_post(); $exclude[] = get_the_ID(); ?>
				<a class="news-headline news-headline--first" style="background-image: url(<?php
	            the_post_thumbnail_url( 'large' ) ?>)"
	               href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
	            >
					<div class="news-headline__title">
						<?php the_title(); ?>
					</div>
				</a>
				<?php endwhile; ?>
				<?php while ($important->have_posts()) : $important->the_post(); $exclude[] = get_the_ID(); ?>
				<a class="news-headline news-headline--second" style="background-image: url(<?php the_post_thumbnail_url( 'large' ) ?>)"
	                href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<div class="news-headline__title">
						<?php the_title(); ?>
					</div>
				</a>
				<?php endwhile; ?>
			</div>

				<!-- Sticky posts -->
			<?php
				$sticky = Homepage\get_sticky_posts(12, $exclude);
			?>
	        <div class="news-list">
	            <?php for ($i = 0; $sticky->have_posts() && $i < 6; $i++ ) : $sticky->the_post(); ?>
					<?php the_component('news-card', [
						'title' => get_the_title(),
						'source' => get_post_meta(get_the_ID(), 'source_title', true),
						'content' => strip_tags(get_the_excerpt()),
						'link' => get_the_permalink(),
						'image' =>  get_the_post_thumbnail_url(null, 'medium'),
					]); ?>
	            <?php endfor; ?>
			</div>
		</div>

		<div class="col-md-4">
			<?php get_template_part('templates/module', 'agenda'); ?>
		</div>
	</div>

	<div class="news-container__bottom">
		<?php foreach ($category_slugs as $category_slug) : ?>
		<?php
		$query = Homepage\get_latest_posts_by_slug($category_slug);
		$category = get_category_by_slug($category_slug);
		?>
		<div class="article-list-column">
			<h2 class="article-list-column__title"><?php echo $category->cat_name ?></h2>
			<div class="article-list-column__articles">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="entry">
						<a class="block-link" href="<?php the_permalink(); ?>">
							<div class="news-latest">
								<h4><?php the_title(); ?></h4>
								<?php the_excerpt(); ?>
							</div>
						</a>
						<?php get_template_part('templates/entry-taxonomies'); ?>
					</div>
				<?php endwhile; ?>
			</div>
			<div class="article-list-column__call-to-action">
				<a class="primary-button" href="<?php echo get_category_link($category->cat_ID) ?>">Voir tous les articles</a>
			</div>
		</div>
		<?php endforeach ?>
	</div>
</div>
</div>