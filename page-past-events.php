<?php
//The name its important, after "page" itll base the next name to the slug name so WP know where archive its from

    get_header(); 
    
    pageBanner(array(
      'title' => 'Past events',
      'subtitle' => 'Recap of past events'
    ));
    ?>

    <div class="container container--narrow page-section">
    <?php
    $today = date('Ymd');
    $past_events = new WP_Query(array(
        // the -1 "just gives all post that meet this conditions" (this was berfore the 2)
        'post_type' => 'event',
        // out of meta, get the key:
        'meta_key' => 'event_date',
        //order the data by the meta_key we extract
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        // "a way to writte code in our query":
        //    "this is like write in our query: SELECT &meta_query === SELECT * FROM event WHERE event_date >= $today
        'meta_query' => array(
            array(
            'key' => 'event_date',
            'compare' => '<',
            'value' => $today,
            'type' => 'numeric'
            )
            ),
        // wich page number of results should be on (in this case we get that number, extracting the prop "paged" out of the URL)
        'paged' => get_query_var('paged', 1)
    ));

    while($past_events->have_posts()){
      $past_events->the_post(); 
    
      //this function
      // params: the file direction, a nickname so WP looks for a file (EG: WP will look for a file called: "content-event")
      get_template_part('template-parts/content-event');
    }

      //pagination if we have more posts than the setted to show (settings -> reading -> blog pages at most):
      //ALSO, unless we specify a total, the paginate will be based on a default query, wich may be not useful 
      //    for what we are showing (?) (ep 36-udemy WP)
      //    EG: the total prop we specify, its the total of pagination itll display, if we use default WP query
      //    wont show a number, but in this case, we specify that the total will be only that our archives marked
        echo(paginate_links(array(
            'total' => $past_events->max_num_pages
        )));

    ?>
  </div>

  <?php get_footer();
?>