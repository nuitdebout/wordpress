<?php if ( get_field('homepage_module_free_iframe_2', 'option') ) : ?>
    <?php
    $iframe = get_field('homepage_module_free_iframe_2', 'option');
    $iframe_height = get_field('homepage_module_free_iframe_2_height', 'option');
    $iframe_id = '';
    $iframe_class = 'snapwidget-widget';
    ?>
    <div class="row iframe-module iframe-module--2">
        <iframe src="https://snapwidget.com/in/?h=bnVpdGRlYm91dHxpbnwxODB8OHwyfHx5ZXN8NXxmYWRlT3V0fG9uU3RhcnR8bm98eWVz&ve=060416"  height="<?php echo $iframe_height; ?>" class="<?php echo $iframe_class; ?>" allowTransparency="true" frameborder="0" scrolling="no" style="overflow:hidden;"></iframe>
    </div>
<?php endif; ?>
