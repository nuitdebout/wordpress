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

		<form class="agenda__form">
			<div class="row">
	      		<div class="form-group col-md-6">
					<label class="sr-only">Date</label>
			      	<select class="form-control nd-js-agenda-date">
			     	<?php foreach (OpenAgenda\get_dates() as $date) : ?>
						<option value="<?php echo $date->format('Y-m-d') ?>"><?php echo nd_get_revolutionary_date($date) ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group col-md-6">
			      	<label class="sr-only">Ville</label>
			      	<select class="form-control nd-js-agenda-city">
			     	<?php foreach (OpenAgenda\get_cities() as $city) : ?>
						<option><?php echo $city ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
		</form>

		<div class="agenda__events" id="accordion" role="tablist" aria-multiselectable="true">
  			<?php foreach (OpenAgenda\filter_by_city(OpenAgenda\get_events(), 'Paris') as $event) : ?>
  				<?php include locate_template('templates/module-oaevent.php') ?>
			<?php endforeach; ?>
		</div>

    </div>
</section>
