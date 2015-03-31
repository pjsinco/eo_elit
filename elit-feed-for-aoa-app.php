<?php
header( 'Content-type: text/xml' );

$out = ob_get_contents();
$out = str_replace( array( "\n", "\r", "\t", " " ), "", $input );
ob_end_clean();

echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?>' . "\n"; ?>
<posts>
<?php while( have_posts() ) : the_post(); ?>
<?php $meta = get_post_meta( $post->ID ); ?>
<post>
<?php $author = get_post_meta( $post->ID, 'byline', true ); ?>
  <title><?php the_title_rss(); ?></title>
  <link><?php the_permalink_rss(); ?></link>
  <?php $category_list = get_the_category(); ?>
  <category><?php echo $category_list[0]->name; ?></category>
  <date>Posted <?php echo get_the_date('M. j, Y'); ?></date>
  <author>By <?php if ( $author == "" || $author == null ) { the_author(); } else { echo html_entity_decode( $author, ENT_COMPAT, 'UTF-8' ); } ?></author>
  <?php 
    $thumb_id = ( has_post_thumbnail() ? get_post_thumbnail_id() : $meta['elit_thumb'][0] ); 
    $thumb_url = wp_get_attachment_image_src( $thumb_id, 'elit-large' );
  ?>
  <photo><![CDATA[<?php echo $thumb_url[0]; ?>]]></photo>
  <?php 
    $caption = get_post( $thumb_id );
  ?>
		<caption><![CDATA[<?php echo $caption->post_excerpt ?>]]></caption>
		<text><![CDATA[<?php the_content(); ?>]]></text>

	</post>
<?php endwhile; ?>
</posts>
