<?php
//The name its important, after "page" itll base the next name to the slug name so WP know where archive its from

    get_header(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">Past events</h1>
            <div class="page-banner__intro">
                <p>Recap of past events</p>
            </div>
        </div>  
    </div>

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
      $past_events->the_post(); ?>

        <div class="event-summary">
              <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month"><?php 
                  $eventDate = new DateTime(get_field('event_date'));
                  echo $eventDate->format('M');
                ?></span>
                <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php echo(wp_trim_words(get_the_content(), 18)) ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
            </div>

    <?php }

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