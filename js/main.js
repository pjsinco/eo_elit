jQuery(document).ready(function() {

  /**
   * nav.js
   */
  $('body').addClass('js');
  var $menu = $('#site-nav'), 
    $menulink = $('.nav__link--toggle');

  $menulink.click(function(evt) { 
    $menulink.toggleClass('active'); 
    $menu.toggleClass('active') ;
    return false;
    //evt.preventDefault();
  });




  /**
   * appendAround
   *
   */
  jQuery(".rover-don").appendAround();
  jQuery(".rover-peggy").appendAround();


});

