<a class="news-card news-card--animated" href="<?php echo $link ?>"
   style="background-image: url('<?php echo $image ?>')">
	<img src="<?php echo $image ?>" class="news-card__thumb wp-post-image" alt="<?php echo $title ?>" />
	<div class="news-card__caption">
		<h4 class="news-card__title"><?php echo $title ?></h4>
		<p class="news-card__content"><?php echo $content; ?></p>
		<small class="news-card__source"><?php echo $source ?></small>
	</div>
	<p class="news-card__content-animated"><?php echo $content; ?></p>
</a>
