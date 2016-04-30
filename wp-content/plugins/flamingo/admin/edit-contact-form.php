<?php

// don't load directly
if ( ! defined( 'ABSPATH' ) )
	die( '-1' );

if ( ! empty( $post->id ) ) {
	$nonce_action = 'flamingo-update-contact_' . $post->id;
} else {
	$nonce_action = 'flamingo-add-contact';
}

?>
<div class="wrap columns-2">
<?php screen_icon(); ?>

<h1><?php echo esc_html( __( 'Edit Contact', 'flamingo' ) ); ?></h1>

<?php do_action( 'flamingo_admin_updated_message', $post ); ?>

<form name="editcontact" id="editcontact" method="post" action="">
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

<div id="titlediv">
<div id="titlewrap">
<?php if ( ! empty( $post->id ) ) : ?>
<input type="text" name="post_title" size="30" tabindex="1" value="<?php echo esc_attr( $post->email ); ?>" id="title" disabled="disabled" />
<?php else : ?>
<label class="hide-if-no-js" style="visibility:hidden" id="title-prompt-text" for="title"><?php echo esc_html( __( 'Enter email here', 'flamingo' ) ); ?></label>
<input type="text" name="post_title" size="30" tabindex="1" value="<?php echo esc_attr( $post->email ); ?>" id="title" autocomplete="off" />
<?php endif; ?>
</div>
</div>

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
