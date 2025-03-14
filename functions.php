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
?>