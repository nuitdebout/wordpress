<footer class="footer">

    <div class="footer__main">
        <div class="footer-section">
            <h5 class="footer-section__title">#NuitDebout</h5>
            <ul class="social-networks list-inline">
                <?php get_template_part('templates/module', 'social'); ?>
            </ul>

            <h5 class="footer-section__title">Contribuer</h5>
            <ul class="social-networks list-inline">
                <li>
                    <a title="wiki"  href="http://wiki.nuitdebout.fr" target="_blank" class="social-icons social-icons-bigger wiki">
                        <i alt="wiki nuitdebout" class="ic-wiki_rounded"></i>
                    </a>
                </li>
                <li>
                    <a title="github" href="https://github.com/nuitdebout/" target="_blank" class="social-icons social-icons-bigger github">
                        <i alt="github" class="ic-github_rounded"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="footer-section footer-section--link">
            <?php
            if (has_nav_menu('footer_navigation')) : ?>
            	<h5 class="footer-section__title">Liens</h5>
            <?php
            wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'list-unstyled']);
            endif;
            ?>
        </div>

        <div class="footer-section">
            <h5 class="footer-section__title">Voir aussi</h5>
            <a title="CONVERGENCE DES LUTTES" target="_blank" href="https://www.convergence-des-luttes.org/">
                <img alt="CONVERGENCE DES LUTTES" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/CONVERGENCE-DES-LUTTES.png"/>
            </a>
            <?php dynamic_sidebar('sidebar-footer'); ?>
        </div>

    </div>

    <div class="footer__extra-links">
        <?php
        if (has_nav_menu('footer_colophon_navigation')) :
            wp_nav_menu(['theme_location' => 'footer_colophon_navigation', 'menu_class' => 'list-unstyled']);

        else :
        	wp_list_pages();
        endif;
        ?>
    </div>
</footer>

