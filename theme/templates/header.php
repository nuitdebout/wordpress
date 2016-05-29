<?php use NuitDebout\Wordress\OpenAgenda; ?>

<?php if (is_main_site()) : ?>
	<?php get_template_part('templates/module', 'current-actions'); ?>
<?php endif ?>


<header class="header">
	<?php the_component('navbar'); ?>
</header>
