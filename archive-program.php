<?php
//* this is the page that powers up the event section, THATS WHY HERE THE NAME ITS ALSO IMPORTANT
//*     when this custom file does not exits, the custom section will be powered by file "program.php" OR "archive"
    

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All programs</h1>

        <div class="page-banner__intro">
          <p>There is something for everyone, look around</p>
        </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <ul class="link-list min-list">
        <?php
        while(have_posts()){
            the_post(); ?>

            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>            

        <?php }
        //pagination if we have more posts than the setted to show (settings -> reading -> blog pages at most):
        echo(paginate_links());
        ?>
    </ul>
  </div>

  <?php get_footer();
?>