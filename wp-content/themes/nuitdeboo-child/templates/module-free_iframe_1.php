
<?php
	if ( get_field('homepage_module_free_iframe_1', 'option') ) {
		$iframe = get_field('homepage_module_free_iframe_1', 'option');
		$iframe_height = get_field('homepage_module_free_iframe_1_height', 'option');

		?>
		<div class="container iframe-container">
    		<div class="row">
				<div class="free_iframe">
					<div class="row">
						<div class="">
							<div class="iframe-container">
								<iframe style="" height="<?php echo $iframe_height; ?>" width="100%" src="<?php echo $iframe; ?>"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
?>