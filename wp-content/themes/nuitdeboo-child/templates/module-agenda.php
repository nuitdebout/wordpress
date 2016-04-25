<section id="agenda" class="section">
    <h2 class="section__title">Agenda</h2>
    <div class="section__content text-center">
        <?php // $agenda_ID = get_field('homepage_agenda_ID', 'option'); ?>
        <p>Vous souhaitez compléter cet agenda, ajouter un évènement ?</p>
        <p>
           <a class="primary-button" title="agenda" href="https://openagenda.com/nuitdebout">Venez sur l'agenda participatif Nuit Debout</a>
        </p>
    </div>
</section>
<div class="row">
  <div class="col-md-3">
      <div class="cbpgcl cibulCalendar" data-oacl data-cbctl="27805494/8131954|fr" data-lang="fr" s></div>
      <div class="cbpgmp cibulMap hidden-sm hidden-xs" data-oamp data-cbctl="27805494/8131954" data-lang="fr" ></div>
  </div>
  <div class="col-md-9">
      <iframe style="width:100%;" frameborder="0" scrolling="no" allowtransparency="allowtransparency" class="cibulFrame cbpgbdy" data-oabdy src="//openagenda.com/agendas/27805494/embeds/8131954/events?oaq[from]=<?php echo date('Y-m-d') ?>&oaq[to]=<?php echo date('Y-m-d') ?>"></iframe>
  </div>
</div>
<script type="text/javascript" src="//openagenda.com/js/embed/cibulCalendarWidget.js"></script>
<script type="text/javascript" src="//openagenda.com/js/embed/cibulBodyWidget.js"></script>
<script type="text/javascript" src="//openagenda.com/js/embed/cibulMapWidget.js"></script>
