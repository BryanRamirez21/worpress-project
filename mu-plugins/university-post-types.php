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
        'show_in_rest' => true
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
        'show_in_rest' => true
    ));
}

    add_action('init', 'university_post_types');
?>