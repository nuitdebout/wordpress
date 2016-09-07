<div class="container">
<?php get_template_part('templates/page', 'header'); ?>
<div class="entry">
	<div class="entry-inner">


		<p class='resolutions'> Downloads:
		<?php
			$images = array();
			$image_sizes = get_intermediate_image_sizes();
			array_unshift( $image_sizes, 'full' );

			$c = '';
			foreach( $image_sizes as $image_size ) {

				$image = wp_get_attachment_image_src( get_the_ID(), $image_size );
				$name = $image_size . ' (' . $image[1] . 'x' . $image[2] . ')';
				$images[] = '<a href="' . $image[0] . '">' . $name . '</a>';

				if($image_size == 'thumbnail'){
					$c = $image[0];

				}
			}
			echo '<img src="'.$c.'" />';
			echo implode( ' | ', $images );



		?>

		</p>
		<?php get_template_part('templates/entry-taxonomies'); ?>

	</div>
	<div class="clear"></div>
</div><!--/.entry-->
</div>