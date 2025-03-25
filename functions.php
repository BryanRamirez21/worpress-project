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

    //* THIS FUNCITON TELLS WORDPRESS WHAT SORT OF FEATURES WE WANT OUR THEME TO SUPPORT
    function university_features(){
        // this WP func will create a menu (like a <ul> <li>) out of the dashboard -> menu declared pages that we want to show
        // in the custom menu we declare here:  
        //      recive a name for a menu location (its just a nickname), 
        //      the second its the text that will show on the WP admin menu -> appareance
        //register_nav_menu('header_menu_location', 'Header Menu Location');
        //register_nav_menu('footer_menu_location1', 'Footer Menu Location 1');
        //register_nav_menu('footer_menu_location2', 'Footer Menu Location 2');
        
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        //params: nicname, pixels W, pixels H, want to crop img || wich part of the img to crop
        // we can use this custom sizes putting as an argument on the func "the_post_thumbnail_url()"
        //      the custom name of the img we gave it down here (check "single-professor.php" to see it)
        add_image_size('professorLandscape', 400, 260, true);
        add_image_size('professorPortrait', 480, 650, true);
        add_image_size('pageBanner', 1500, 350, true);
    }
    //we add an action every time we want WP to do some
    add_action('after_setup_theme', 'university_features');


    //* I ADDEDD A FUNCTION-ACTION ON C:\xampp\htdocs\wordpress\wp-content\mu-plugins
    //* whatch the video "28 custom types" to remember what a MU-pligin is, and why its 
    //      importante for things like, when we have a custom plugin that everyone must use for the site
    


    function university_adjust_queries($query){
        $today = date('Ymd');
        
        //validation to know if user its on "program" page
        if(!is_admin() AND is_post_type_archive('program') AND is_main_query()){
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', -1);
        }

        //validation to know if user its on "events" main page
        //! this query modify can even modify the dashboard, that why this IF
        if(!is_admin() AND is_post_type_archive('event') AND is_main_query()){
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



    // function to set the page banner, title and subtitle on each "single-{page}" (ref: ep 45 - 46 udemy WP)
    function pageBanner($data = NULL){
        if(!isset($data['title'])){
            $data['title'] = get_the_title();
        }
        if(!isset($data['subtitle'])){
            // WP function to get the custom field value (in this case, the CF called: )
            $data['subtitle'] = get_field('page_banner_subtitle');
        }
        if(!isset($data['photo'])){
            //check if theres an img uploaded into the CF 
            if(get_field('page_image_background_image') AND !is_archive() AND !is_home() ){
                $data['photo'] = get_field('page_image_background_image')['sizes']['pageBanner'];
            }else{
                //function to point to out theme folder 
                $data['photo'] = get_theme_file_uri('/images/ocean.jpg');
            }
        }


        ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo $data['photo'] ?>);"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php echo $data['title']; ?></h1>
                <div class="page-banner__intro">
                    <p><?php echo $data['subtitle']; ?></p>
                </div>
            </div>  
        </div>        
    <?php }
?>