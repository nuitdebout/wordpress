<?php while (have_posts()) : the_post();

if(get_field('page_include_screen') == 1){
	the_module('screen')
}
?>
<section class="section">
	<div class="section__content">
		<div class="post">
		 	<?php
				if(get_field('page_include_screen') == 0) {
					get_template_part('templates/page', 'header');
				}
				get_template_part('templates/content', 'page');
			?>
		</div>
	</div>
</section>
<?php endwhile; ?>
