<?php if ( get_field('homepage_module_free_iframe_1', 'option') ) : ?>
    <?php
        $iframe = get_field('homepage_module_free_iframe_1', 'option');
        $iframe_height = get_field('homepage_module_free_iframe_1_height', 'option');
        $iframe_id = 'radio';
        $iframe_class = '';
        // get_field('homepage_module_free_iframe_1_height', 'option');

    ?>

    <div class="row iframe-module iframe-module--1">
        <iframe id="<?php echo $iframe_id; ?>" height="<?php echo $iframe_height; ?>"  src="<?php echo $iframe; ?>"></iframe>
    </div>

<?php endif; ?>
