<?php
/**
 * Template Name: page listing subpages villes et commisions
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 * @description : page listing
 */
?>

<?php
	while (have_posts()) : the_post();
?>
<div class="list-towns">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="text-center padded">
		<?php
		    echo '<h2>'.get_the_title().'</h2>';
			$args = array(
					'child_of' => $post->ID,
					'post_type' => 'page',
					'post_status' => 'publish'
			);
			$pages_sub = get_pages($args);
			if($pages_sub){
					echo '<ul class="list-unstyled list-inline">';
					foreach ( $pages_sub as $p ) :
							$content = apply_filters('the_content',$p->post_content);
							$title = apply_filters('the_title',$p->post_title);
							$url = esc_url( get_permalink($p->ID) );
							echo '<li class="tag"><a href="'.$url.'"">'.$title.'</a></li>';
							endforeach;
					echo '</ul>';
			}
		?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="text-center padded bg-grey" >
 	<?php if( is_page('Liste des villes')){
 		echo '<h3>Votre ville n\'est pas listée ?</h3>';
 		echo '<p><a class="btn btn-primary btn-lg" href="https://wiki.nuitdebout.fr/wiki/Villes">ajoutez-la sur le wiki !</a></p>';
 	}
 	else if( is_page('Liste des commissions')){
 		echo '<h3>Votre commision n\'est pas listée ?</h3>';
 		echo '<p><a class="btn btn-primary btn-lg" href="http://wiki.nuitdebout.fr">ajoutez-la sur le wiki !</a></p>';
 	}
  	?>
  </div>
</div>
<?php
endwhile; ?>