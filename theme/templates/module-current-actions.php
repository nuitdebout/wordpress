<?php use NuitDebout\Wordress\OpenAgenda; ?>
<?php if (OpenAgenda\has_featured_events()) : ?>

	<?php
	$featured_events = OpenAgenda\get_featured_events();
	$featured_events = array_map(function($event) {
		return [
			'text' => $event['firstTimeStart'] . ' - ' . current($event['title']),
			'url' => $event['canonicalUrl'],
		];
	}, $featured_events);
	?>

	<script>
	window.NuitDebout = window.NuitDebout || {};
	window.NuitDebout.featuredEvents = <?php echo json_encode($featured_events) ?>;
	</script>

	<?php $event = array_shift($featured_events); ?>

	<div class="current-actions">
	    <a id="current-actions" href="<?php echo $event['url'] ?>">
	        <span class="glyphicon glyphicon-play"></span>
	        <span>
	            <?php echo $event['text'] ?>
	        </span>
	    </a>
	</div>

<?php endif; ?>