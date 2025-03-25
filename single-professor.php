<?php
//* here the TITLE OF THE FILE matters, since WP will look up for a custom post name
//*     (the event section we created (cap 28 of udemy), it will search for: 'single-[name of the custom post]')


    get_header();
    while(have_posts()){
        the_post(); 
        
        pageBanner();
        ?>
        
        <div class="container container--narrow page-section">
            
            <div class="generic-content">
                <div class="row group">
                    <div class="one-third">
                        <?php the_post_thumbnail('professorPortrait'); ?>
                    </div>

                    <div class="two-thirds">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php
                //"our advanced custom field plugins, gives us acces to this func
                $related_programs = get_field('related_program');

                if($related_programs){
                    echo '<hr class="section-break" />';
                    echo '<h2 class="headline headline--medium ">Subjects talk(s)</h2>';
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