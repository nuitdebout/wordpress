<?php if ( get_field('homepage_module_free_iframe_2', 'option') ) : ?>
    <?php
    $iframe = get_field('homepage_module_free_iframe_2', 'option');
    $iframe_height = get_field('homepage_module_free_iframe_2_height', 'option');
    ?>
    <div class="row">
      <iframe height="<?php echo $iframe_height; ?>" width="100%" src="<?php echo $iframe; ?>"></iframe>
    </div>
<?php endif; ?>

<!--

<div class="nd_tweet_feed"></div>
<div id="news" class="section">
  <div class="container">
    <h2 class="center nd_brand">Les dernières actus</h2>
    <div class="row">
      <div class="col s12 m4">
        <a href="" target="_blank">
          <div class="card small hoverable">
            <div class="card-image">
            </div>
            <div class="card-content">
              <p></p>
            </div>

          </div>
        </a>
      </div>
      <div class="col s12 m4">
        <a href="" target="_blank">
          <div class="card small hoverable">
            <div class="card-image">
            </div>
            <div class="card-content">
              <p></p>
            </div>

          </div>
        </a>
      </div>
      <div class="col s12 m4">
        <a href="" target="_blank">
          <div class="card small hoverable">
            <div class="card-image">
            </div>
            <div class="card-content">
              <p></p>
            </div>

          </div>
        </a>

      </div>
    </div>
    <div class="row">
      <div class="col s12 m4">
        <a href="" target="_blank">
          <div class="card small hoverable">
            <div class="card-image">
            </div>
            <div class="card-content">
              <p></p>
            </div>
          </div>
        </a>
      </div>
      <div class="col s12 m4">
        <a href="" target="_blank">
          <div class="card small hoverable">
            <div class="card-image">
            </div>
            <div class="card-content">
              <p></p>
            </div>

          </div>
        </a>
      </div>
      <div class="col s12 m4">
        <a href="" target="_blank">
          <div class="card small hoverable">
            <div class="card-image">
            </div>
            <div class="card-content">
              <p></p>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>
</div>
!-->