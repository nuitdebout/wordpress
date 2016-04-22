<?php ?>
<div id="global" class="bg-grey row">
	<div class="container padded">
    	<div class="row">
     		<div class="col-md-8 col-md-offset-2">
				<div class="text-center">
					<?php $page_parent = get_field('homepage_global', 'option');
					if($page_parent->ID){
						$parent_id = $page_parent->ID;
						$args = array(
							'child_of' => $parent_id,
							'post_type' => 'page',
							'post_status' => 'publish'
						);
						$pages_sub = get_pages($args);
						$include = get_pages('include='.$parent_id);
						$excerpt = get_the_excerpt($include[0]->ID);
						$title = apply_filters('the_title',$include[0]->post_title);
						$permalink = get_permalink($include[0]->ID);

					}
					?>
          			<h2><?php echo $title; ?></h2>
			          <div class="padded">
			            <p><?php echo $excerpt; ?></p>
			          </div>
			          <ul class="list-unstyled list-inline">
			          <?php

						if($pages_sub){
							foreach ( $pages_sub as $p ) :
								$content = apply_filters('the_content',$p->post_content);
								$title = apply_filters('the_title',$p->post_title);
								$permalink = get_permalink($p->ID);
								//$thumb =  get_post_thumbnail_id( $p->ID );
							 	//$i = wp_get_attachment_image_src($thumb , 'thumbnail' );
								// $url = $i['0'];
								?>
			            		<li class="tag"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></li>
			           			<?php endforeach;
			          	}
			          	?>
			          </ul>
        		</div>
      		</div>
    	</div>
	</div>
</div>
