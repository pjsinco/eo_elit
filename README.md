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
