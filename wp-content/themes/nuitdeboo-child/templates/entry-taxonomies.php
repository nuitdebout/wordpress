<?php
$output = '';
$taxonomies = array('category', 'post_tag','media_category');
foreach( $taxonomies as $tax ) {
	$categories = get_the_terms( $post->ID, $tax );
	if($categories){
		$lastElement = end($categories);
		$output.= '<span class="post-taxonomy post-taxonomy--'.$tax.'">';

				if($tax =='category'){
					$output.= '<span>Classé dans </span>';
				}
				if($tax =='post_tag'){
					$output.= '<span> | </span>';
				}

				foreach( $categories as $category ) {
				$output.= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
					if($tax =='category' && $category !==$lastElement ){
						$output.= ', ';
					}
				}
		$output.= '</span>';
	}

 }
 if($output !== ''){ ?>
	<div class="post-taxonomies">
		<?php echo $output; ?>
	</div>
 <?php } ?>