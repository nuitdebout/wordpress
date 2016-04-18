
<?php
	if ( get_field('homepage_module_free_iframe_2', 'option') ) {
		$iframe = get_field('homepage_module_free_iframe_2', 'option');
		?>
		<div class="free_iframe" >
			<div class="row">
				<div class="col-xs-12">
					<div class="iframe-container">
						<iframe style="" height="500px" width="100%" src="<?php echo $iframe; ?>"></iframe>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
?>