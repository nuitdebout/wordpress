/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

function rotate(sentences, element) {
  function print() {
    var counter = Math.floor(Math.random()*sentences.length);
    element.children().fadeOut().remove();
    element
        .children()
        .fadeOut()
        .remove();
    element
        .append(jQuery('<span>' + sentences[counter] + '</span>').fadeIn());
  }
  print();
  setInterval(print, 10000);
}

function nuitdebout_getDate(element) {
    var days  = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    // from https://git.framasoft.org/corpsmoderne/nuitdebout_today.git
    var startDate = new Date("march 31 2016");
    var day = 1000*60*60*24;
    var today =  Date.now();
    var jd =    new Date();
    var j = jd.getDay();
    var delta = today-startDate;
    var delta_days = delta/day;
    var d = Math.floor(delta_days) + 31;
    element.append(days[j-1] +' '+d+' mars');
    return d;
}

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        // quote rotation
        rotate([
            "Nos rêves ne rentrent pas dans vos urnes",
            "Nous ne rentrerons pas chez nous",
            "Le jour : à bout, la nuit : debout",
            "Partout en Europe, levons-nous !",
            "Ils pourront couper les fleurs, ils n'arrêteront pas le printemps",
            "Ne plus perdre sa vie à la gagner",
            "C'est un grand printemps qui se lève",
            "Je reviendrai et serai des millions",
            "Que nul n'entre ici s'il n'est révolté"
        ], jQuery('#sentencerotate'));
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {

        // agenda
        var $city = $('.nd-js-agenda-city');
        var $date = $('.nd-js-agenda-date');

        var loading = function() {
          $('#accordion').css('opacity', 0.5);
        };
        var refresh = function(response) {
          $('#accordion').html(response);
          $('#accordion').css('opacity', 1);
        };

        // JavaScript to be fired on the home page
        $city.on('change', function() {
          var data = {
            'action': 'openagenda',
            'city': $(this).val(),
            'date': $date.val()
          };
          loading();
          $.get(WP.ajaxURL, data).then(refresh);
        });
        $date.on('change', function() {
          var data = {
            'action': 'openagenda',
            'city': $city.val(),
            'date': $(this).val()
          };
          loading();
          $.get(WP.ajaxURL, data).then(refresh);
        });

        // Display loading text
        $('#live .text').text('Nous recherchons les derniers lives sur Periscope…');

        // Live tv
        $.getJSON(WP.ajaxURL, {action: 'homepage_twitter_periscope'})
        .done(function (data) {

          if (data && data.statuses && data.statuses.length)
          {


            var embedLiveStreamer = function (liveStreamer) {

              $('#live .text').text( liveStreamer.text );
              $('#live').addClass('active');

              $('#live .ic-play').on('click', function (){

                $('#live').html('');

                $('<iframe />');  // Create an iframe element
                $('<iframe />', {
                    src: liveStreamer.entities.urls[0].expanded_url
                }).appendTo('#live');

              });

            };

            // reject unsuccessfull streamer
            var lastResortStreamerIndex = 0;

            var checkIfLive = function (index) {

              var token = data.statuses[index].entities.urls[0].expanded_url.split('/').pop();

              $.getJSON(WP.ajaxURL, {action: 'homepage_periscope_check', token: token})
              .always(function (resp) {

                if ((!resp || resp.success === false) && data.statuses[index+1])
                {
                  lastResortStreamerIndex = index + 1;
                }

                if (resp && resp.success !== false && resp.type !== 'StreamTypeReplay')
                {

                  embedLiveStreamer(data.statuses[index]);

                }
                else
                {

                  if (data.statuses[index+1])
                  {
                    checkIfLive(index+1);
                  }
                  else
                  {
                    embedLiveStreamer(data.statuses[lastResortStreamerIndex]);
                  }

                }

              });
            };

            checkIfLive(0);

          }

        });

        // featured events

        var bannerIndex = 0;
        var featuredEvents = window.NuitDebout.featuredEvents;

        var loadCurrentActions = function () {
          $('#current-actions')
            .fadeOut('slow', function() {
              $(this).attr('href', featuredEvents[bannerIndex].url);
              $(this).find('span:last-child').text(featuredEvents[bannerIndex].text);
              $(this).fadeIn();
            });

          if (++bannerIndex >= featuredEvents.length) {
            bannerIndex = 0;
          }

          setTimeout(loadCurrentActions, 3000);
        };

        if (featuredEvents.length > 1)
        {
          setTimeout(loadCurrentActions, 3000);
        }
        else
        {
          // only one action dont fade out / in
          $('#current-actions').attr('href', featuredEvents[0].url);
          $('#current-actions').find('span:last-child').text(featuredEvents[0].text);
        }



      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);


  $('[data-toggle="class"]').click(function(event) {
    var element = $(this);
    var target = $(element.data('target'));
    var classes = element.data('class') || 'toggled';

    target.toggleClass(classes);
    event.stopPropagation();
    event.preventDefault();
  });

  $(document).click(function(event) {
    if( !$(event.target).closest('[data-remove-class-on-outside]').length &&
        !$(event.target).is('[data-remove-class-on-outside]')) {

      var element = $('[data-remove-class-on-outside]');
      var classes = element.data('remove-class-on-outside');
      element.removeClass(classes);
    }
  });

})(jQuery); // Fully reference jQuery after this point.
