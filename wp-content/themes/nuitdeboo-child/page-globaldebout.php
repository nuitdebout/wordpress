<?php
/**
 * Template Name: page global debout
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_template_part('templates/module', 'screen');
?>
<div class="section">
    <div class="section__content">
        <?php while (have_posts()) : the_post(); endwhile; ?>
        <?php get_template_part('templates/content', 'page'); ?>

        <div class="share-btns">
            <div class="center-block">
                <div class="fb-share-button" data-layout="button_count">
                    <div class="wrap">
                        <a href="https://twitter.com/share"
                           class="twitter-share-button" data-via="globaldebout" data-hashtags="nuitdebout">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section section--gray">
    <h2 class="section__title">More Informations</h2>
    <div class="section__content">
        <ul class='list-unstyled'>
            <li><a href="http://twitter.com/GlobalDebout">twitter.com/GlobalDebout</a></li>
            <li><a href="https://www.facebook.com/events/254751298208004/">facebook.com/events/254751298208004/</a></li>
            <li><a href="mailto:intnuitdebout@riseup.net">intnuitdebout@riseup.net</a></li>
        </ul>
        <?php edit_post_link('edit', '<p>', '</p>'); ?>
    </div>
</section>

<?php
get_template_part('templates/module', 'global');
?>
