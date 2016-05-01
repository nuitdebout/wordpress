var periscopers = [
  'RemyBuisine',
  'utp114',
  'romain_leclerc',
  'floryanr',
  'virgile_r',
  'gascarpenter',
  'roadirsh',
  'groovision',
  'lalgeco',
  'julienbayou',
  'sebthenight',
  'klmp21',
  'mgef',
  'NuitDebout33' // Bordeaux
];

(function($) {

  var promises = periscopers.map(function(periscoper) {
    return $.getJSON('/wp-content/themes/nuitdeboo-child/lib/get_periscope_data.php?handle='+periscoper);
  });

  var percent = 100 / promises.length;
  var progress = 0;

  $.when.apply($, $.map(promises, function(p) {
    return p.then(null,
      function() {
        return $.Deferred().resolveWith(this, arguments);
      }).always(function() {
        console.log('DONE !!!')
        progress += percent;
        $('#periscope-wall .progress-bar')
          .css('width', progress+'%')
          .text(parseInt(progress, 10)+'%');
      });
  })).done(function() {

    $('#periscope-wall').empty();

    $.each(arguments, function(index, responseArgs) {

      if (responseArgs[1] === 'error')
        return;

      var data = responseArgs[0];

      var $wrapper = $('<div>').addClass('periscoper__wrapper')

      var $link = $('<a>')
        .attr('href', 'https://www.periscope.tv/'+data.user.username)
        .attr('target', '_blank');

      var $img = $('<img>')
        .addClass('img-responsive')
        .attr('src', data.user.profile_image_urls[0].ssl_url)
        .appendTo($link);

      var $onair = $('<a>')
        .addClass('periscope-on-air')
        .attr('data-size', 'large')
        .attr('href', 'https://www.periscope.tv/'+data.user.username)
        .text('@'+data.user.username);

      $wrapper
        .append($link)
        .append($onair)

      $('<div>')
        .addClass('col-xs-12')
        .addClass('col-sm-3')
        .append($wrapper)
        .appendTo($('#periscope-wall'));
    });
    twttr.widgets.load();
  });

})(jQuery);
