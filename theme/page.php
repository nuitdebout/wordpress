<?php use Roots\Sage\Titles; ?>

<?php while (have_posts()) : the_post(); ?>
<article class="page">
	<header class="page__header">
		<h2><?= Titles\title(); ?></h2>
		<?php if (has_post_thumbnail()) : ?>
		<div class="page__thumbnail"><?php the_post_thumbnail() ?></div>
		<?php endif; ?>
	</header>
	<div class="page__content user-content">
	<?php get_template_part('templates/content', 'page'); ?>
	</div>
</article>
<?php endwhile; ?>
