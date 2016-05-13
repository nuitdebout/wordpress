<?php
/**
 * Template Name: page ville
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php while (have_posts()) : the_post(); ?>

<?php $fields = get_fields($post->ID); ?>

<?php get_template_part('templates/module', 'screen') ?>

<?php $button_labels = [
	'city_official_website' => 'Site web officiel',
	'facebook_page_url' => 'Page Facebook',
	'twitter_page_url' => 'Compte Twitter',
]?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<section class="padded">
				<div class="post"><?php the_content(); ?></div>
			</section>
		</div>
		<div class="col-md-3">
			<section class="padded">

				<?php if (isset($fields['city_gathering_details'])) : ?>
				<h3>Rendez-vous</h3>
				<p><?php echo $fields['city_gathering_details'] ?></p>
				<?php endif; ?>

				<h3>Réseaux</h3>
				<?php foreach ($button_labels as $field_name => $label) : ?>
				<?php if (isset($fields[$field_name])) : ?>
				<p><a class="btn btn-primary" target="_blank" href="<?php echo $fields[$field_name] ?>"><?php echo $label ?></a></p>
				<?php endif; ?>
				<?php endforeach; ?>
				<!-- Chat -->
				<?php if (isset($fields['chat_page_url'])) : ?>
				<p><a class="btn btn-primary" target="_blank" href="<?php echo $fields['chat_page_url'] ?>"><?php echo $post->post_title ?> sur chat.nuitdebout.fr</a></p>
				<?php endif; ?>

				<h3>Outils</h3>
				<!-- Wiki -->
				<p>Le Wiki est à votre disposition pour créer des pages de manière ouverte et collaborative.</p>
				<p><a class="btn btn-primary" target="_blank" href="<?php echo $fields['wiki_page_url'] ?>"><?php echo $post->post_title ?> sur wiki.nuitdebout.fr</a></p>

				<?php if (isset($fields['city_external_links']) && !empty($fields['city_external_links'])) : ?>
				<h3>Liens</h3>
				<?php $links = explode(PHP_EOL, $fields['city_external_links']) ?>
				<ul class="list-unstyled">
				<?php foreach ($links as $link) : ?>
					<li><a target="_blank" href="<?php echo $link ?>"><?php echo substr($link, 0, 32) ?></a></li>
				<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if (!isset($fields['city_official_website'])) : ?>
				<hr>
				<p>Vous avez déjà un site web pour votre ville, vous avez besoin d'un site web pour votre ville ? <a href="/contact/">Contactez-nous.</a></p>
				<?php endif; ?>
			</section>
		</div>
	</div>
</div>

<?php endwhile; ?>