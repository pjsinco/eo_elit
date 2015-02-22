(function($) {

  $(document).ready(function() {

    var $category = $('#in-category-191'),
      $pin = $('#elit-pin-inside-the-aoa'),
      $pinChecked = $('#elit-pin-inside');

    if ( !$category.attr( 'checked' ) ) {
 
      // if 'Inside the AOA' isn't selected as a category,
      // hide the 'Pin' meta box right off the bat
      
      $pin.hide();
    }


    $category.change(function() {
      if ( $category.attr( 'checked' ) ) {
        $pin.show();
      } else {
        $pin.hide();
      }

    });

  });

})(jQuery);
