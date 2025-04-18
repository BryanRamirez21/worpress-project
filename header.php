<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- in order to load style.css, it has to be out of this WP function, that controls the head section(?) -->
    <?php wp_head(); ?>
    <title>Document</title>
</head>
<body <?php echo(body_class()) ?>>
    <header class="site-header">
      <div class="container">
        <h1 class="school-logo-text float-left">
          <a href="<?php echo(site_url()) ?>"><strong>Fictional</strong> University</a>
        </h1>
        <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
        <div class="site-header__menu group">
          <nav class="main-navigation">
            <ul>
              <li <?php if(is_page('about-us') or wp_get_post_parent_id(get_the_ID())) echo 'class="current-menu-item"' ?>><a href="<?php echo(site_url('/about-us')) ?>">About Us</a></li>
              <li <?php if(get_post_type() == 'program') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link("program") ?>">Programs</a></li>
              <li <?php if(get_post_type() == 'event' OR is_page('past-events')) echo 'class="current-menu-item"'; ?>><a href="<?php echo get_post_type_archive_link('event') ?>">Events</a></li>
              <li><a href="#">Campuses</a></li>
              <li <?php if(get_post_type() == 'post') echo 'class="current-menu-item"'?>><a href="<?php echo(site_url('/blog')) ?>">Blog</a></li>
            </ul>
            <?php
              //this function will reference our functions -> register_nav_menu(), which created a custom menu from WP admin
              //wp_nav_menu(array(
              //  'theme_location' => 'header_menu_location'
              //)); 
            ?>
          </nav>
          <div class="site-header__util">
            <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
            <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
            <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
        </div>
      </div>
    </header>