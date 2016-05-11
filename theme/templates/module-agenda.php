<?php
use NuitDebout\Wordress\OpenAgenda;
?>
<section id="agenda" class="section agenda">
    <h2 class="section__title">Agenda</h2>
    <div class="section__content">

    	<div class="text-center">
	    	<p>
	    	Retrouvez les horaires de réunion des commissions, des AG, ainsi que les actions en cours.
	    	<br>
	    	<strong>Cet agenda est ouvert et collaboratif, tout le monde peut y contribuer.</strong>
	    	</p>
			<p><a href="https://openagenda.com/nuitdebout/addevent" target="_blank">
				<span class="glyphicon glyphicon-plus"></span> Ajouter un évènement
			</a></p>
		</div>

		<?php $dates = OpenAgenda\get_dates() ?>
		<?php $cities = OpenAgenda\get_cities() ?>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#agenda-nav" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
					<a class="navbar-brand" href="#">
						<?php echo $dates[0]->format('d/m').' - '.nd_get_revolutionary_date($dates[0]) ?> - <?php echo $cities[0] ?>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="agenda-nav">
      				<ul class="nav navbar-nav navbar-right">
      					<li class="dropdown">
          					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          						Changer la ville <span class="caret"></span>
          					</a>
          					<ul class="dropdown-menu nd-js-agenda-city-dropdown">
							<?php foreach ($cities as $city) : ?>
								<li>
									<a data-value="<?php echo $city ?>" href="#">
									<?php echo $city ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						</li>
      					<li class="dropdown">
          					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          						Changer la date <span class="caret"></span>
          					</a>
          					<ul class="dropdown-menu nd-js-agenda-date-dropdown">
								<?php foreach ($dates as $date) : ?>
									<li>
										<a data-value="<?php echo $date->format('Y-m-d') ?>" href="#">
										<?php echo $date->format('d/m').' - '.nd_get_revolutionary_date($date) ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
      				</ul>
      			</div>
			</div>
		</nav>

		<!-- <form class="agenda__form">

			<div class="row">
				<div class="col-md-6">
					<?php echo $dates[0]->format('d/m').' - '.nd_get_revolutionary_date($dates[0]) ?>
				</div>
				<div class="col-md-3">
		      		<div class="form-group">
						<label class="sr-only">Date</label>
						<div class="btn-group">
							<button type="button" class="btn btn-default">Changer la date</button>
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu nd-js-agenda-date-dropdown">
								<?php foreach ($dates as $date) : ?>
									<li>
										<a data-value="<?php echo $date->format('Y-m-d') ?>" href="#">
										<?php echo $date->format('d/m').' - '.nd_get_revolutionary_date($date) ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
				      	<label class="sr-only">Ville</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="btn-group">
						<button type="button" class="btn btn-default">Changer la ville</button>
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu nd-js-agenda-city-dropdown">
							<?php foreach ($cities as $city) : ?>
								<li>
									<a data-value="<?php echo $city ?>" href="#">
									<?php echo $city ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</form> -->

		<div class="agenda__events" id="accordion" role="tablist" aria-multiselectable="true">
  			<?php foreach (OpenAgenda\filter_by_city(OpenAgenda\get_events(), 'Paris') as $event) : ?>
  				<?php include locate_template('templates/module-oaevent.php') ?>
			<?php endforeach; ?>
		</div>

    </div>
</section>
