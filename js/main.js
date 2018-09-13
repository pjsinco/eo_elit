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


  /**
   * Limit characters in a comment
   *
   */
  function limitCharacters(evt) {
    var charLen = evt.target.value.length;

    if (charLen < charWarning) { return; }

    var charWarning = 15;
    var charLimit = 20; 
    var charsLeft = Math.max(charLimit - charLen, 0);
    var charsLeftStr = charsLeft + (charsLeft === 1 ? ' character' : ' characters');
    var validChars = evt.target.value.substr(0, charLimit);

    if (charLen > charWarning) {
      evt.target.classList.add('warning');
      if (! jQuery('#commentWarning').length) {
        jQuery('.comment-form-comment').append('<span id="commentWarning" class="comment-warning">You have <span>' + charsLeftStr + '</span> left</p>')
      } else {
        jQuery('#commentWarning span').text(charsLeftStr);
      }
    } else {
      evt.target.classList.remove('warning');
      jQuery('#commentWarning').remove();
    }

    if (charLen > charLimit) {
      evt.target.value = evt.target.value = validChars
    } 
  }

  jQuery('#comment').on('input', limitCharacters);
});
