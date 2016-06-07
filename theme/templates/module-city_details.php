<div class="panel panel-info">

  	<div class="panel-heading">
  		<h3 class="panel-title"><?php echo $city->name ?></h3>
  	</div>

  	<?php if (!empty($city->gathering_details)) : ?>
  	<div class="panel-body">
		<p><?php echo $city->gathering_details ?></p>
	</div>
	<?php endif; ?>

	<?php if ($city->hasCommissions()) : ?>
		<h4>Commissions</h4>
	  	<?php foreach ($city->commissions as $commission) : ?>
			<?php echo $commission->name ?>
		<?php endforeach; ?>
	<?php endif; ?>


	<ul class="list-group">

		<?php if (!empty($city->official_website)) : ?>
		<li class="list-group-item"><a href="<?php echo $city->official_website ?>" target="_blank"><strong>➞ Site web officiel</strong></a></li>
		<?php endif; ?>

		<?php if (!empty($city->wiki_url)) : ?>
		<li class="list-group-item">
			<i class="ic-wiki_rounded"></i> <a href="<?php echo $city->wiki_url ?>" target="_blank">Wiki NuitDebout</a>
		</li>
		<?php endif; ?>
		<?php if (!empty($city->chat_url)) : ?>
		<li class="list-group-item"><a href="<?php echo $city->chat_url ?>" target="_blank">Chat NuitDebout</a></li>
		<?php endif; ?>

		<?php if (!empty($city->facebook_url)) : ?>
		<li class="list-group-item">
			<i class="ic-facebook_rounded"></i> <a href="<?php echo $city->facebook_url ?>" target="_blank">Page Facebook</a>
		</li>
		<?php endif; ?>
		<?php if (!empty($city->twitter_url)) : ?>
		<li class="list-group-item">
			<i class="ic-twitter_rounded"></i> <a href="<?php echo $city->twitter_url ?>" target="_blank">Compte Twitter</a>
		</li>
		<?php endif; ?>

	</ul>

</div>
