<div id="agenda">
  <div class="container padded">
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
			<?php
			$page = get_field('homepage_agenda', 'option');

			$include = get_pages('include='.$page->ID);
			if ( $include[0]->post_title ){
				$content = apply_filters('the_content',$include[0]->post_content);
				$title = apply_filters('the_title',$include[0]->post_title);
				?>
				<h2><?php echo $title; ?></h2>
				<?php echo $content; ?>
			<?php
			}
			else{
				echo 'Please go to admin > options > agenda and select the page you want to display (a page must be created before)';
			}
			?>
			</div>
		</div>
	</div>
</div>