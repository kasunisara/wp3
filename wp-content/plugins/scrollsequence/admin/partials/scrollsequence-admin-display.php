<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.scrollsequence.com
 * @since      0.7.0
 *
 * @package    Scrollsequence
 * @subpackage Scrollsequence/admin/partials
 */
?>
<style>
.ssq-heading{
  font-size:23px;
  font-weight: 400;
  padding: 9px 0 4px 0;
  line-height: 1.3;
}
.nav-tab-active{
  background-color:white;
}
.nav-tab-active, .nav-tab-active:focus, .nav-tab-active:focus:active, .nav-tab-active:hover{
  border-bottom:1px solid white;
}
.nodeco {
  text-decoration: none;
}
</style>
<!-- Create the default WordPress 'wrap' container -->
<div class="wrap scrollsequence-admin-wrap">
  <!-- Admin Notices Display  -->
    <?php 
settings_errors();
?><h2></h2>
    
  <div  class="ssq-welcome" style="height:225px" >
    <div style=" padding: 30px; width: 150px; float:left; ">
      <svg  width="128" height="128" viewBox="-150 -150 1300 1300">
          <defs>
            <linearGradient id="ssq-logo-gradient" x1="0%" y1="50%" x2="100%" y2="0%">
              <stop offset="0%" style="stop-color:rgb(23,48,66);stop-opacity:1" />
              <stop offset="100%" style="stop-color:rgb(35,110,119);stop-opacity:1" />
            </linearGradient>
          </defs>
        <!-- Background  -->
          <rect x="-150" y="-150" rx="225" ry="225" width="1300" height="1300"
          style=" fill:url(#ssq-logo-gradient);" />
        <!-- Mid Left  -->
            <polyline points="162,322 500,500 340,575 0,400 162,322" 
            style="fill:rgb(40,183,107);stroke:rgb(40,183,107);stroke-width:5;" />
            <polyline points="500,500 500,650 340,575"
            style="fill:rgb(74,108,47);stroke:rgb(74,108,47);stroke-width:5;"/>
        <!-- Mid Right  -->
            <polyline points="845,675 500,500, 650,425 1000,600 845,675"
            style="fill:rgb(40,183,107);stroke:rgb(40,183,107);stroke-width:5;" />
            <polyline points="500,500, 500,350 650,425" 
            style="fill:rgb(74,108,47);stroke:rgb(74,108,47);stroke-width:5;  "/>
        <!-- TOP TOP CHEVRON  TOP TOP  -->
          <polyline points="500,0 1000,250, 1000,400 500,150 0,400 0,250 500,0"
          style="fill:rgb(207,223,218);stroke:rgb(207,223,218);stroke-width:5;"/>
        <!--  BOTTOM BOTTOM CHEVRON BOTTOM  -->
          <polyline points="0,600 500,850 1000,600  1000,750 500,1000 0,750 0,600" 
          style="fill:rgb(207,223,218);stroke:rgb(207,223,218);stroke-width:5;"/>
      </svg>
    </div>
    <div style="position:relative">

      <p class ="ssq-heading" style="padding-top: 60px;"><b>Scroll</b>sequence
         <?php 
echo  'Free' ;
?>
      </p>
      <p><?php 
/*_e( 'You are working with Beta version. Use with caution. Backup your work before updating.', 'scrollsequence' ); */
?></p>
      <div style="position:absolute;right:20px;top:20px;">
        <span style="margin-right:20px"><?php 
echo  SCROLLSEQUENCE_VERSION ;
?>  </span>
        <a href="https://www.youtube.com/channel/UCfS4p0R5ZYr4GTQ9DIBbEgg"><span class="nodeco dashicons dashicons-youtube" style="color:#FF0000;"></span></a>
        <a href="https://www.facebook.com/scrollsequence"><span class="nodeco dashicons dashicons-facebook" style="color:#4267B2;"></span></a>
        <a href="https://twitter.com/scrollsequence"><span class="nodeco dashicons dashicons-twitter" style="color:#1DA1F2;"></span></a>
        <a href="https://www.instagram.com/scrollsequence/"><span class="nodeco dashicons dashicons-instagram" style="color:#fb3958;"></span></a>
        <!-- <a href="https://www.facebook.com/scrollsequence"><span class="nodeco dashicons dashicons-facebook"></span></a>      -->      
      </div>
    </div>
  </div><!-- /.ssq-welcome --> 



 <?php 
/*
   Inspiration taken from:
   https://code.tutsplus.com/tutorials/the-wordpress-settings-api-part-5-tabbed-navigation-for-settings--wp-24971 
*/
?>
 
  <!-- Create Tabs Menu -->
    
     
    <?php 
$active_tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'get_started' );
// set the default tab here
if ( isset( $_GET['tab'] ) ) {
    $active_tab = $_GET['tab'];
}
// end if
?>
   
  <h2 class="nav-tab-wrapper" style="position:relative; top:-45px">
      <!-- Internal Links  -->
        <a href="?page=scrollsequence-dashboard&tab=get_started" class="nav-tab <?php 
echo  ( $active_tab == 'get_started' ? 'nav-tab-active' : '' ) ;
?>">
         <i aria-hidden="true" class="dashicons dashicons-welcome-learn-more" ></i> 
         <?php 
_e( 'Get Started', 'scrollsequence' );
?> 
        </a>
        <a href="?page=scrollsequence-dashboard&tab=options" class="nav-tab <?php 
echo  ( $active_tab == 'options' ? 'nav-tab-active' : '' ) ;
?>">
          <i aria-hidden="true" class="dashicons dashicons-admin-generic" ></i> 
          <?php 
_e( 'Options', 'scrollsequence' );
?> 
        </a>

      <!-- Upgrade Link (shown only on Free)  -->
        <?php 
?>
          <a href="<?php 
echo  admin_url( 'admin.php?page=scrollsequence-pricing' ) ;
?>" class="nav-tab">
            <i aria-hidden="true" class="dashicons dashicons-cart" style="color:rgb(40,183,107);"></i> 
            <?php 
_e( 'Upgrade', 'scrollsequence' );
?>
          </a>              
        <?php 
// end of else
?>
      <!-- External Links -->
        <a href="https://scrollsequence.com/examples/?utm_source=plugin&utm_medium=<?php 
echo  getenv( 'HTTP_HOST' ) ;
?>&utm_campaign=dashboard" class="nav-tab" target="_blank">
          <i aria-hidden="true" class="dashicons dashicons-external" ></i> 
          <?php 
_e( 'Examples', 'scrollsequence' );
?>
        </a>
        <a href="https://scrollsequence.com/documentation/?utm_source=plugin&utm_medium=<?php 
echo  getenv( 'HTTP_HOST' ) ;
?>&utm_campaign=dashboard" class="nav-tab" target="_blank">
          <i aria-hidden="true" class="dashicons dashicons-external"></i> 
          <?php 
_e( 'Docs', 'scrollsequence' );
?>
        </a>

        <a href="https://help.scrollsequence.com/?utm_source=plugin&utm_medium=<?php 
echo  getenv( 'HTTP_HOST' ) ;
?>&utm_campaign=dashboard" class="nav-tab" target="_blank">
          <i aria-hidden="true" class="dashicons dashicons-external"></i> 
          <?php 
_e( 'Knowledge Base', 'scrollsequence' );
?>
        </a>


  </h2>

  <!-- TAB CONTENTS ARE CREATED HERE  -->   
  <div id="GettingStarted"  style="padding: 100px 20px; height: 100%; border: 1px solid #ccd0d4; border-top:0; margin-top:-45px; background-color:white">     
  <?php 

if ( $active_tab == 'get_started' ) {
    require_once "scrollsequence-admin-display-get-started.php";
} elseif ( $active_tab == 'options' ) {
    require_once "scrollsequence-admin-display-options.php";
} else {
    echo  '<h1>Error: Tab does not exist.</h1>' ;
}

// end if/else
?>
  </div>
     
</div><!-- /.wrap -->