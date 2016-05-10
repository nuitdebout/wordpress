<?php foreach ($options as $name => $option) : ?>
<p>
	<label for="<?php echo $this->get_field_name( $name ) ?>">
		<?php _e( $option['label'] ); ?>
	</label>

	<?php if (! $option['tag'] || $option['tag'] === 'input') : ?>
		<input 	class="widefat"
				id="<?php echo $this->get_field_id( $name ) ?>"
				name="<?php echo $this->get_field_name( $name ) ?>"
				type="<?php echo $option['type'] ? $option['type'] : 'text'; ?>"
				value="<?php echo esc_attr( $option['default'] ); ?>"
			/>
	<?php endif; ?>
</p>
<?php endforeach; ?>
