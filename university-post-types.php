<?php
function university_post_types(){
    //Event post type:
    register_post_type('event', array(
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add new event',
            'edit_item' => 'Edit event',
            'all_items' => 'All events',
            'singular_item' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar',
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'events'
        ),
        'supports' => array('title', 'editor', 'excerpt'),
        //dont know about the line of above. this this one, its to display the option on the Gutenber ver of WP (it may not appear there only in the classic editor) 
    ));


    //program post type:
    register_post_type('program', array(
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add new programs',
            'edit_item' => 'Edit program',
            'all_items' => 'All programs',
            'singular_item' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards',
        'has_archive' => true,
        'rewrite' => array('slug' => 'programs'),
        'supports' => array('title', 'editor'),
    ));

    //professor post type:
    register_post_type('professor', array(
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add new professor',
            'edit_item' => 'Edit professor',
            'all_items' => 'All professors',
            'singular_item' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more',
        //we woint need archive since we want visitors to find professor trough functions and not links
        //'has_archive' => true,
        //'rewrite' => array('slug' => 'professors'),
        'supports' => array('title', 'editor', 'thumbnail'),
    ));


    //Campus post type:
    register_post_type('campus', array(
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Campus',
            'add_new_item' => 'Add new campus',
            'edit_item' => 'Edit campus',
            'all_items' => 'All campuses',
            'singular_item' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt',
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'campuses'
        ),
        'supports' => array('title', 'editor', 'excerpt'),
        //dont know about the line of above. this this one, its to display the option on the Gutenber ver of WP (it may not appear there only in the classic editor) 
    ));
}

    add_action('init', 'university_post_types');
?>