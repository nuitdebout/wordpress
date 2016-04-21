<div id="rassemblements">
	<div class="container padded">

      	<div class="row">
	       	 <div class="col-md-8 col-md-offset-2">
				<?php if(is_home()) { ?>
				<h2>Rassemblements</h2>
				<?php } ?>
	       		<div class="text-center">

	       			<!-- <p>Chercher ma ville</p> !-->
	       			<?php
	       			// echo '<p><a class="btn btn-primary btn-lg" href="'.get_bloginfo("home").'/ville">Voir toutes les villes</a></p>';
	       			?>
	       		</div>
	       	 </div>
		</div>


		<div class="row">
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
			if($pages_sub){
					shuffle($pages_sub);
					$limit_count = 0;
					$all_count = 0;
					$fr_count = 0;
					$world_count = 0;

					if(is_home()) {
						echo '<ul class="list-unstyled list-inline padded">';
						echo '<li class="tag"><a href="'.get_bloginfo("home").'/ville/paris">Paris</a></li>';
					}
					foreach ( $pages_sub as $p ) :
							$all_count++;

							if(get_field('location_type',$p->ID ) ){
									if(get_field('location_type',$p->ID ) == 'France' ){
										$fr_count++;
									}
									else{
											$world_count++;
									}

		                  	}
		                  	else{
		                  		$fr_count++;
		                  	}


							if($limit_count < 15 ){
								$limit_count++;
								if(is_home()) {
									$title = apply_filters('the_title',$p->post_title);
									$url = esc_url( get_permalink($p->ID) );

									echo '<li class="tag"><a href="'.$url.'"">'.$title.'</a></li>';

								}
							}
					endforeach;
					if(is_home()) {
						echo '<li class="tag list_more"><a href="'.get_bloginfo("home").'/ville/">Voir plus de villes</a></li>';
						echo '</ul>';
					}
				//
			}
			?>
		</div>

	</div>
	<div class="row border-grey">
			<div class="col-md-4 bg-dark padded-left">
				<?php /// todo css :

					echo '<p>'.$fr_count.' en France</p>';


					?>
			</div>
			<div class="col-md-4  padded-left">
				<?php /// todo css :
				echo '<p>'.$fr_count.' dans le monde</p>';


					?>
			</div>
			<div class="col-md-4 padded-left-search">
				<?php /// todo css :

get_search_form(  );
					?>
			</div>
 	<iframe border="none"  width="100%" height="600px" frameBorder="0" src="https://framacarte.org/fr/map/nuitdebout_2420?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&datalayersControl=false&onLoadPanel=none&captionBar=false#5/46.332/3.340"></iframe>
	</div>
</div>