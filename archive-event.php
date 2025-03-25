<?php
//* this is the page that powers up the event section, THATS WHY HERE THE NAME ITS ALSO IMPORTANT
//*     when this custom file does not exits, the custom section will be powered by file "archive.php"
    

get_header(); 

pageBanner(array(
  'title' => 'All events',
  'subtitle' => 'See what is going o'
));
?>

  

  <div class="container container--narrow page-section">
    <?php
    while(have_posts()){
      the_post(); 
      
      //this function
      // params: the file direction, a nickname so WP looks for a file (EG: WP will look for a file called: "content-event")
      get_template_part('template-parts/content-event');
    }

      //pagination if we have more posts than the setted to show (settings -> reading -> blog pages at most):
      echo(paginate_links());
    ?>

        <hr class="section-break" />
    <p>Looking for arecap of past events? <a href="<?php echo site_url('/past-events') ?>">Check out our past events page</a></p>
  </div>

  <?php get_footer();
?>