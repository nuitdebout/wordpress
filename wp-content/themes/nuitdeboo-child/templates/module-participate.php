<div id="participate" class="row">
<?php
	$page_parent = get_field('homepage_takepart', 'option');
	if($page_parent->ID){
		$parent_id = $page_parent->ID;

		$include = get_pages('include='.$parent_id);
		$content = apply_filters('the_content',$include[0]->post_content);
		$title = apply_filters('the_title',$include[0]->post_title);
		?>
		<div class="section">
			<h2 class="section__title"><?php echo $title; ?></h2>
			<div class="section__content section__content--emph"><?php echo $content; ?></div>
			<div class="section__actions-container">
				<a class="btn btn-primary" href="http://wiki.nuitdebout.fr">Participez au Wiki</a>
			</div>
			<?php
			$args = array(
				'child_of' => $parent_id,
				'post_type' => 'page',
				'post_status' => 'publish'
			);
			$pages_sub = get_pages($args);
			if($pages_sub){
				foreach ( $pages_sub as $p ) :
					$content = apply_filters('the_content',$p->post_content);
					$title = apply_filters('the_title',$p->post_title);
					$thumb =  get_post_thumbnail_id( $p->ID );
				 	$i = wp_get_attachment_image_src($thumb , 'thumbnail' );
					$url = $i['0'];
					?>

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="padded-small">
								<?php echo '<img class="pull-left" src='.$url.' />'; ?>
								<h3 class="mg-top0"><?php echo $title; ?></h3>
								<?php echo $content; ?>
							</div>
						</div>
					</div>

					<?php
				endforeach;
			} // if subs
		} else{
			echo 'Please go to admin > options > Participer and select the page you want to display (a page must be created before)';
		}
		?>
	</div>
</div>
