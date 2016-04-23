<section id="agenda" class="section">
    <h2 class="section__title">Agenda</h2>
    <div class="section__content">
        <?php $agenda_ID = get_field('homepage_agenda_ID', 'option'); ?>
        <p class="center">
            Vous souhaitez compléter cet agenda, ajouter un évènement ?
            <a href="https://openagenda.com/nuitdebout">Venez sur l'agenda participatif Nuit Debout.</a>
        </p>


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
    </div>
</div>
