<div id="manifesto" class="row post">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="padded">
                    <?php
                    /*
                    module "manifesto"
                    */
                    $page = get_field('homepage_manifesto', 'option');

                    $include = get_pages('include='.$page->ID);
                    if ( $include[0]->post_title ) {
                        $content = apply_filters('the_content',$include[0]->post_content);
                        $title = apply_filters('the_title',$include[0]->post_title);
                        ?>
                        <h2 class="text-center"><?php echo $title; ?></h2>
                        <?php echo $content; ?>
                        <p class="text-center">
                            <a class="btn btn-primary btn-lg" href="<?php echo get_field('homepage_manifesto_btn_url', 'option'); ?>">
                                <?php echo get_field('homepage_manifesto_btn_text', 'option'); ?>
                            </a>
                        </p>
                    <?php
                    } else{
                        echo 'Please go to admin > options > Manifesto and select the page you want to display (a page must be created before)';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
