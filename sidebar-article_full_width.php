<?php 

/**
 * The sidebar containing the article widget area.
 *
 * @package elit
 */
?>
        <div class="ad-container">
          <?php if ( !dynamic_sidebar( 'article-sidebar-ad-don' ) ); ?>
          <?php if ( !dynamic_sidebar( 'article-sidebar-ad-peggy' ) ); ?>
        </div>

        <div class="article-wrapper">
          
          <div class='widgets--article__wrapper--full-width'>
          <?php if ( !dynamic_sidebar( 'article-sidebar' ) ); ?>
          </div>
        </div>

