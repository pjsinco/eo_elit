<?php 
/**
 * Template for a front page row with 4 items 
 *
 * @package elit
 */
?>

<?php 

// $do_not_dupe is initialized on front-page.php;
// we fill it on front-primary.php
//d($do_not_dupe);
//$args = array(
  //'post_status' => 'publish',
  //'orderby' => 'date',
  //'post__not_in' => array( $do_not_dupe ),
  //'posts_per_page' => 3,
//);

?>
      <div class="row">
        <div class="size-1-of-1">
          <div class="section-title-hat"><span class="section-title-hat__text">More Stories</span> <a href="#" class="section-title__link"><span class="section-title--muted">All stories <span class="icon-arrow-right"></span></span></a>
          </div>
        </div>
      </div>

      <div class="row module">
        <div class="unit size-1-of-4 f-item">
          <article>
            <figure class="f-item__fig"><a href="#"><img src="img/students160.jpg" alt="students160" class="image__img"></a></figure>
            <div class="f-item__body">
              <h5 class="f-item__kicker">Women's History</h5><span class="f-item__date">Jan. 6, 2015</span>
              <h2 class="f-item__head"><a href="#" class="f-item__link">Hero Next Door: DO historian champions profession’s female-friendly past</a></h2>
              <p class="f-item__body-text">Educator Thomas Quinn, DO, wrote a book on women in osteopathic medicine that a Florida PBS station will convert to a documentary.</p>
            </div>
          </article>
        </div>
        <div class="unit size-1-of-4 f-item border-2-of-4">
          <article>
            <figure class="f-item__fig"><a href="#"><img src="img/inmem160.jpg" alt="aguwa160" class="image__img"></a></figure>
            <div class="f-item__body">
              <h5 class="f-item__kicker">Risus</h5><span class="f-item__date">Jan. 19, 2015</span>
              <h2 class="f-item__head"><a href="#" class="f-item__link">In Memoriam: Jan. 19, 2015</a></h2>
              <p class="f-item__body-text">View the names of recently deceased osteopathic physicians.</p>
            </div>
          </article>
        </div>
        <div class="unit size-1-of-4 f-item border border-3-of-4">
          <div class="sticker"><img src="img/dictation-color.svg" alt="Handheld dictation recorder" class="sticker__img">
            <div class="sticker__body">
              <h5 class="sticker__date">Posted Jan. 14, 2015</h5>
              <h2 class="sticker__head"><a href="#" class="sticker__link">Life hacks for physicians</a></h2>
              <p class="sticker__body-text"><a href="#" class="sticker__link">&ldquo;Using dictation software has been a big game-changer for me.&rdquo;</a></p>
              <p class="sticker__attrib">Robert T. Hasty, DO</p>
            </div>
          </div>
        </div>
        <div class="unit size-1-of-4 f-item border border-4-of-4">
          <article>
            <figure class="f-item__fig"><a href="#"><img src="img/sports160.jpg" alt="sports160" class="image__img"></a></figure>
            <div class="f-item__body">
              <h5 class="f-item__kicker">Venenatis Cras</h5><span class="f-item__date">Jan. 6, 2015</span>
              <h2 class="f-item__head"><a href="#" class="f-item__link">Prevent overuse injuries in child athletes: Info for family physicians</a></h2>
              <p class="f-item__body-text">Learn why overuse injuries are on the rise in children, what to watch for and when to refer patients to sports medicine physicians.</p>
            </div>
          </article>
        </div>
      </div>
