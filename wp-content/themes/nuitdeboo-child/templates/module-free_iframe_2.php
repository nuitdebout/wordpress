<?php if ( get_field('homepage_module_free_iframe_2', 'option') ) : ?>
    <?php
    $iframe = get_field('homepage_module_free_iframe_2', 'option');
    $iframe_height = get_field('homepage_module_free_iframe_2_height', 'option');
    ?>
    <div class="row">
      <iframe height="<?php echo $iframe_height; ?>" width="100%" src="<?php echo $iframe; ?>"></iframe>
    </div>
<?php endif; ?>