<?php
	$inpage = '';
	if ( is_page()){
			$inpage = 'in_page';
	}
	if ( is_page() || get_field('homepage_screen', 'option') ) {

	if(is_home() || is_front_page() ){
		$bg_ = get_field('homepage_screen', 'option');
		$bg = $bg_['url'];
	} else{
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
	<div class="row homepagescreen <?php echo $inpage; ?>">
		<div class="banner-homepage"
			 style="background: url(<?= $bg ?>);
					background-size: cover !important;
					background-position: center center;
					background-repeat: no-repeat;">
			<div class="text-center container">
				<div id="nuitdeboutdate"><?php echo nd_get_revolutionary_date(); ?></div>
				<div id="site_title">
					<?php
					if (is_home()) {
						if (is_rootsite()) {
							echo '<h1><img src="'.get_stylesheet_directory_uri().'/assets/images/logowhite.svg" class="nd_header__brand" alt="Nuit Debout"/></h1>';
						} else {
							echo '<h1 class="site-name CommuneFont">'.get_bloginfo('name').'</h1>';
							echo '<h2 class="site-description">'.get_bloginfo('description').'</h2>';
						}
					}

					elseif (is_page()) {
						echo '<h2 class="CommuneFont  CommuneFont-page_title">'.get_the_title().'</h2>';

					}


					if (is_rootsite() && !is_page() ) {
						echo '<div id="sentencerotate"></div>';
					}

					if (is_page() && get_field('page_include_subtitle') ) {
						echo '<div class="subpage-title">'.get_field('page_include_subtitle').'</div>';
					}



					// add 2 more buttons if ville template
					if(is_page_template('page-ville.php') ){ ?>
						<div class="ville-screen_btns">
							<?php
							$chat_url = 'https://chat.nuitdebout.fr/';
							$wiki_url = 'https://wiki.nuitdebout.fr/';
							if(get_field('chat_page_url')){
								$chat_url =  get_field('chat_page_url');
							}
							if( get_field('wiki_page_url') ){
								$wiki_url =  get_field('wiki_page_url');
							}
							echo '<a class="primary-button space-right-btn" href="'.$wiki_url.'">Aller sur le wiki</a>';
							echo '<a class="primary-button " href="'.$chat_url.'">Aller sur le chat</a>';
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
