<?php
/*
 * @toto Move out the template
*/

?>
<div id="alternative-media" class="section section--gray">
    <h2 class="section__title">TvDebout</h2>
    <div class="container tvdebout-container">
	<div class="live hide-live">
		<h3>Live</h3>
		<video id="tvdebout" width="500" height="250" class="video-js vjs-default-skin" controls>
			  <source
	     src="http://tvdebout.zkp.fr/hls/repu.m3u8"
	     type="application/x-mpegURL" />
		</video>
	</div>
	<div class="replay">
		<h3>Replay</h3>
		<iframe width="500" height="250" src="https://www.youtube.com/embed/iVCxcieQJBs?list=PLlxYmhUBOogz2l-NHzxWQFGCpG2PmV7QO" frameborder="0" allowfullscreen></iframe>
	</div>
    </div>
</div>
