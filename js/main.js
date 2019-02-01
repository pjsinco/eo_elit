jQuery(document).ready(function() {

  /**
   * nav.js
   */
  
  // menu is hidden by default to keep from showing
  // during page load; so we need to make it seeable
  // after the page loads
  $('.nav').show();

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

  $(window).resize(function() {
    if (window.googletag) {
      window.googletag.pubads().refresh();
    }
  });

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

  if (window.location.href.indexOf('show_comment_policy=true') > -1) {
    vex.defaultOptions.className = "vex-theme-default";
    vex.dialog.alert({ 
      unsafeMessage: '<h3>Thank you for your comment!</h3>' +
                     'Please note that all comments are moderated. ' +
                     'Review may take up to two business days.' +
                     '<br><br>See the <a href="/comment-policy">' +
                     'comment policy</a> for details.',
      afterClose: function() {
        // Remove 'show_comment_policy' query string
        // https://www.quora.com/How-do-I-remove-a-specific-key-value-pair-in-
        //         a-query-string-without-reloading-using-JavaScript
        var href = window.location.href
        window.location.href = href.split('?')
          .map(function (url, i) {
            return !i ? url : url.split('&').filter(function(p) {
              return p.indexOf('show_comment_policy=') < 0;
            }).join('&');
          }).join('?');
      }
    });
  }
});
