<?php

function getAttachmentThumb($id) {
	$thumb =  get_post_thumbnail_id( $id );
	$url = wp_get_attachment_image_src($thumb , [330, 180])[0];
	return $url;
}

$page_parent = get_field('homepage_takepart', 'option');
if ($page_parent->ID) :
	$parent_id = $page_parent->ID;
	$include = get_pages('include='.$parent_id);
	$content = apply_filters('the_content',$include[0]->post_content);
	$title = apply_filters('the_title',$include[0]->post_title);

	$pages_sub = get_pages([
		'child_of' => $parent_id,
		'post_type' => 'page',
		'post_status' => 'publish'
	]);
	if (! $pages_sub) {
		$pages_sub = [];
	}
?>

<section id="participate" class="section section--gray">
	<h2 class="section__title"><?php echo $title; ?></h2>
	<div class="section__content section__content--emph"><?php echo $content; ?></div>
	<div class="section__actions-container">
		<a class="primary-button" href="http://wiki.nuitdebout.fr">Participez au Wiki</a>
	</div>
	<div class="section__content container-fluid">
		<?php foreach ($pages_sub as $p) : ?>
			<div class="participate-action">
				<div class="participate-action__image">
					<img class="img-responsive" src="<?php echo getAttachmentThumb($p->ID) ?>">
				</div>
				<div class="participate-action__content">
					<h3 class="action-title">
						<?php echo apply_filters('the_title',$p->post_title); ?>
					</h3>

					<?php echo apply_filters('the_content',$p->post_content); ?>
				</div>
			</div>
		<?php endforeach;?>
	</div>
</section>

<?php endif; ?>
