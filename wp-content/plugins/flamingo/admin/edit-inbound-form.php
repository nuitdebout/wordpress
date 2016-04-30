<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) )
	die( '-1' );

if ( ! empty( $post->id ) ) {
	$nonce_action = 'flamingo-update-inbound_' . $post->id;
} else {
	$nonce_action = 'flamingo-add-inbound';
}

?>
<div class="wrap columns-2">
<?php screen_icon(); ?>

<h1><?php echo esc_html( __( 'Inbound Message', 'flamingo' ) ); ?></h1>

<?php do_action( 'flamingo_admin_updated_message', $post ); ?>

<form name="editinbound" id="editinbound" method="post" action="">
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

<tr class="message-date">
	<th><?php echo esc_html( __( 'Date', 'flamingo' ) ); ?>:</th>
	<td><?php echo esc_html( $post->date ); ?></td>
</tr>

<tr class="message-subject">
	<th><?php echo esc_html( __( 'Subject', 'flamingo' ) ); ?>:</th>
	<td><?php echo esc_html( $post->subject ); ?></td>
</tr>

<tr class="message-from">
	<th><?php echo esc_html( __( 'From', 'flamingo' ) ); ?>:</th>
	<td><?php if ( ! empty( $post->from_email ) ) { ?><a href="<?php echo admin_url( 'admin.php?page=flamingo&s=' . urlencode( $post->from_email ) ); ?>" title="<?php echo esc_attr( $post->from ); ?>"><?php echo esc_html( $post->from ); ?></a><?php } else { echo esc_html( $post->from ); } ?></td>
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

<?php if ( $post->id ) : ?>
<input type="hidden" name="action" value="save" />
<input type="hidden" name="post" value="<?php echo (int) $post->id; ?>" />
<?php else: ?>
<input type="hidden" name="action" value="add" />
<?php endif; ?>

</div><!-- #poststuff -->
</form>

</div><!-- .wrap -->
