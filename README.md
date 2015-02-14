###Fri Jan 23 16:55:08 2015 CST
* [grunt + wp](http://archetyped.com/know/grunt-for-wordpress-plugins/?utm_content=buffer6a8d8&utm_medium=social&utm_source=twitter.com&utm_campaign=buffer)

* [register vs. enqueue a script](http://wpcandy.com/teaches/how-to-load-scripts-in-wordpress-themes/#.VMLZAmTF-lI)
    * Register all of them
    > The reason I register all of my scripts in this function is simple: it helps me keep track. Sure, I could just enqueue them all in this function with conditionals, but sometimes conditionals get confusing, and I like to take advantage of the ability to enqueue in templates, because it’s simple. I could also skip the register function for the scripts I enqueue right away, but again, I do it for organization. I register them there, together, so that I know what I’ve got and I know what I’m loading on every page versus in specific places. I also tend to make notes in comments by the register function to note where I’m enqueuing, if not immediately.

    ```php
    <?php
    /*
     * WordPress Sample function and action
     * for loading scripts in themes
     */
     
    // Let's hook in our function with the javascript files with the wp_enqueue_scripts hook 
    
    add_action( 'wp_enqueue_scripts', 'wpcandy_load_javascript_files' );
    
    // Register some javascript files, because we love javascript files. Enqueue a couple as well 
    
    function wpcandy_load_javascript_files() {
    
      wp_register_script( 'info-caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-5.5.0-packed.js', array('jquery'), '5.5.0', true );
      wp_register_script( 'info-carousel-instance', get_template_directory_uri() . '/js/info-carousel-instance.js', array('info-caroufredsel'), '1.0', true );
    
      wp_register_script( 'jquery.flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '1.7', true );
      wp_register_script( 'home-page-main-flex-slider', get_template_directory_uri().'/js/home-page-main-flex-slider.js', array('jquery.flexslider'), '1.0', true );
    
      wp_enqueue_script( 'info-carousel-instance' );
      
      if ( is_front_page() ) {
        wp_enqueue_script('home-page-main-flex-slider');
      }
    
    }
    ?>
    ```
* [the new script_loader_tag filter](http://wordpress.stackexchange.com/questions/38319/how-to-add-defer-defer-tag-in-plugin-javascripts/38335#38335)
    * [codex](https://developer.wordpress.org/reference/hooks/script_loader_tag/)
    * we can use it to add 'async' to our scripts

* [html5 boilerplate](https://github.com/h5bp/html5-boilerplate)

###Sat Jan 24 10:30:04 2015 CST
* [notes from a wpsession talk on theme customizer](https://github.com/pdclark/talk-wordpress-customizer)

* [vagrant + wp + vvv tutorial](http://www.sitepoint.com/wordpress-meets-vagrant-vvv/)

* [vvv](https://github.com/Varying-Vagrant-Vagrants/VVV)

* [how to create a separate page for blog posts](http://www.wpbeginner.com/wp-tutorials/how-to-create-a-separate-page-for-blog-posts-in-wordpress/)

###Sun Jan 25 09:17:51 2015 CST
* [make an svg sprite sheet with icomoon](http://blog.teamtreehouse.com/create-svg-sprite-sheet)

* should our make a row of stickers instead of mixing them in?

* [smashing mag on wp custom taxonomies](http://www.smashingmagazine.com/2012/01/04/create-custom-taxonomies-wordpress/)

* our potential custom taxonomies:
    * school
    * state (region?)
    * specialty

* Inside the AOA should probably be a separate wp install entirely, like insidetheaoa.osteopathic.org
    * that would be easier to maintain, it seems
    * our 'inside the aoa' listing on the front page could be an rss feed from the blog

* How do we create a taxonomy for a series?
    * maybe the taxonomy is hierarchical (has descendants), called 'series'

###Mon Jan 26 8:33:12 2015 CST

###Tue Jan 27 10:59:57 2015 CST
* [how to use jetpack's carousel without installing jetpack](http://www.wpbeginner.com/plugins/how-to-add-gallery-carousel-in-wordpress-without-jetpack/)

* set default sizes of media in media settings


###Wed Jan 28 11:23:42 2015 CST
* [conditionally load our js?](http://code.tutsplus.com/articles/quick-tip-conditional-javascript-and-css-enqueueing-on-front-end-pages--wp-25049)

* [conditionally load plugin scripts](http://customcreative.co.uk/conditionally-loading-plugin-scripts-in-wordpress/)

* [conditionally loading js with a shortcode](http://scribu.net/wordpress/conditional-script-loading-revisited.html)

* [wp popular posts widget](https://wordpress.org/plugins/wordpress-popular-posts/)
    * [other popularity plugins](http://www.wpbeginner.com/plugins/5-best-popular-posts-plugins-for-wordpress/)

* [smashing: WordPress Shortcodes: A Complete Guide](http://www.smashingmagazine.com/2012/05/01/wordpress-shortcodes-complete-guide/)

* [plugin for pulling in a post with a shortcode](https://wordpress.org/plugins/post-content-shortcodes/)
    * possibility for pulling in a sidebar
        * which could be a custom post type

* TODO we're going, i think, to need a shortcode to insert rover-don and rover-peggy into every post.

* [stackexchange: Prevent publishing the post before setting a featured image?](http://wordpress.stackexchange.com/questions/16372/prevent-publishing-the-post-before-setting-a-featured-image)

* [WordPress Shortcodes: 3 Essential Tips](http://premium.wpmudev.org/blog/wordpress-shortcodes/)

* [do_shortcode() on the codex](http://codex.wordpress.org/Function_Reference/do_shortcode)

* [10 Awesome Shortcodes For Your WordPress Blog](http://premium.wpmudev.org/blog/10-awesome-shortcodes-for-your-wordpress-blog/)
    * see the "Related Posts" shortcode!

###Thu Jan 29 08:59:37 2015 CST
* modules
    ```
    _social-pick-red.scss
    _eo-icons.scss
    _index.scss
    _section-title.scss
    _f-item.scss
    _nav.scss
    _section-title-hat.scss
    _social.scss
    _widget.scss
    ~~_site-branding.scss~~
    _super.scss
    _inside-the-aoa.scss
    _sticker.scss
    _size.scss
    _border.scss
    _module.scss
    _unit.scss
    _content.scss
    _row.scss
    _rover.scss
    _spotlight.scss
    _story-header.scss
    _btn.scss
    _comment-form.scss
    _cta.scss
    frm.scss
    ~~_ad.scss~~
    _f-item-old.scss
    _grid.scss
    _social-pick.scss
    _featured.scss
    _front.scss
    _comment-link.scss
    ~~_icons.scss~~
    _meta.scss
    _f-row.scss
    _play-hiya.scss
    _rail.scss
    _prev-next.scss
    _comment.scss
    _image.scss
    ~~_site-search.scss~~
    _comments.scss
    _story-footer.scss
    _story-nav.scss
    _topics.scss
    _pq.scss
    _story.scss
    _bio.scss
    _story-meta.scss
    _media.scss
    _caption.scss
    _grid-play.scss
    _top.scss
    _xnav.scss
    _xsite-branding.scss
    _xsite-search.scss
    _button.scss
    ```

* [possible way to programmatically add don and peggy inside the loop](https://wordpress.org/support/topic/php-and-javascript-with-google-adsense-code)

* TODO so we hardcoded our ehs script into sidebar-leaderboard.php. is there a better way to do it?
    * like maybe making the leaderboard a widget area and echoing the script with a filter?
        * or is it not that big of a deal to hard code this js snippet?

* [lines between text](http://css-tricks.com/fun-line-height/)
    * possible use in pull quotes

* [wordpress responsive images plugin](https://wordpress.org/plugins/ricg-responsive-images/)
    * [a post on css-tricks with an update about it](http://css-tricks.com/hassle-free-responsive-images-for-wordpress/)

* [9 Tips for WordPress Plugin Development](http://sixrevisions.com/wordpress/wordpress-plugin-development-tips/)

* [How To Optimize Images For WordPress, A Complete Guide](http://www.wpexplorer.com/optimize-images-wordpress-guide/)

* [support for ricg picturefill plugin](https://wordpress.org/support/plugin/ricg-responsive-images)

###Fri Jan 30 07:09:27 2015 CST
* installed kint debugger
      ```
      Dumping variables is easy:
      
      d($variable) will output a styled, collapsible container with your variable information
      dd($variable) will do exactly as d() except halt execution of the script
      s($variable) will output a simple, un-styled whitespace container
      sd($variable) will do exactly as s() except halt execution of the script
      Backtrace is also easy:
      
      Kint::trace() The displayed information for each step of the trace includes the source snippet, passed arguments and the object at the time of calling
      We've also baked in a few functions that are WordPress specific:
      
      dump_wp_query()
      dump_wp()
      dump_post()
      ```

* custom field: elit_kicker
    * for adding the kicker to the post

* [removed unusued custom fields](http://resources.kevinspence.org/remove-custom-fields-wordpress/)

* [How to Display WordPress Post Thumbnails with Captions](http://www.wpbeginner.com/wp-tutorials/how-to-display-wordpress-post-thumbnails-with-captions/)
    ```
    WordPress stores each image as its own post. So the Title of the 
    Image will be the title of the post, Caption will be the excerpt of 
    the post, and Description will be the content of the post.
    ```
    
    ```php
    // ex.
    <?php the_post_thumbnail();  
    echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
    ```

* [animating height](http://css3.bradshawenterprises.com/animating_height/)

###Sat Jan 31 06:53:09 2015 CST
* TODO AP-Styleify our dates

* [caption reveals on hover](http://www.hongkiat.com/blog/css3-image-captions/)

* 4 things a browser can animate cheaply [via html5rocks](http://www.html5rocks.com/en/tutorials/speed/high-performance-animations/)
    1. position
    2. scale
    3. rotation
    4. opacity

* TODO we have a problem with double downloads using the RICG Responsive Images plugin

###Sun Feb  1 05:21:36 2015 CST
* TODO our drop cap is not rendering correctly in firefox
    * [possible fix?](http://www.sitepoint.com/a-simple-css-drop-cap/)

* TODO social icon vertical list breaks up in firefox around 482px wide

* [ ideas for list shortcodes ](http://themes.mysitemyway.com/awake/shortcodes/fancy-lists-shortcodes/)

* [ good guide to creating and using custom post types](http://code.tutsplus.com/tutorials/a-guide-to-wordpress-custom-post-types-creation-display-and-meta-boxes--wp-27645)

###Mon Feb  2 07:47:24 2015 CST
* [smashing mag on meta boxes](http://www.smashingmagazine.com/2011/10/04/create-custom-post-meta-boxes-wordpress/)

* [User-friendly custom fields with Meta Boxes in WordPress](http://www.creativebloq.com/wordpress/user-friendly-custom-fields-meta-boxes-wordpress-5113004)

* [How to Create Custom WordPress Write/Meta Boxes](http://code.tutsplus.com/tutorials/how-to-create-custom-wordpress-writemeta-boxes--wp-20336)

* [remove post formats meta box](http://wordpress.stackexchange.com/questions/65653/how-do-i-remove-the-post-format-meta-box)

###Tue Feb  3 05:07:21 2015 CST
* [vvv and wp_mail()](http://www.allancollins.net/2014/06/12/wp_mail-sending-vvv-try/)

* [debugging in php](http://www.phpknowhow.com/basics/basic-debugging/)

* [set add'l fields in media uploader](http://www.wpbeginner.com/wp-tutorials/how-to-add-additional-fields-to-the-wordpress-media-uploader/)

* [smashing on definitive guide to wp hooks](http://www.smashingmagazine.com/2011/10/07/definitive-guide-wordpress-hooks/)

* [remove wp's hard-coded image width, height](http://wordpress.stackexchange.com/questions/22302/how-do-you-remove-hard-coded-thumbnail-image-dimensions)

###Wed Feb  4 10:09:37 2015 CST
* ~~TODO meta box for kicker~~

* TODO need credit at bottom of page for standalone feature images

* scaffolding for a meta box
    ```php
    /**
     * KICKER META BOX
     *
     */
    add_action( 'load-post.php' , 'elit_kicker_meta_box_setup' );
    add_action( 'load-post-new.php' , 'elit_kicker_meta_box_setup' );
    
    function elit_kicker_meta_box_setup() {
    
    }
    
    function elit_add_kicker_meta_box() {
      
    }
    
    function elit_kicker_meta_box( $object, $box ) {
      
    }
    
    function elit_save_kicker_meta( $post_id, $post ) {
      
    }
    
    /**
     * END KICKER META BOX
     */
    ```

* TODO refactor our meta box creations -- we're repeating tons of code!

###Thu Feb  5 09:24:18 2015 CST

* [daux.io documentation generator](https://github.com/justinwalsh/daux.io)

* [collapse metaboxes by default](http://wordpress.stackexchange.com/questions/4381/make-custom-metaboxes-collapse-by-default)

###Fri Feb  6 11:10:25 2015 CST
* [solution to admin-ajax not working?](http://docs.easydigitaldownloads.com/article/201-admin-ajax-blocked)

###Mon Feb  9 18:00:33 2015 CST

* sidebars
    * http://thedo.osteopathic.org/2014/04/msucom-unthsctcom-lead-do-schools-in-u-s-news-rankings/
    * http://thedo.osteopathic.org/2014/04/beyond-the-stethoscope-dos-students-excel-in-nonmedical-pursuits/ -- with photo
    * http://thedo.osteopathic.org/2014/05/caring-for-lgbt-patients-a-primer/
    * http://thedo.osteopathic.org/2014/05/history-essay-contest-students-interns-and-residents-can-win-up-to-5000/ -- 2 sidebars
    * http://thedo.osteopathic.org/2014/06/school-of-life-learning-from-my-patients-in-a-teaching-health-center/
    * http://thedo.osteopathic.org/2014/07/humble-leader-cleveland-clinic-ready-take-aoa-president/
    * http://thedo.osteopathic.org/2014/08/former-aoa-president-carlo-dimarco-remembered-leader-educator/
    * http://thedo.osteopathic.org/2014/10/primary-care-physicians-need-know-hpv-vaccine/

* authors
    * BY TIMOTHY BEALS, OMS IV	/ CONTRIBUTING WRITER
    * BY LINDSAY J. ERCOLE, OMS I	/ CONTRIBUTING WRITER
    * BY JEREMY BERGER, OMS II	/ CONTRIBUTING WRITER
    * BY CHRISTEN D. BRUMMETT, OMS II	/ CONTRIBUTING WRITER
    * BY JEFFREY Y. TSAI, OMS II	/ CONTRIBUTING WRITER
    * BY JOSHUA ALEXANDER, DO, MPH/ CONTRIBUTING WRITER
    * BY JANKI KAPADIA, OMS II, AND SAMEER R. SOOD, OMS II/ CONTRIBUTING WRITERS
    * AOA STAFF
    * THE DO STAFF

  

* related-style sidebars
    * http://elit.dev/2014/11/the-abcs-of-clinical-rotations-always-be-curious/
    * http://thedo.osteopathic.org/2014/10/love-game-team-physicians-highs-lows-craft/

* tricky
    * http://thedo.osteopathic.org/2014/07/qa-2014-grads-talk-specialties-policy-work-life-balance/

* video
    * http://thedo.osteopathic.org/2014/10/video-affordable-care-act-affected-practice/ -- embed video inside story
    * http://thedo.osteopathic.org/2014/09/tedmed/
    * http://thedo.osteopathic.org/2014/10/video-can-physicians-avoid-burnout/
    * http://thedo.osteopathic.org/2014/10/video-concerned-ebola/

###Tue Feb 10 04:57:32 2015 CST
* migration notes
    * make sure subheads are h2
    * prolly won't use all pullquotes
        * see if you can shorten the ones we do use
    * get used to squeezing the browser to check how things are falling
    * use only one category per story

* [Creating Custom Fields for Attachments in Wordpress] (http://net.tutsplus.com/tutorials/wordpress/creating-custom-fields-for-attachments-in-wordpress/)

###Wed Feb 11 06:00:27 2015 CST
* [Responsible Social Share Links](https://jonsuh.com/blog/social-share-links/)

* use wp get attachment url over https: -- see the codex filter ref for wp_get_attacment_url

###Thu Feb 12 06:37:19 2015 CST
* [How To Remove HTML Tags From WordPress Comment Form?](http://www.inkthemes.com/how-to-remove-html-tags-from-wordpress-comment-form/)

* [Adding Custom Fields to a Custom Post Type, the Right Way](http://blog.teamtreehouse.com/adding-custom-fields-to-a-custom-post-type-the-right-way)

* [how to include a plugin with a theme](http://wordpress.stackexchange.com/questions/160255/how-to-include-plugin-without-activation)

* [15 commandments of front-end perf](https://alexsexton.com/blog/2015/02/the-15-commandments-of-front-end-performance/)

###Fri Feb 13 06:37:10 2015 CST
* [Integrating With WordPress’ UI: Meta Boxes on Custom Pages](http://code.tutsplus.com/articles/integrating-with-wordpress-ui-meta-boxes-on-custom-pages--wp-26843)

* [remove yoast seo from custom post type](https://wordpress.org/support/topic/remove-seo-from-custom-post-types)

###Sat Feb 14 09:49:19 2015 CST
* [exclude sticky posts from wp_query](http://wordpress.stackexchange.com/questions/958/excluding-sticky-posts-from-the-loop-and-from-wp-query-in-wordpress)

* [smashing on loop hacks](http://www.smashingmagazine.com/2009/06/10/10-useful-wordpress-loop-hacks/)
