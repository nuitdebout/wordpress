<div id="rassemblements" class="section section--gray">
	<?php if(is_home()) : ?>
		<h2 class='section__title'>Rassemblements</h2>
	<?php endif; ?>
	<div class="section__content">
		<?php
		$page = get_page_by_name('Liste des villes');
		$title = apply_filters('the_title',$page->post_title);
		//  echo '<h2>'.$title.'</h2>';
		$args = array(
			'child_of'    => $page->ID,
			'post_type'   => 'page',
			'post_status' => 'publish'
		);
		$pages_sub = get_pages($args);
		if($pages_sub) {
			shuffle($pages_sub);
			$limit_count = 0;
			$all_count = 0;
			$fr_count = 0;
			$world_count = 0;

			if(is_home()) {
				echo '<ul class="list-unstyled list-inline">';
				echo '<li class="tag"><a href="'.get_bloginfo("home").'/ville/paris">Paris</a></li>';
			}
			foreach ( $pages_sub as $p ) {
				$all_count++;

				if(	get_field('location_type',$p->ID ) &&
					get_field('location_type',$p->ID ) != 'France'
				) {
					$world_count++;
				} else{
					$fr_count++;
				}

				if($limit_count >= 5 ) {
					break;
				}
				$limit_count++;

				if(! is_home()) {
					continue;
				}

				$title = apply_filters('the_title',$p->post_title);
				$url = esc_url( get_permalink($p->ID) );
				echo '<li class="tag"><a href="'.$url.'"">'.$title.'</a></li>';
			}
		}
		if(is_home()) :
		?>
			</ul>
			<div class="section__actions-container">
				<a class="btn btn-primary" href="'.get_bloginfo("home").'/ville/">Voir plus de villes</a>
			</div>
		<?php
		endif;
		?>
	</div>
</div>
<iframe border="none"  width="100%" height="400px" frameBorder="0" src="https://framacarte.org/fr/map/nuitdebout_2420?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&datalayersControl=false&onLoadPanel=none&captionBar=false#5/46.332/3.340"></iframe>
