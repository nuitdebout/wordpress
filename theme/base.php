<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

$main_container_class = 'container';

// @link http://codex.wordpress.org/Conditional_Tags
// Default homepage
if (is_front_page() && is_home()) {
	if (is_main_site()) {
		$main_container_class = 'container-fluid';
	}
// static homepage
} elseif (is_front_page()) {
	if (is_main_site()) {
		$main_container_class = 'container-fluid';
	}
// blog page
} elseif (is_home()) {

//everything else
} else {
	if (is_page_template('page-ville.php') || is_page_template('page-globaldebout.php')) {
		$main_container_class = 'container-fluid';
	}
}

?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part('templates/head'); ?>
	<body <?php body_class(); ?>>

		<?php
			do_action('get_header');
			get_template_part('templates/header');
		?>

		<?php if (!is_main_site() && is_front_page()) : ?>
			<?php dynamic_sidebar('homepage-banner') ?>
		<?php endif; ?>

		<div class="wrap <?php echo $main_container_class ?>" role="document">
			<div class="content row">
				<main class="main">
					<?php include Wrapper\template_path(); ?>
				</main><!-- /.main -->
				<?php if (Setup\display_sidebar()) : ?>
					<aside class="sidebar">
						<?php include Wrapper\sidebar_path(); ?>
					</aside><!-- /.sidebar -->
				<?php endif; ?>
			</div><!-- /.content -->
		</div><!-- /.wrap -->

		<?php
			do_action('get_footer');
			get_template_part('templates/footer');
			wp_footer();
		?>

		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>


		<script>
			window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
			ga('create','UA-75928661-1','auto');ga('send','pageview')
		</script>
		<script src="https://www.google-analytics.com/analytics.js" async defer></script>

		<!-- Piwik -->
		<script type="text/javascript">
			var _paq = _paq || [];
			_paq.push(['trackPageView']);
			_paq.push(['enableLinkTracking']);
			(function() {
				var u="//piwik.nuitdebout.fr/";
				_paq.push(['setTrackerUrl', u+'piwik.php']);
				_paq.push(['setSiteId', 4]);
				var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
				g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
			})();
		</script>
		<noscript><p><img src="//piwik.nuitdebout.fr/piwik.php?idsite=4" style="border:0;" alt="" /></p></noscript>
		<!-- End Piwik Code -->

	</body>
</html>
