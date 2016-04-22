<?php
	if ( is_page() || get_field('homepage_screen', 'option') ) {

		if(is_home() || is_front_page() ){
			$bg_ = get_field('homepage_screen', 'option');
			$bg = $bg_['url'];
		}
		else{
			$img = get_the_post_thumbnail('page-banner');
			$t = get_the_title();
			$thumb =  get_post_thumbnail_id(  );
			$i = wp_get_attachment_image_src($thumb , 'page-banner' );
			$bg = $i['0'];
			if(!$bg){
				$bg = get_stylesheet_directory_uri().'/dist/images/banner-large.jpg';
			}
		}
		?>
		<div class="row homepagescreen">
 			<div class="banner-homepage" style="
              background: url(<?= $bg ?>);
              background-size: cover !important;
              background-position: center center;
              background-repeat: no-repeat;">
    			<div class="text-center container">
      				<div id="nuitdeboutdate"></div>
        			<div id="site_title">
	         			<?php
	         			if(is_home()  ){
	         				if(is_rootsite()){
	         	                echo '<h1><img src="'.get_stylesheet_directory_uri().'/assets/images/logowhite.svg" class="nd_header__brand" alt="Nuit Debout"/></h1>';
	         				}
	         				else{
	         	   	            echo '<h1 class="site-name CommuneFont">'.get_bloginfo('name').'</h1>';
	         	   	            echo '<h2 class="site-description">'.get_bloginfo('description').'</h2>';

	         				}
  							//	echo 'Blog '.$blog_details->domain.' is called '.$blog_details->path.'.';
	          			}

	          			if(is_page() ){ ?>
	          				<h2>
	            				<?php the_title(); ?>
	          				</h2>
	          			<?php }
	          			else {

	          				if(is_rootsite()){
								echo '<div id="sentencerotate"></div>';
							}

	          				}

	          			// add 2 more buttons if ville template
	          			if(is_page_template('page-ville.php') ){ ?>
	          				<div class="ville-screen_btns">
								<?php
								if(get_field('chat_page_url')){
									echo '<a class="btn btn-primary btn-lg" href="'.get_field('chat_page_url').'">Aller sur le chat</a>';
								}
								?>
								<?php
								if( get_field('wiki_page_url') ){
								 	echo '<a class="btn btn-primary btn-lg" href="'.get_field('wiki_page_url').'">Aller sur le wiki</a>';
								}
								?>
							</div>
	          			<?php
	          			} ?>
        			</div>
  				</div>
	        </div>
		</div>
	<?php
	}
?>
