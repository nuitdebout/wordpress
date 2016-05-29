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

    event.stopPropagation();
    $(this).toggleClass('open');
  });

  $(document).click(function(event) {
    if(isIn(event.target, '.navbar-subnav')) {
      return;
    }
    $navbar.find('.menu-item-has-children.open').removeClass('open');
  });


});
