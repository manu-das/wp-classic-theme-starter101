<?php




function load_css(){
    
    wp_register_style( 'bootstap','https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' );
 
    wp_enqueue_style('bootstap');
    
    wp_register_style( 'BT_icon','https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css' );
 
    wp_enqueue_style('BT_icon');

    wp_register_style('owlslider','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );
 
    wp_enqueue_style('owlslider');

    wp_register_style('AOS-ani','https://unpkg.com/aos@2.3.1/dist/aos.css' );
 
    wp_enqueue_style('AOS-ani');

    wp_register_style('custom-css', get_template_directory_uri() . '/css/style.css', array(), false, 'all');
   
    wp_enqueue_style('custom-css');
    
}

add_action('wp_enqueue_scripts', 'load_css');



// load js -------------------------

function load_js(){

    wp_register_script('bootjs','https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', null, null, true );
    wp_register_script('jq','https://code.jquery.com/jquery-3.3.1.min.js', null, null, true );
    wp_register_script('owljs','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', null, null, true );
	wp_register_script('popper','https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', null, null, true );
	wp_register_script('AOS','https://unpkg.com/aos@2.3.1/dist/aos.js', null, null, true );
	wp_register_script('custom-js', get_template_directory_uri() . '/js/main.js', null, null, true );

    wp_enqueue_script('bootjs');
    wp_enqueue_script('jq');
	wp_enqueue_script('owljs');
    wp_enqueue_script('AOS');
	wp_enqueue_script('popper');
    wp_enqueue_script('custom-js');
    }
   
    add_action('wp_enqueue_scripts', 'load_js');


// -------------------------- Theme supports for---------------------------------------//
    // Thumbnail support
    add_theme_support('post-thumbnails');
    // specific thumbnail size
    add_image_size( 'tour-pack-size', 300, 340, true ); // Name, width, height, hard crop (true/false)
    add_theme_support('menus');
    //   menu register
    register_nav_menus(

        array(
            'primary-menu' => 'Top Menu',
        ) 
    );

// nav walker register

/**
 * Register Custom Navigation Walker (BT 5 support added )
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}
// end of menu and bootstrap nav walker 

// register widgets
function my_theme_register_widgets() {
    // register_widget( 'My_Custom_Widget' );
    register_sidebar( array(  
        'name' => 'sidebar',
        'id'   => 'sidebar1'

    ));
    register_sidebar( array(  
        'name' => 'footer1',
        'id'   => 'footer1'

    ));
}
add_action( 'widgets_init', 'my_theme_register_widgets' );
// end of widget register

// pagination for posts

function tp_numeric_posts_nav() {
  
    if( is_singular() )
        return;
  
    global $wp_query;
  
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
  
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
  
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
  
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
  
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
  
    echo '<div class="navigation"><ul>' . "\n";
  
    /** Previous Post Link */
//     if ( get_previous_posts_link() )
//         printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
  
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
  
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
  
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
  
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
  
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
  
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li><br>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
  
    /** Next Post Link */
//     if ( get_next_posts_link() )
//         printf( '<br><li>%s</li>' . "\n", get_next_posts_link() );
  
    echo '</ul></div>' . "\n";
  
}
// end of pagination 

 ?>






