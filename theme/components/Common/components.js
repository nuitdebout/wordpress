(function($) {
  $.onComponentReady = onComponentReady;

  function onComponentReady(componentId) {
    return new Promise(function(success, error) {

      // @todo fix never called
      //$(document).ready(function() {
      var $component = $('.js-component-' + componentId);

      if (!$component.length) {
        return error();
      }

      success($component);
      //});
    });
  }

})(jQuery);
