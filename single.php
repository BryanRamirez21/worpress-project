<?php

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
                    <a class="metabox__blog-home-link" href="<?php echo(site_url('/blog')); ?>">
                        <i class="fa fa-home" aria-hidden="true"></i> Go gome
                    </a> 
                    <span class="metabox__main">Posted by: <?php echo(the_author_posts_link()); ?> on <?php echo(the_time('n.j.y')); ?> in <?php echo(get_the_category_list(', ')); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php }
    get_footer();
?>
