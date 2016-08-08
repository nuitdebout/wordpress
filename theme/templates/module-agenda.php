<?php
use NuitDebout\Wordpress\OpenAgenda;
?>
<section id="agenda" class="agenda">
    <h2 class="agenda__title">Agenda</h2>
    <div class="agenda__content">

    	<div>
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
						<option value="<?php echo $date->format('Y-m-d') ?>"><?php echo $date->format('d/m').' - '.nd_get_revolutionary_date($date) ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group col-md-6">
			      	<label class="sr-only">Ville</label>
			      	<select class="form-control nd-js-agenda-city">
			     	<?php foreach (OpenAgenda\get_cities() as $city) : ?>
						<option <?php echo Openagenda\get_default_city() === $city ? 'selected="selected"' : '' ?>><?php echo $city ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
		</form>
	</div>

	<div class="agenda__events" id="accordion" role="tablist" aria-multiselectable="true">
		<?php
			$date = new \DateTime('now');
		?>
		<?php foreach (OpenAgenda\get_events_by_date($date) as $event) : ?>
			<?php include locate_template('templates/module-oaevent.php') ?>
		<?php endforeach; ?>
	</div>

</section>
