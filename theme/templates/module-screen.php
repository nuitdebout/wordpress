<div class="row homepagescreen">
  <?php if (is_main_site() && is_front_page()) : ?>
    <div id="live" class="banner-homepage">
      <div class="layer"></div>
      <div class="streamer-container">
        <div class="text streamer-info"></div>
        <i class="ic ic-play" aria-hidden="true"></i>
        <a href="periscope" class="replay streamer-info">
          Voir plus de vidéos
        </a>
      </div>
    </div>
  <?php else : ?>
    <div class="banner-homepage">
      <div class="text-center container">
        <div id="nuitdeboutdate"><?php echo nd_get_revolutionary_date(); ?></div>
        <div id="site_title">

          <?php if (is_home()) : ?>
            <h1 class="site-name CommuneFont"><?php echo get_bloginfo('name') ?></h1>
            <h2 class="site-description"><?php echo get_bloginfo('description') ?></h2>
          <?php elseif (is_page()) : ?>
            <h2 class="CommuneFont  CommuneFont-page_title"><?php echo get_the_title() ?></h2>
          <?php endif ?>

        </div>
      </div>
    </div>
  <?php endif ?>

</div>