<?php

use NuitDebout\Wordress\Homepage;

$featured = Homepage\get_featured_post();
$important = Homepage\get_important_post();
$actions = Homepage\get_latest_posts_by_slug('action');
$analyses = Homepage\get_latest_posts_by_slug('analyses');
$deboutFrance = Homepage\get_latest_posts_by_slug('nuitdebout-en-france');

$exclude = [];

?>

<div class="news-container section section--container">
	<div class="row">
		<div class="col-md-8">

			<div class="news-headlines">
				<?php while ($featured->have_posts()) : $featured->the_post(); $exclude[] = get_the_ID(); ?>
				<a class="news-headlines__item news-headlines__item--first" style="background-image: url(<?php
	            the_post_thumbnail_url( 'large' ) ?>)"
	               href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
	            >
					<?php the_title(); ?>
				</a>
				<?php endwhile; ?>
				<?php while ($important->have_posts()) : $important->the_post(); $exclude[] = get_the_ID(); ?>
				<a class="news-headlines__item news-headlines__item--second" style="background-image: url(<?php the_post_thumbnail_url( 'large' ) ?>)"
	                href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	                <?php the_title(); ?>
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
						'image' => get_the_post_thumbnail( null, 'medium', ['class' => 'news-card__thumb']),
					]); ?>
	            <?php endfor; ?>
			</div>
		</div>

		<div class="col-md-4">
			<?php get_template_part('templates/module', 'agenda'); ?>
		</div>
	</div>

	<div class="news-container__bottom">
		<div class="article-list-column">
			<h2 class="article-list-column__title">Actions</h2>
			<div class="article-list-column__articles">
				<?php while ($actions->have_posts()) : $actions->the_post(); ?>
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
				<a class="primary-button" href="/blog">Voir tous les articles</a>
			</div>
		</div>
		<div class="article-list-column">
			<h2 class="article-list-column__title">Nuit debout en France</h2>
			<div class="article-list-column__articles">
				<?php while ($deboutFrance->have_posts()) : $deboutFrance->the_post(); ?>
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
				<a class="primary-button" href="/blog">Voir tous les articles</a>
			</div>
		</div>

		<div class="article-list-column">
			<h2 class="article-list-column__title">Analyses</h2>
			<div class="article-list-column__articles">
				<?php while ($analyses->have_posts()) : $analyses->the_post(); ?>
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
				<a class="primary-button" href="/blog">Voir tous les articles</a>
			</div>
		</div>
	</div>
</div>