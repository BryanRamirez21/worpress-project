<?php
//* this is the page that powers up the event section, THATS WHY HERE THE NAME ITS ALSO IMPORTANT
//*     when this custom file does not exits, the custom section will be powered by file "program.php" OR "archive"
    

get_header(); 

pageBanner(array(
  'title' => 'All programs',
  'subtitle' => 'There is something to do around'
));
?>

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