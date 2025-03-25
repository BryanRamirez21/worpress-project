<?php

  get_header();

  while(have_posts()) {
    the_post(); 
    
    pageBanner();
    ?>

  <div class="container container--narrow page-section">

    <?php 
        $theParent = wp_get_post_parent_id(get_the_ID());
        $findChildof = 0;

        //this validation works, because although returns the id of the parent page on every page
        // the point its, that it does, every time a page has a parent ID, the if will get that as
        // a true, cause the if works like "!EMPTY()"
        if($theParent){ ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo(get_permalink($theParent)); ?>">
                        <i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo(get_the_title($theParent)); ?>
                    </a> 
                    <span class="metabox__main"><?php echo(the_title()); ?></span>
                </p>
            </div>
        <?php }
    ?>
    
    <?php 
    $testArr = get_pages(array(
        'child_of' => get_the_ID()
    ));
    if($theParent || $testArr){ ?>
    <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo(get_permalink($theParent)); ?>"><?php echo(get_the_title($theParent)); ?></a></h2>
        <ul class="min-list">
            <?php
            if($theParent){
                $findChildof = $theParent;
            }else{
                $findChildof = get_the_ID();
            }
                wp_list_pages(array(
                    'title_li' => NULL,
                    'child_of' => $findChildof,
                    //this part of sort, will take the reference of the order setted on the control panel -> sidebar
                    // 'sort_menu' =>  'menu_order
                ));
            ?>
        </ul>
    </div>
    <?php } ?>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>
    
  <?php }

  get_footer();

?>
