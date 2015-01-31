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

function elit_comment_link() {

  d(comments_open());
  if ( comments_open() ) {
    $comment_string = '<span class="meta__comment-link comment-link">';
    $comment_string .='<a href="#comments" class="comment-link__link">';
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


