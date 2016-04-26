<?php
/**
 * Template Name: page list ville
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * @todo move the logic
 */
$page = get_page_by_name('Liste des villes');
$pageTitle = apply_filters('the_title',$page->post_title);
$args = array(
		'child_of' => $page->ID,
		'post_type' => 'page',
		'post_status' => 'publish'
);
$pages_sub = get_pages($args);
$cities = [];
if($pages_sub){
	foreach ( $pages_sub as $p ) {
		$content = apply_filters('the_content',$p->post_content);
		$title = apply_filters('the_title',$p->post_title);
		$url = esc_url( get_permalink($p->ID) );
        $cities[] = [
            'url' => $url,
            'title' => $title
        ];
    }
}
?>

<section class="section list-towns">
    <h2 class="section__title">Liste des villes</h2>
    <div class="section__content">
        <ul class="cities-list">
            <?php foreach ($cities as $city) : ?>
                <li class="tag">
                    <a href="<?php echo $city['url'] ?>"><?php echo $city['title'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="section section--gray section--subsection">
    <h3 class="section__title">Votre ville n'est pas listée ?</h3>
    <div class="section__actions-container">
        <a class="primary-button" href="http://wiki.nuitdebout.fr">Ajoutez-la sur le wiki !</a>
    </div>
</section>
