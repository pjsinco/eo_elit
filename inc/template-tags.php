<?php
/**
 * Custom template tags!
 *
 * @package elit
 */

/**
 * Prints the byline for a story.
 */
function elit_byline() {
?>
	<span class="story-meta__by">By</span>
	  <span class="story-meta__author"> 
      <a class="story-meta__link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
        <?php echo esc_html( get_the_author() ); ?>
      </a>
    </span>
<?php 
}

/**
 * Prints the posted-on date; includes meta data about last-updated.
 *
 */
function elit_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('l, M. j, Y') ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date('l, M. j, Y') )
	);

	echo '<span class="story-meta__date">' . $time_string . '</span>';
}

/**
 * Prints the comments link. Intended to use at the top of a story.
 *
 */
function elit_comments_link() {
  if ( comments_open() ) {
?> 
    <span class="meta__comment-link comment-link">
      <a href="#comments" class="comment-link__link">
        <span class="icon-comment">
          <span class="text-replace">Comments</span>
        </span>
        <span class="comment-link__body">
        <?php 
          $num_comments = get_comments_number();
          echo ($num_comments == 0) ? '+' : $num_comments;
        ?>
        </span>
      </a>
    </span>
  <?php 
  }
}

/**
 * Prints the footer of a story
 *
 * @param boolean $with_social Optional. Include the social icons.
 */
function elit_story_footer($with_social = true) {

  // #1 let's get our social icons
  if ( $with_social ) {
    get_template_part( 'social' );
  }

  // #2 set up jump-to-comments
  ?>
  <div class="story-footer__jump-link">
    <a href="#comments">
      <span class="story-nav__emph"></span>
        <?php comments_number( 'Leave a comment ', '1 comment ', '% comments '); ?>
      <span class="icon-arrow-down"></span>
    </a>
  </div>

  
  <?php   
  // #3 list our story tags
  $before = '<div class="story-nav__title">Topics ';
  $before .= '<ul class="topics"><li class="topics__topic">';
  $sep = '</li><li class="topics__topic">';
  $after = '</li><ul></div>';

  $tags_list = get_the_tag_list( $before, $sep, $after);

  if ( $tags_list ) {
    printf('<div class="story-nav">%1$s</div>', $tags_list);
  }

  // #4 output our about-the-author if we have the info
  $author_bio = get_post_meta( get_the_id(), 'elit_bio', true );
  if ( $author_bio ) {
    $about  = '<div class="story-footer__section">';
    $about .= '<div class="story-footer__title">About the author</div>';

    // get the id of the author's photo
    $author_photo_id = get_post_meta( get_the_id(), 'elit_author_photo_id', true );

    // if we have an author photo id ...
    if ( $author_photo_id ) {
      $author_photo_src = wp_get_attachment_url( $author_photo_id );

      // ... and it's valid
      if ($author_photo_src) {
        $author_photo_content = get_post( $author_photo_id );
        $width = wp_get_attachment_image_src($author_photo_id);
        $about .= '<img class="story-footer__img" ';
        $about .= 'src="' . wp_get_attachment_url( $author_photo_id ) . '" ';
        $about .= 'alt = "' . $author_photo_content->post_excerpt . '" '  ;
        $about .= ' width="' . $width[1] . '" />';
      }
    }
    
    $about .= '<div class="story-footer__body">';
    $about .= $author_bio;
    $about .= '</div></div>';

    echo $about;
  }

  $credit = get_post_meta( get_the_id(), 'elit_standalone_credit', true );
  if ( $credit ) {

    $credit_line  = '<div class="story-footer__section">';
    $credit_line .= '<div class="story-footer__title">Credit</div>';
    $credit_line .= '<div class="story-footer__body">';
    $credit_line .= $credit;
    $credit_line .= '</div></div>';

    echo $credit_line;
  }

  
  $story_nav  = '<div class="story-nav__more-in">More in ';
  $story_nav .= '<a href="%1$s" class="story-nav__emph">%2$s&nbsp;';
  $story_nav .= '<span class="icon-arrow-right"></span></a></div>';
  $story_nav = sprintf( $story_nav, 
    '#', // todo temp value
    'Patient Care' // todo temp value
  );

  //echo $story_nav;


  $next_post = get_next_post(false, 'inside-the-aoa');
  if ( $next_post ) {
    $next  = '<li class="prev-next__next">';
    //$next .= '<a href="%1$s" class="prev-next__title">Newer ';
    $next .= '<span class="prev-next__title">Newer</span>';
    //$next .= '<span class="icon-arrow-right space-to-left"></span>';
    $next .= '<a href="%2$s" class="prev-next__link">%3$s </a></li>';
    $next  = sprintf( $next,
      get_permalink( $next_post->ID ),
      get_permalink( $next_post->ID ),
      $next_post->post_title
    );
  } else {
    $next = '';
  }

  $prev_post = get_previous_post(false, 'inside-the-aoa');
  if ( $prev_post ) {
    $prev  = '<li class="prev-next__prev">';
    //$prev .= '<a href="%1$s" class="prev-next__title">';
    $prev .= '<span class="prev-next__title">Older</span>';
    //$prev .= '<span class="icon-arrow-left space-to-right"></span>Older ';
    $prev .= '<a href="%2$s" class="prev-next__link">%3$s </a></li>';
    $prev  = sprintf( $prev,
      get_permalink( $prev_post->ID ),
      get_permalink( $prev_post->ID ),
      $prev_post->post_title
    );
  } else {
    $prev = '';
  }

  if ( $prev || $next ) {
    echo '<ul class="prev-next">';
    if ( $next ) {
      echo $next;
    } 
    if ( $prev ) {
      echo $prev;
    }
  echo '</ul>';
  }

}

/**
 * Marks up each comment just the way we like.
 *
 * Used as a callback by wp_list_comments()
 * 
 * help http://themeshaper.com/2012/11/04/
 *    the-wordpress-theme-comments-template/
 */
function elit_comment( $comment, $args, $depth ) {
  d($comment);
  d($args);
  d($depth);
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback':
    case 'trackback':
  ?>
    <li class="post pingback">
      <p>
        Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( '(Edit)' ); ?>

  <?php  
    
      break;
    default:
  ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment__body">
        <footer class="comment__meta">
          <div class="comment__author">
            <h3 class="comment__author-name"><?php echo $comment->comment_author; ?></h3>
            </h3>
          </div>
          <?php if ( $comment->comment_approved == '0' ): ?>
            <em>Your comment is awaiting moderation.</em><br />
          <?php endif; ?>
          <div class="comment__metadata">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
              <time datetime="<?php comment_time( 'c' ); ?>" pubdate>
                <?php printf( '%1$s at %2$s', get_comment_date( ' M. j, Y, ' ), get_comment_time() ); ?>   
              </time>
            </a>
            <?php edit_comment_link( '(Edit)', '<span class="comment__edit">', '</span>' ); ?>
          </div> <!-- comment__metadata -->
        </footer> <!-- comment__meta -->

        <div class="comment__content">
          <?php comment_text(); ?>
        </div>

        <div class="comment__reply">
          <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
      </article>





  <?php 
  endswitch;


  
}

