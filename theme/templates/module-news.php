<?php

use NuitDebout\Wordress\Homepage;

$featured = Homepage\get_featured_post();
$important = Homepage\get_important_post();
$actions = Homepage\get_latest_posts_by_slug('action');
$analyses = Homepage\get_latest_posts_by_slug('analyses');
$deboutFrance = Homepage\get_latest_posts_by_slug('nuitdebout-en-france');

$exclude = [];

?>

<div class="news-container">
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
	            <?php while ($sticky->have_posts()) : $sticky->the_post(); ?>
	            <a class="news-card  <?php echo has_post_thumbnail() ? 'news-card--animated' : ''?>"
				   href="<?php the_permalink(); ?>">
	                <?php if (has_post_thumbnail()) : ?>
	                    <?php the_post_thumbnail('medium', ['class' => 'news-card__thumb']) ?>
	                <?php endif; ?>
	                <div class="news-card__caption">
	                    <h4 class="news-card__title"><?php the_title(); ?></h4>
						<p class="news-card__content"><?php echo strip_tags(get_the_excerpt()); ?></p>
	                    <small class="news-card__source">
	                        <?php echo get_post_meta(get_the_ID(), 'source_title', true) ?>
	                    </small>
	                </div>
					<p class="news-card__content-animated">
						<?php echo strip_tags(get_the_excerpt());?>
					</p>
	            </a>
	            <?php endwhile; ?>
			</div>
		</div>

		<div class="col-md-4">
			<?php get_template_part('templates/module', 'agenda'); ?>
		</div>
	</div>

	<div class="row news-container__bottom">
		<div class="col-md-4">
			<h2>Actions</h2>
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
		<div class="col-md-4">
			<h2>Nuit debout en France</h2>
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
		<div class="col-md-4">
			<h2>Analyses</h2>
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
		</div>
	</div>
</div>