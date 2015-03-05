jQuery(document).ready(function() {

  /**
   * nav.js
   */
  $('body').addClass('js');
  var $menu = $('#site-nav'), 
    $menulink = $('.nav__link--toggle');

  // menu is hidden by default to keep from showing
  // during page load; so we need to make it seeable
  // after the page loads
  //$menu.css('display', 'block');

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

  /**
   * Social popups
   *
   * Help from:
   * https://jonsuh.com/blog/social-share-links/
   *
   */
  function windowPopup(url, width, height) {
    // Calculate the position of the popup 
    // so it's centered
    var left = (screen.left / 2) - (width / 2 ),
      top = (screen.top / 2) - (height / 2 );

    window.open(
      url,
      '',
      'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=' +
        width + ',height=' + height + ',top=' + top + ',left=' + left
    );
  }

  jQuery('#social-facebook, #social-twitter, #social-linkedin, #social-pinterest')
    .on('click', function(evt) {
      evt.preventDefault();
      windowPopup($(this).attr('href'), 500, 300);
    })


});

