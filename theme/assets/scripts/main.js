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

function target_blank_links() {
  jQuery('a[href*="https://wiki.nuitdebout.fr/wiki/Accueil"]').attr('target', '_blank');
  jQuery('a[href*="https://chat.nuitdebout.fr/home"]').attr('target', '_blank');
  jQuery('a[href*="http://questions.nuitdebout.fr/"]').attr('target', '_blank');
  jQuery('.foot-left a').attr('target', '_blank');
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


        target_blank_links();

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
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

})(jQuery); // Fully reference jQuery after this point.
