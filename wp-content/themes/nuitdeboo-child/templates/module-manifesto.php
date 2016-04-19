<div id="manifesto">
  <div class="container padded">
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
			<?php
			/*
			module "manifesto"
			*/
			// $page = get_page_by_title( 'Manifeste' );
			$page = get_field('homepage_manifesto', 'option');

			$include = get_pages('include='.$page->ID);
			if ( $include[0]->post_title ){
				$content = apply_filters('the_content',$include[0]->post_content);
				$title = apply_filters('the_title',$include[0]->post_title);
				?>
				<h2><?php echo $title; ?></h2>
				<?php echo $content; ?>
				 <button class="btn btn-primary btn-lg">
				 <a href="<?php echo get_field('homepage_manifesto_btn_url', 'option'); ?>">
				 	<?php echo get_field('homepage_manifesto_btn_text', 'option'); ?>
				 </a>
				 </button>
			<?php
			}
			else{
				echo 'Please go to admin > options > Manifesto and select the page you want to display (a page must be created before)';
			}
			?>
			</div>
		</div>
	</div>
</div>