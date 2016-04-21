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
						$bg = 'https://raw.githubusercontent.com/nuitdebout/nuitdebout.github.io/master/img/headertest.jpg';

			}
		}
		?>
		<div class="row homepagescreen">
 			<div class="banner-homepage" style="
              background: url(<?= $bg ?>);
              background-size: cover !important;
              background-position: center bottom;
              background-repeat: no-repeat;">
    			<div class="text-center container">
      				<div id="nuitdeboutdate"></div>
        			<div id="site_title">
         					  <?php if(is_home() ){ ?>
                    <h1>
            					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logowhite.svg" class="nd_header__brand" alt="Nuit Debout"/>
          				 </h1>
          				<?php }  ?>
                  <?php if(is_page() ){ ?>
          					<h2>
            						<?php the_title(); ?>
          					</h2>

          				<?php } else {  ?>
						<div id="sentencerotate"></div>
          				<?php } ?>

					<?php if(is_page_template('page-ville.php') ){ ?>
          					<div class="ville-screen_btns">
            						   		<?php
            						   			if(get_field('chat_page_url')){ ?>
            						   				<a class="btn btn-primary btn-lg" href="<?php echo  get_field('chat_page_url'); ?>">Aller sur le chat</a>

            						   			<?php }
            						   		?>
            						   		<?php
            						   			if( get_field('wiki_page_url') ){ ?>
            						   				<a class="btn btn-primary btn-lg" href="<?php echo  get_field('wiki_page_url'); ?>">Aller sur le wiki</a>

            						   			<?php }
            						   		?>


          					</div>

          				<?php }  ?>

        			</div>
  				</div>
	    </div>
		</div>
		<?php
	}
?>
