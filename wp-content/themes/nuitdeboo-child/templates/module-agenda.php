<div id="agenda">
  <div class="container ">
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
		  <h2>agenda</h2>
		  <?php
			// $page = get_field('homepage_agenda', 'option');
			    //if(if_home() ){
				$agenda_ID = get_field('homepage_agenda_ID', 'option');
			?>
			<p class="center">Vous souhaitez compléter cet agenda, ajouter un évènement ? <a href="https://openagenda.com/nuitdebout">Venez sur l'agenda participatif Nuit Debout.</a></p>
        </div>
    </div>
    <div class="row">

                <div class="cbpgmp cibulMap" data-oamp data-cbctl="27805494/8131954" data-lang="fr" ></div>
    </div>
    <div class="row">
            <div class="col-md-3 col-md-offset-2">
				<div class="cbpgcl cibulCalendar" data-oacl data-cbctl="27805494/8131954|fr" data-lang="fr" s></div>
			</div>
            <div class="col-md-6 col-md-offset-2">
      			<div class="agenda scroll">
					<iframe style="width:100%;" frameborder="0" scrolling="no" allowtransparency="allowtransparency" class="cibulFrame cbpgbdy" data-oabdy src="//openagenda.com/agendas/27805494/embeds/8131954/events"></iframe>
				</div>
			</div>
       	<script type="text/javascript" src="//openagenda.com/js/embed/cibulCalendarWidget.js"></script>
  		<script type="text/javascript" src="//openagenda.com/js/embed/cibulBodyWidget.js"></script>
 		<script type="text/javascript" src="//openagenda.com/js/embed/cibulMapWidget.js"></script>

    </div>
    <div class="row">

        <?php /*
			$include = get_pages('include='.$page->ID);
			if ( $include[0]->post_title ){
				$content = apply_filters('the_content',$include[0]->post_content);
				$title = apply_filters('the_title',$include[0]->post_title);
				?>

				<?php echo $content; ?>
			<?php
			}
			else{
				echo 'Please go to admin > options > agenda and select the page you want to display (a page must be created before)';
			}
			*/
		?>
	</div>
  </div>
</div>
