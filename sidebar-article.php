<?php 

/**
 * The sidebar containing the article widget area.
 *
 * @package elit
 */
?>

        <aside data-set="rover-don-parent" class="ad rover-don-parent-b"></aside>
        <aside data-set="rover-peggy-parent" class="ad rover-peggy-parent-b"></aside>

        <div class='widgets--article__wrapper'>
        <?php if ( !dynamic_sidebar('article-sidebar') ); ?>
        </div>

