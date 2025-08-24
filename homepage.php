<?php /* Template Name: Home */
get_header();?>

<main>
  <div class="container  mt-5">
    <h2 class="text-center"> WP classic theme starter </h2>
    <hr>
    <div class="row mt-3">
      <div class="col-12 col-md-8 col-lg-8">
        <h4>Main content area</h4>
      </div>
      <div class="col-12 col-md-4 col-lg-4 ">
        <div class="sidebar-area bg-light p-3">
          <h5>Sidebar area</h5>
        <hr>
        <?php dynamic_sidebar( 'sidebar1' ); ?>
        </div>
      </div>
    </div>
  </div> 
</main>
	  
	  
<?php get_footer(); ?> 
	  