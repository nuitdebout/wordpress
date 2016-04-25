<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) )
	die( '-1' );

if ( ! empty( $post->id ) ) {
	$nonce_action = 'flamingo-update-outbound_' . $post->id;
} else {
	$nonce_action = 'flamingo-add-outbound';
}

?>
<div class="wrap columns-2">
<?php screen_icon(); ?>

<h2><?php
	if ( 'new' == $action ) {
		echo esc_html( __( 'Compose a Message', 'flamingo' ) );
	} else {
		echo esc_html( __( 'Outbound Message', 'flamingo' ) );
	}
?></h2>

<?php do_action( 'flamingo_admin_updated_message', $post ); ?>

<form name="editoutbound" id="editoutbound" method="post" action="">
<?php
wp_nonce_field( $nonce_action );
wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
?>

<div id="poststuff" class="metabox-holder has-right-sidebar">
<div id="side-info-column" class="inner-sidebar">
<?php
do_meta_boxes( null, 'side', $post );
?>
</div><!-- #side-info-column -->

<div id="post-body">
<div id="post-body-content">

<table class="message-main-fields">
<tbody>

<tr class="message-to">
	<th><?php echo esc_html( __( 'To', 'flamingo' ) ); ?>:</th>
	<td><?php if ( $contact_tag ) : ?>
		<?php echo esc_html( $contact_tag->name ); ?>
		<input type="hidden" name="contact-tag-id" value="<?php echo absint( $contact_tag->term_id ); ?>" />
	<?php endif; ?></td>
</tr>

<tr class="message-from">
	<th><?php echo esc_html( __( 'From', 'flamingo' ) ); ?>:</th>
	<td><input type="text" name="from" class="large-text" value="" /></td>
</tr>

<tr class="message-subject">
	<th><?php echo esc_html( __( 'Subject', 'flamingo' ) ); ?>:</th>
	<td><input type="text" name="subject" class="large-text" value="" /></td>
</tr>

<tr class="message-body">
	<th><?php echo esc_html( __( 'Body', 'flamingo' ) ); ?>:</th>
	<td><textarea name="body" class="large-text" cols="50" rows="10"></textarea></td>
</tr>

</tbody>
</table>

<br class="clear" />

<?php
do_meta_boxes( null, 'normal', $post );
do_meta_boxes( null, 'advanced', $post );
?>
</div><!-- #post-body-content -->
</div><!-- #post-body -->

<input type="hidden" name="action" value="save" />
<?php if ( ! empty( $post->id ) ) : ?>
<input type="hidden" name="post" value="<?php echo (int) $post->id; ?>" />
<?php endif; ?>

</div><!-- #poststuff -->
</form>

</div><!-- .wrap -->