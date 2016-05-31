<?php use NuitDebout\Wordress\OpenAgenda; ?>

<header class="header">
	<?php if (is_main_site()) : ?>
		<?php get_template_part('templates/module', 'current-actions'); ?>
	<?php endif ?>

	<?php the_component('navbar'); ?>

	<div class="side-nav-overlay closed"></div>
</header>
