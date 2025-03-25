
<?php
    // get_header();

//* Depending on the page (the literal URL you visit) WP will use that info for the functions
//*     EG: if we visist a post URL, the function the_content(); will only display the content of the post
//*             but if we visist a page URL, the same function will only display the content of the page
    // while(have_posts()){   
      //  the_post(); //this function will fetch the 10 recent post 
        ?>
            <!-- once we clikc a link, the url will change, by this WP will see the link and only loop through the post that mathces
            <h2><a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a></h2>

            once we clikc a link, the url will change, by this WP will see the link and only loop through the post that mathces
             but also, itll try to seatch for a default file named "single.php" to redirect this click -->
            <?php //the_content(); ?>
        <?php
    // }


    // get_footer();
?>

<?php
  get_header(); 
  
  pageBanner(array(
    'title' => 'Welcome to the blog',
    'subtitle' => 'Keep up with the news',
  ));
  ?>

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