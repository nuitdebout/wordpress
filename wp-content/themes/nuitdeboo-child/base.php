<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <div class="container-fluid">
      <?php
        do_action('get_header');
        get_template_part('templates/header');
      ?>
      <?php include Wrapper\template_path(); ?>
    </div>
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
<!--
  	<script src="https://snapwidget.com/js/snapwidget.js"></script>
	<script type="text/javascript" id="gretaScript" src="https://cdn.greta.io/greta.min.js" data-ac="db56c2f2489199823062893e30e03720"></script>
	 <script>
	    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
	    ga('create','UA-75928661-1','auto');ga('send','pageview')
	</script>
	<script src="https://www.google-analytics.com/analytics.js" async defer></script>
 !-->

  </body>
</html>
