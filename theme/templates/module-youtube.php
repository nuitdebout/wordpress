<?php
use Roots\Sage\Assets;
?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="video-section">
				<div class="video-section__title">
					<a target="_blank" href="https://www.youtube.com/channel/UCRLZ1A3OweyAlESd89Ho7_A">
						<img src="<?php echo Assets\asset_path('images/tvdebout.jpg') ?>" width="80" height="80">
					</a>
					<h1>
						<a target="_blank" href="https://www.youtube.com/channel/UCRLZ1A3OweyAlESd89Ho7_A">#TVDebout</a>
					</h1>
				</div>
				<p>Tous les soirs, 3h30 d'émission de 19h30 à 23h.</p>
				<hr>
				<div class="live hide-live">
					<video id="tvdebout" width="500" height="250" class="video-js vjs-default-skin" controls>
						  <source
				     src="<?php echo get_bloginfo('url') ?>/tvdebout/repu.m3u8"
				     type="application/x-mpegURL" />
					</video>
				</div>
				<?php echo do_shortcode('[youtube_channel channel="UCRLZ1A3OweyAlESd89Ho7_A" num=6 responsive=true display="thumbnail" link_to="none"]'); ?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="video-section">
				<div class="video-section__title">
					<a target="_blank" href="https://www.youtube.com/channel/UCeC5h9Kdszz2ay8efD6qECA">
						<img src="<?php echo Assets\asset_path('images/streamdebout.jpg') ?>" width="80" height="80">
					</a>
					<h1>
						<a target="_blank" href="https://www.youtube.com/channel/UCeC5h9Kdszz2ay8efD6qECA">#StreamDebout</a>
					</h1>
				</div>
				<p>Chaque jour, les replays des streamers du mouvement.</p>
				<hr>
				<?php echo do_shortcode('[youtube_channel channel="UCeC5h9Kdszz2ay8efD6qECA" num=6 responsive=true display="thumbnail" link_to="none"]') ?>
			</div>
		</div>
	</div>
</div>
