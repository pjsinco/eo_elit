<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package elit
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="comments__wrapper">
  
  <div id="comments" class="story__commments comments">
  
  	<?php if ( have_comments() ) : ?>
      <h2 class="comments__title">
        <span class="comments__count">
          <?php echo get_comments_number(); ?>
        </span> comments</h2>
  		</h2>
  
      <ol class="comments__list">
        <li id="comment-1" class="comment comment--first">
          <article class="comment__body">
            <footer class="comment__meta">
              <div class="comment__author">
                <h3 class="comment__author-name">Nullam Dapibus</h3>
              </div>
              <div class="comment__metadata"><a href="#comment-1">
                  <time datetime="2014-12-19T11:58:27+00:00">
                     
                    Dec. 19, 2014 at 11:58 a.m.
                  </time></a></div>
            </footer>
            <div class="comment__content">
              <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
              <p>Etiam porta sem malesuada magna mollis euismod. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
            </div>
            <div class="comment__reply"><a href="#" onclick="return addComment.moveForm( &quot;div-comment-1&quot;, &quot;1&quot;, &quot;respond&quot;, &quot;1&quot; )">Reply</a></div>
          </article>
        </li>
        <li id="comment-2" class="comment">
          <article class="comment__body">
            <footer class="comment__meta">
              <div class="comment__author">
                <h3 class="comment__author-name">Tellus Mollis Purus</h3>
              </div>
              <div class="comment__metadata"><a href="#comment-2">
                  <time datetime="2014-12-20T17:31:17+00:00">
                     
                    Dec. 20, 2014 at 5:31 p.m.
                  </time></a></div>
            </footer>
            <div class="comment__content">
              <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec ullamcorper nulla non metus auctor fringilla. Maecenas faucibus mollis interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur.</p>
              <p>
                Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Nullam quis risus eget urna mollis ornare vel eu leo. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas sed diam eget risus varius blandit sit amet non magna.
                
              </p>
            </div>
            <div class="comment__reply"><a href="#" onclick="return addComment.moveForm( &quot;div-comment-2&quot;, &quot;2&quot;, &quot;respond&quot;, &quot;2&quot; )">Reply</a></div>
          </article>
          <ol class="comments__list comment__children">
            <li id="comment-3" class="comment">
              <article class="comment__body">
                <footer class="comment__meta">
                  <div class="comment__author">
                    <h3 class="comment__author-name">Malesuada</h3>
                  </div>
                  <div class="comment__metadata"><a href="#comment-3">
                      <time datetime="2014-12-21T12:23:17+00:00">
                         
                        Dec. 21, 2014 at 12:23 p.m.
                      </time></a></div>
                </footer>
                <div class="comment__content">
                  <p>
                    Etiam porta sem malesuada magna mollis euismod. Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor.
                    
                  </p>
                </div>
                <div class="comment__reply"><a href="#" onclick="return addComment.moveForm( &quot;div-comment-3&quot;, &quot;3&quot;, &quot;respond&quot;, &quot;3&quot; )">Reply</a>
                  <article></article>
                </div>
              </article>
              <ol class="comments__list comment__children">
                <li id="comment-4" class="comment">
                  <article class="comment__body">
                    <footer class="comment__meta">
                      <div class="comment__author">
                        <h3 class="comment__author-name">Aenean Inceptos Parturient DolorAenean Inceptos Parturient Dolor Aenean Inceptos Parturient Dolor</h3>
                      </div>
                      <div class="comment__metadata"><a href="#comment-4">
                          <time datetime="2014-12-21T19:02:01+00:00">
                             
                            Dec. 21, 2014 at 7:02 p.m.
                          </time></a></div>
                    </footer>
                    <div class="comment__content">
                      <p>Donec id elit non mi porta gravida at eget metus. Sed posuere consectetur est at lobortis. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec id elit non mi porta gravida at eget metus.</p>
                      <p>Ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="comment__reply"><a href="#" onclick="return addComment.moveForm( &quot;div-comment-4&quot;, &quot;4&quot;, &quot;respond&quot;, &quot;4&quot; )">Reply</a>
                      <article></article>
                    </div>
                  </article>
                </li>
              </ol>
            </li>
          </ol>
        </li>
        <li id="comment-5" class="comment">
          <article class="comment__body">
            <footer class="comment__meta">
              <div class="comment__author">
                <h3 class="comment__author-name">pellentesque dolor</h3>
              </div>
              <div class="comment__metadata"><a href="#comment-5">
                  <time datetime="2014-12-23T05:52:17+00:00">
                     
                    Dec. 23, 2014 at 5:52 p.m.
                  </time></a></div>
            </footer>
            <div class="comment__content">
              <p>
                Tellus vehicula sit ligula.
                
              </p>
            </div>
            <div class="comment__reply"><a href="#" onclick="return addComment.moveForm( &quot;div-comment-5&quot;, &quot;5&quot;, &quot;respond&quot;, &quot;5&quot; )">Reply</a></div>
          </article>
        </li>
      </ol>
  
  		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
  		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
  			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'elit' ); ?></h1>
  			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'elit' ) ); ?></div>
  			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'elit' ) ); ?></div>
  		</nav><!-- #comment-nav-above -->
  		<?php endif; // check for comment navigation ?>
  
  		<ol class="comment-list">
  			<?php
  				wp_list_comments( array(
  					'style'      => 'ol',
  					'short_ping' => true,
  				) );
  			?>
  		</ol><!-- .comment-list -->
  
  		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
  		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
  			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'elit' ); ?></h1>
  			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'elit' ) ); ?></div>
  			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'elit' ) ); ?></div>
  		</nav><!-- #comment-nav-below -->
  		<?php endif; // check for comment navigation ?>
  
  	<?php endif; // have_comments() ?>
  
  	<?php
  		// If comments are closed and there are comments, let's leave a little note, shall we?
  		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
  	?>
  		<p class="no-comments"><?php _e( 'Comments are closed.', 'elit' ); ?></p>
  	<?php endif; ?>
  
  	<?php comment_form(); ?>
  
  </div><!-- #comments -->
</div><!-- #comments__wrapper -->

