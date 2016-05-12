<?php foreach ($options as $name => $option) : ?>
<p>
	<label for="<?php echo $this->get_field_name( $name ) ?>">
		<?php _e( $option['label'] ); ?>
	</label>

	<?php if (! $option['tag'] || $option['tag'] === 'input') : ?>
		<?php if ($option['type'] === 'checkbox') : ?>
			<input 	id="<?php echo $this->get_field_id( $name ) ?>"
					type="checkbox" value="true"
					<?php if($option['value']) : ?> checked="checked" <?php endif; ?>
					name="<?php echo $this->get_field_name( $name ) ?>"
				/>

		<?php else : ?>
			<input 	class="widefat"
					id="<?php echo $this->get_field_id( $name ) ?>"
					name="<?php echo $this->get_field_name( $name ) ?>"
					type="<?php echo $option['type'] ? $option['type'] : 'text'; ?>"
					value="<?php echo esc_attr( $option['value'] ); ?>"
				/>
		<?php endif; ?>
	<?php endif; ?>
</p>
<?php endforeach; ?>
