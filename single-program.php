<?php
//* here the TITLE OF THE FILE matters, since WP will look up for a custom post name
//*     (the event section we created (cap 28 of udemy), it will search for: 'single-[name of the custom post]')


    get_header();
    while(have_posts()){
        the_post(); 
        
        //in this page its not necesary to pass arguments since it can use the default data
        pageBanner();
        ?>
        <!--
        this is what its using as default info:
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php //echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php //the_title(); ?></h1>
                <div class="page-banner__intro">
                    <p>DONT FORGET TO REPLACE ME LATER</p>
                </div>
            </div>  
        </div>
        -->

        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo(get_post_type_archive_link('program')); ?>">
                        <i class="fa fa-home" aria-hidden="true"></i> All programs
                    </a> 
                    <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>

            <?php

              $related_professors = new WP_Query(array(
                // the -1 "just gives all post that meet this conditions" (this was berfore the 2)
                'posts_per_page' => -1,
                'post_type' => 'professor',
                //order the data by the meta_key we extract
                'orderby' => 'title',
                'order' => 'ASC',
                // "a way to writte code in our query":
                //    "this is like write in our query: SELECT &meta_query === SELECT * FROM event WHERE event_date >= $today
                'meta_query' => array(
                  array(
                    'key' => 'related_program',
                    "compare" => 'LIKE',
                    'value' => '"'.get_the_ID().'"',
                  ),
                )
              ));

              if($related_professors->have_posts()){
                echo '<hr class="section-break" />';
                echo '<h2 class="headline headline--medium">'.get_the_title().' Professors</h2>';
                
                echo '<ul class="profesor-cards">';
                while($related_professors->have_posts()){
                    $related_professors->the_post(); ?>
                    <li class="professor-card__list-item">
                      <a class="professor-card" href="<?php the_permalink() ?>">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>"/>
                        <span class="professor-card__name"><?php the_title(); ?></span>
                      </a>
                    </li>
                <?php }
                echo '<ul>';
              }
              
              //* THIS function resets the global post object back to default url based query (BECAUSE EACH TIME WE RUN A QUERY, IT COULD BREAK,
              //*    SO ITS BETTER TO USE THIS FUNCTION IN BETWEEN TO QUERYS, SO THE SECONF QUERY DOESNT BREAK)
              wp_reset_postdata();

              //WP_Query its a class that wordpress provides to us and its a blueprint (?)
              //    "what data we want to query from the DB"
              $today = date('Ymd');
              $homePageEvents = new WP_Query(array(
                // the -1 "just gives all post that meet this conditions" (this was berfore the 2)
                'posts_per_page' => 2,
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
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                  ),
                  array(
                    'key' => 'related_program',
                    "compare" => 'LIKE',
                    'value' => '"'.get_the_ID().'"',
                  ),
                )
              ));

              if($homePageEvents->have_posts()){
                echo '<hr class="section-break" />';
                echo '<h2 class="headline headline--medium">Upcoming '.get_the_title().' events</h2>';
                
                while($homePageEvents->have_posts()){
                    $homePageEvents->the_post(); 

                    //this function
                    // params: the file direction, a nickname so WP looks for a file (EG: WP will look for a file called: "content-event")
                    get_template_part('template-parts/content-event');
                }

                    /*
                    <div class="event-summary">
                      <a class="event-summary__date t-center" href="#">
                         this function will return the value (always the 'get_' will do that) of our custom field 
                            dor reference of what a custom field its, watch ep 32, udemy WP, but in summary: 
                            its a plugin wich creates custom filds (like dates, imgs, etc) for our posts on WP
                        <span class="event-summary__month"><?php 
                          $eventDate = new DateTime(get_field('event_date'));
                          echo $eventDate->format('M');
                        ?></span>
                        <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
                      </a>
                      <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p><?php if(has_excerpt()){
                              echo get_the_excerpt();
                            }else{
                              echo wp_trim_words(get_the_content(), 18);
                            } ?><a href="<?php //the_permalink(); ?>" class="nu gray">Learn more</a></p>
                      </div>
                    </div>
                    */
              }
            ?>
        </div>
    <?php }
    get_footer();
?>