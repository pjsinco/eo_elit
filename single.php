<?php get_header(); ?>

<?php get_template_part('sidebar', 'leaderboard'); ?>

    <div id="main" class="content">
      <section id="primary" class="content__primary">

        <?php while(have_posts()): the_post(); ?>


          <?php get_template_part('content', 'single'); ?>

          <?php 
            if ( comments_open() || get_comments_number() ):
              comments_template();
            endif;
          ?>

        <?php endwhile; ?>

      </section> <!-- #primary -->


<!--       temp; make into a sidebar template? -->
      <section id="secondary" class="content__secondary">
        <aside data-set="rover-don-parent" class="ad rover-don-parent-b"></aside>
        <aside data-set="rover-peggy-parent" class="ad rover-peggy-parent-b"></aside>

<!--         temp; make a widget? -->
        <aside class="widget widget--latest">
          <h2 class="widget__title">Latest stories</h2>
          <ul class="widget__list">
            <li class="widget__list-item"><span class="widget__feature"><img src="img/truvada160.jpg" width="80" height="107"></span><span class="widget__head"><a href="#" class="widget__link">What physicians need to know about the new drug to prevent HIV</a></span></li>
            <li class="widget__list-item"><span class="widget__feature"><img src="img/prison160.jpg" width="80" height="107"></span><span class="widget__head"><a href="#" class="widget__link">Correctional medicine is on the cutting edge of public health, DO says</a></span></li>
            <li class="widget__list-item"><span class="widget__feature"><img src="img/aguwa160.jpg" width="80" height="107"></span><span class="widget__head"><a href="#" class="widget__link">Hero Next Door: DO ‘pays it forward’ by mentoring hundreds of students</a></span></li>
            <li class="widget__list-item"><span class="widget__feature"><img src="img/hpv160.jpg" width="80" height="107"></span><span class="widget__head"><a href="#" class="widget__link">How to prescribe yoga for overuse injuries</a></span></li>
            <li class="widget__list-item"><span class="widget__feature"><img src="img/smith160.jpg" width="80" height="107"></span><span class="widget__head"><a href="#" class="widget__link">'This could happen to you': Lessons learned from explosion in West, Texas</a></span></li>
          </ul>
        </aside>

<!--         temp; make a widget? -->
        <aside class="widget widget--counter">
          <h2 class="widget__title">Popular</h2>
          <ol class="widget__list--counter">
            <li class="widget__list-item--counter"><a href="#" class="widget__link">New Year's resolutions: 10 life hacks to increase physician productivity</a></li>
            <li class="widget__list-item--counter"><a href="#" class="widget__link">'Grey's Anatomy' vs. real-life residency: You already know how this turns out</a></li>
            <li class="widget__list-item--counter"><a href="#" class="widget__link">Anesthesiology’s allure: High pay, flexibility, intellectual stimulation</a></li>
            <li class="widget__list-item--counter"><a href="#" class="widget__link">How I survived the first 2 years of medical school</a></li>
            <li class="widget__list-item--counter"><a href="#" class="widget__link">Making the cut: How to specialize in general surgery</a></li>
          </ol>
        </aside>
      </section>
    </div> <!-- #main -->

<?php get_footer(); ?>
