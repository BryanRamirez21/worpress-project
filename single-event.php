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
                    <a class="metabox__blog-home-link" href="<?php echo(get_post_type_archive_link('event')); ?>">
                        <i class="fa fa-home" aria-hidden="true"></i> Events home
                    </a> 
                    <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>

            <?php
                //"our advanced custom field plugins, gives us acces to this func
                $related_programs = get_field('related_program');

                if($related_programs){
                    echo '<hr class="section-break" />';
                    echo '<h2 class="headline headline--medium ">Related program(s)</h2>';
                    echo '<ul class="link-list min-list">';
                    foreach($related_programs as $program){ ?>
                        <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
                    <?php }
                    echo '</ul>';
                }
                
            ?>

        </div>
    <?php }
    get_footer();
?>