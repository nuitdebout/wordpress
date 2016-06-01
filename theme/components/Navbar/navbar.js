(function(componentId, factory) {

  // @todo fix : JQuery(document).ready is never called
  setTimeout(function() {
    jQuery.onComponentReady(componentId).then(function($component) {
      factory(jQuery, $component);
    });
  });

})('navbar', function($, $navbar) {

  function isIn(element, selector) {
    return (
      $(element).closest(selector).length ||
      $(element).is(selector)
    );
  }

  $navbar.find('.menu-item-has-children').click(function(event) {
    if(isIn(event.target, '.navbar-subnav')) {
      return;
    }
    var isOpen = $(this).is('.open');

    $('.menu-item.open').removeClass('open');
    if (! isOpen) {
      $(this).addClass('open');
    }

    event.stopPropagation();
  });

  $(document).click(function(event) {
    if(isIn(event.target, '.navbar-subnav')) {
      return;
    }
    $navbar.find('.menu-item-has-children.open').removeClass('open');
    $('.not-display-as-current').removeClass('not-display-as-current');
  });

  $('.menu-item:not(.current-menu-item)').mouseover(function() {
    $('.current-menu-item').addClass('not-display-as-current');
  });

  $('.menu-item').mouseout(function() {
    var open = $('.menu-item.open').length;
    if (open) {
      return;
    }

    $('.not-display-as-current').removeClass('not-display-as-current');
  });


  // side menu
  $('.menu-button').click(function() {
    $('#main-nav').addClass('open');
    $('.side-nav-overlay').removeClass('closed');
  });

  $('.side-nav-overlay').click(function() {
    $('#main-nav').removeClass('open');
    $('.side-nav-overlay').addClass('closed');
  });

});
