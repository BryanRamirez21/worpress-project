<?php
//* this is the page that powers up the event section, THATS WHY HERE THE NAME ITS ALSO IMPORTANT
//*     when this custom file does not exits, the custom section will be powered by file "archive.php"
    

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All events</h1>

        <div class="page-banner__intro">
          <p>See what's new</p>
        </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <?php
    while(have_posts()){
      the_post(); ?>

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
      echo(paginate_links());
    ?>

        <hr class="section-break" />
    <p>Looking for arecap of past events? <a href="<?php echo site_url('/past-events') ?>">Check out our past events page</a></p>
  </div>

  <?php get_footer();
?>