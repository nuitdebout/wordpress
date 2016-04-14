<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

	

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<?php
						/* 
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						 ) );
						 */
					?>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
					<?php
						
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
						
					?>
			<?php endif; ?>

			
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					// do_action( 'twentysixteen_credits' );
				?>
				<!--
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?></a>
				!-->

 <footer class="page-footer">
        <div class="container">
          <div class="row" >


			  <div class="col s6">
              <h5>#NuitDebout</h5>
                  <div class="social-networks social-networks--footer">
              		<?php if ( has_nav_menu( 'social' ) ){ 
						
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
						
					} else { ?>
 					<a href="https://www.facebook.com/NuitDebout/" target="_blank" class="social-icons facebook">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_fb_light.svg" />
                    </a>
                    <a href="https://twitter.com/nuitdebout" target="_blank" class="social-icons twitter ">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_twitter_light.svg" />
                    </a>
                    <a href="https://www.periscope.tv/RemyBuisine" target="_blank" class="social-icons periscope ">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_periscope.svg" />
                    </a>

                     <a href="https://github.com/nuitdebout/nuitdebout.github.io" target="_blank" class="social-icons github  ">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_github_light.svg" />
                    </a>

					<?php	} ?>
					    </div>

            </div>
			

			

           
                  
            

            <div class="col s6">
              <h5>Voir aussi</h5>
              <a target="_blank" href="https://www.convergence-des-luttes.org/">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/CONVERGENCE-DES-LUTTES.png"/>
              </a>
            </div>

          </div>
        </div>
      </footer>

    <script>
      window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
      ga('create','UA-75928661-1','auto');ga('send','pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
<?php wp_footer(); ?>
</body>
</html>