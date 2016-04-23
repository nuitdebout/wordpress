<?php
/*
 * @toto Move out the template
*/
$page = get_field('homepage_manifesto', 'option');

$include = get_pages('include='.$page->ID);
if ( $include[0]->post_title ) {
    $content = apply_filters('the_content',$include[0]->post_content);
    $title = apply_filters('the_title',$include[0]->post_title);
} else {
    $content = 'Please go to admin > options > Manifesto and select the page you want to display (a page must be created before)';
    $title = '';
}
?>
<div id="manifesto" class="section">
    <h2 class="section__title"><?php echo $title; ?></h2>
    <div class="section__content">
        <?php echo $content; ?>
    </div>
    <div class="section__actions-container">
        <a class="btn btn-primary btn-lg" href="<?php echo get_field('homepage_manifesto_btn_url', 'option'); ?>">
            <?php echo get_field('homepage_manifesto_btn_text', 'option'); ?>
        </a>
    </div>
</div>
