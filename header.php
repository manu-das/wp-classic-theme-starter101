<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?php echo get_bloginfo( 'name' ); ?></title> -->
    <?php wp_head();?> 
</head>
<body>
  

    
<!-- bootstrap nav walker dropdown depth 2 --> 
 <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
  <div class="container">
    <a class="navbar-brand" href="#">Brand logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
    <span>
    <!-- <span class="navbar-toggler-icon"> -->
        <img src="<?php bloginfo('template_url'); ?>\img\burger-list-menu-navigation-svgrepo-com.svg" width="20px" alt="">
    </span>
    </button>
    
        <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary-menu',
            'depth'             => 3,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav ms-auto',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
    </div>
</nav>

<!-- bootstrap nav dropdown depth 2 -->

