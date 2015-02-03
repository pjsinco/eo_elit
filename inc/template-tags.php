<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package elit
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function elit_byline() {
	$byline = '<span class="story-meta__by">By</span>';
	$byline .= '<span class="story-meta__author"> ';
  $byline .= '<a class="story-meta__link" href="' . 
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">';
  $byline .= esc_html( get_the_author() );
  $byline .= '</a></span>';
  
  echo $byline;
}

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

function elit_comments_link() {
  if ( comments_open() ) {
    $comment_string = '<span class="meta__comment-link comment-link">';
    //$comment_string .='<a href="' . get_comments_link() . '" ';
    $comment_string .='<a href="#comments" ';
    $comment_string .= 'class="comment-link__link">';
    $comment_string .='<span class="icon-comment">';
    $comment_string .='<span class="text-replace">Comments</span>';
    $comment_string .='</span>';
    $comment_string .='<span class="comment-link__body">%s</span>';
    $comment_string .='</a></span>';

    $num_comments = get_comments_number();

    if ( $num_comments == 0 ) {
      $comment_label = '+';
    } else {
      $comment_label = (string)$num_comments;
    }

    $comment_string = sprintf($comment_string, $comment_label);

    echo $comment_string;
  }
}

function elit_story_footer() {

  // #1 let's get our social icons
  get_template_part('social');


  // #2 set up jump-to-comments
  $comment_jump_before  = '<div class="story-footer__jump-link"><a href="#comments">';
  $comment_jump_before .= '<span class="story-nav__emph">' ;
  $comment_jump_after = '</span>';
  $comment_jump_after = '<span class="icon-arrow-down"></span></a></div>';
  
  echo $comment_jump_before;
  comments_number( 'Leave a comment ', '1 comment ', '% comments ');
  echo $comment_jump_after;

  
  // #3 list our story tags
  $before = '<div class="story-nav__title">Topics: ';
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
        $about .= '<img class="story-footer__img" ';
        $about .= 'src="' . wp_get_attachment_url( $author_photo_id ) . '" ';
        $about .= 'alt = "' . $author_photo_content->post_excerpt . '" '  ;
        $about .= ' width="' . wp_get_attachment_image_src($author_photo_id)[1] . '" />';
      }
    }
    
    $about .= '<div class="story-footer__body">';
    $about .= $author_bio;
    $about .= '</div></div>';

    echo $about;
  }

  
              //<div class="story-nav__more-in">More in <a href="#" class="story-nav__emph">Patient Care <span class="icon-arrow-right"></span></a></div>
              //<div class="prev-next">
                //<div class="prev-next__next"><a href="#" class="prev-next__title">Newer <span class="icon-arrow-right space-to-left"></span></a><a href="#" class="prev-next__link">New Year’s resolutions: 10 life hacks to increase physician productivity </a></div>
                //<div class="prev-next__prev"><a href="#" class="prev-next__title"><span class="icon-arrow-left space-to-right"></span> Older</a><a href="#" class="prev-next__link">In Memoriam: Dec. 4, 2014</a></div>
              //</div>
  
}
