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
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'elit' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);


//    <span class="story-meta__date">Wednesday, Dec. 14, 2014</span>
//    <span class="meta__comment-link comment-link">


  d($posted_on);

	echo '<span class="posted-on">' . $posted_on . '</span>';

}


