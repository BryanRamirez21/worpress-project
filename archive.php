<?php
  get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <!-- this function will return all the information of the archives, like the commented functions bellow -->
      <h1 class="page-banner__title"><?php the_archive_title() ?></h1>
        <?php 
          // the function is_category will return true if were on a category archive screen 
          //if(is_category()){
          //  echo "Post of the category: ";single_cat_title();
          //} 
          // the function is_author_archive will return true if were on a author archive screen 
          //if(is_author()){
          //  echo "Posts by: "; the_author();
          //}
        ?>

        <div class="page-banner__intro">
          <p><?php the_archive_description(); ?></p>
        </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <?php
    while(have_posts()){
      the_post(); ?>

      <div class="post-item">
        <h2 class="headline headline--medium headline--post-title"><a href="<?php echo(the_permalink()); ?>"><?php echo(the_title()); ?></a></h2>
        
        <div class="metabox">
          <p>Posted by: <?php echo(the_author_posts_link()); ?> on <?php echo(the_time('n.j.y')); ?> in <?php echo(get_the_category_list(', ')); ?></p>
        </div>
        
        <div class="generic-content">
          <?php the_excerpt(); ?>
          <p><a class="btn btn--blue" href="<?php echo(the_permalink()); ?>">Continue reading</a></p>
        </div>
      </div>

    <?php }

      //pagination if we have more posts than the setted to show (settings -> reading -> blog pages at most):
      echo(paginate_links());

    ?>
  </div>

  <?php get_footer();
?>