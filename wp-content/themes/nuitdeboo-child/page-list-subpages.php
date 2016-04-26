<?php
/**
 * Template Name: page listing subpages villes et commisions
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 * @description : page listing
 */
?>

<?php while (have_posts()) : the_post(); ?>

<?php
$tags = [];
if ($pages_sub = get_pages(['child_of' => $post->ID, 'post_type' => 'page', 'post_status' => 'publish'])) {
    foreach ($pages_sub as $p) {
        $content = apply_filters('the_content', $p->post_content);
        $tags[] = [
            'title' => apply_filters('the_title', $p->post_title),
            'url' => esc_url(get_permalink($p->ID)),
        ];
    }
}
?>

<section class="section list-towns">
    <h2 class="section__title"><?php echo get_the_title() ?></h2>
    <div class="section__content">
	    <?php if (!empty($tags)) : ?>
			<ul class="list-unstyled list-inline">
				<?php foreach ($tags as $tag) : ?>
				<li class="tag">
                    <a href="<?php echo $tag['url'] ?>"><?php echo $tag['title'] ?></a>
                </li>
				<?php endforeach; ?>
			</ul>
	    <?php endif; ?>
    </div>
</section>

<?php if (is_page('Liste des villes')) : ?>
<section class="section section--gray section--subsection">
    <h3 class="section__title">Votre ville n'est pas listée ?</h3>
    <div class="section__actions-container">
        <a class="primary-button" href="https://wiki.nuitdebout.fr/wiki/Villes">Ajoutez-la sur le wiki !</a>
    </div>
</section>
<?php elseif (is_page('Liste des commissions')) : ?>
<section class="section section--gray section--subsection">
    <h3 class="section__title">Votre commision n'est pas listée ?</h3>
    <div class="section__actions-container">
        <a class="primary-button" href="https://wiki.nuitdebout.fr/wiki/Villes">Ajoutez-la sur le wiki !</a>
    </div>
</section>
<?php endif; ?>

<?php endwhile; ?>
