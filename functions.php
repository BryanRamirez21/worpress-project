<?php
    function university_files(){
        //the 1st argument its nickname fot the css file, the 2nd ist location (snice in thsi case its the default css file, we can use a function to return it)
        //wp_enqueue_style('university_main_style', get_stylesheet_uri());

        //in order to load a script, JS wants to know as a 3 argument if this file needs/uses another file
        //      and also neesd a 4th argumnt, wich is the version(?)
        //      and even a 5th, wich is WP asking if we want to render the file AT THE END OF THE BODY TAG
        wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);

        wp_enqueue_style('custom-google-fonst', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('university_main_style', get_theme_file_uri('/build/style-index.css'));
        wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
    }


    // "the 1st argument its only the a name to reference we want to load a script file (JS or CSS), the 2nd its the name of the function we want to run"
    add_action('wp_enqueue_scripts', 'university_files');


    function university_features(){
        // this WP func will create a menu (like a <ul> <li>) out of the dashboard -> menu declared pages that we want to show
        // in the custom menu we declare here:  
        //      recive a name for a menu location (its just a nickname), 
        //      the second its the text that will show on the WP admin menu -> appareance
        //register_nav_menu('header_menu_location', 'Header Menu Location');
        //register_nav_menu('footer_menu_location1', 'Footer Menu Location 1');
        //register_nav_menu('footer_menu_location2', 'Footer Menu Location 2');
        
        add_theme_support('title-tag');
    }
    //we add an action every time we want WP to do some
    add_action('after_setup_theme', 'university_features');


    //* I ADDEDD A FUNCTION-ACTION ON C:\xampp\htdocs\wordpress\wp-content\mu-plugins
    //* whatch the video "28 custom types" to remember what a MU-pligin is, and why its 
    //      importante for things like, when we have a custom plugin that everyone must use for the site
    


    function university_adjust_queries($query){
        $today = date('Ymd');
        
        //! this query modify can even modify the dashboard, that why this IF
        if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
            //* all of this in ep 32-udemy
            // this query has a method call, it uses the name of the query parameter we want to change
            // and the second its the value we want to asign to it

            //      if we'd tried this, the pagination (that is also the "front-page": 
            //      $homepagePosts = new WP_query(array( 'posts_per_page' => 2,) or even in the dashboard
            //      itll affect the pagination display BUT ALSO ITLL AFFECT THE SAME ON THE DASHBOARD
            //$query->set('posts_per_page', 1);

            //* the query its the query called out by the function front-page": 
            //*      $homePageEvents = new WP_Query(array(...))
            $query->set('meta_key', 'event_date');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'ASC');
            $query->set('meta_query', array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric'
                )
              ));
        }
    }
    add_action('pre_get_posts', 'university_adjust_queries');
?>