<?php
 /*Template Name: Scrollsequence Template
 */

/* HANDLE HEADER - since 1.3.2, to remove errors with FSE themes */
  if ( function_exists('wp_is_block_theme') && wp_is_block_theme()){ 
    // HANDLE HEADER FOR BLOCK THEMES 
      error_reporting(0); // - turn off error reporting
      get_header(); 
      error_reporting(E_ALL); // - turn back on error reporting 
  } else {
    // HANDLE HEADER FOR NON BLOCK THEMES
      get_header(); 
  }

?>

<div id="main-content" class="main-content" style="background-color: transparent; flex-basis: 100% !important; ">
  <div id="primary" class="content-area" style="background-color: transparent; ">
    <div id="content" class="site-content" role="main" style="background-color: transparent;">
        <?php while ( have_posts() ) : the_post(); // START THE LOOP 
          if ( !has_shortcode( get_the_content(), 'scrollsequence' ) ) {
            // The content has a  short code, so this check returned true.
            // echo '<h1>SHORTCODE WAS NOT THERE - ADDING IT</h1>';
            echo do_shortcode( '[scrollsequence]' );
          }
          the_content(); ?>
        <?php endwhile;  ?>
    </div><!-- #content -->
  </div><!-- #primary -->
</div><!-- #main-content -->

<style>
  <?php // CHANGE BGCOLOR 
  if ( !empty(carbon_get_post_meta( get_the_ID(), 'scrollsequence_bodybgcolor')) ){ ?>
  body.single-scrollsequence {
      background-color:<?php echo carbon_get_post_meta( get_the_ID(), 'scrollsequence_bodybgcolor'); ?> ;
  }
  <?php }// CHANGE BGCOLOR ?> 


  <?php  // SHOW or HIDE FOOTER
    if ( empty(carbon_get_post_meta( get_the_ID(), 'scrollsequence_show_footer')) ) {?>
      footer {
      opacity:0;
      }
    <?php
    }else{ ?>
      footer{
        position:relative;
        z-index:9999;
      }
    <?php 
    };
  ?>

</style>

 <?php 
  if ( !empty(carbon_get_post_meta( get_the_ID(), 'scrollsequence_show_sidebar' ) )) : 

  /* HANDLE SIDEBAR - since 1.3.2, to remove errors with FSE themes */ 
    if ( function_exists('wp_is_block_theme') && wp_is_block_theme()){
      error_reporting(0); // - turn off error reporting
      get_sidebar();  // Ak Todo Hide/Show sidebar
      error_reporting(E_ALL); // - turn back on error reporting
    } else {
      get_sidebar();  // Ak Todo Hide/Show sidebar
    }

  endif;




/* HANDLE FOOTER - since 1.3.2, to remove errors with FSE themes */
  if ( function_exists('wp_is_block_theme') && wp_is_block_theme()){ 
    // HANDLE FOOTER FOR BLOCK THEMES 
      error_reporting(0); // - turn off error reporting
      get_footer(); 
      error_reporting(E_ALL); // - turn back on error reporting 
  } else {
    // HANDLE FOOTER FOR NON BLOCK THEMES
      get_footer(); 
  }
