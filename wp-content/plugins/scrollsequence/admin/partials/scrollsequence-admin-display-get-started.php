

<?php 
// FREE START
?>


  <table class="form-table" >
  <tbody>
    <tr>
    <th scope="row"><labe ></label></th>
      <td>

        <p class ="ssq-heading" style="max-width:640px; text-align: center; border:1px solid #c3c4c7; background-color: #f0f0f1;" ><br>
          <strong>
            <?php 
_e( 'For limited time only we offer a trial period of PRO version.', 'scrollsequence' );
?>
          <br>
            <?php 
_e( 'No credit card, no risk. Grab your trial while they last!', 'scrollsequence' );
?>
          </strong><br><br>
          <a class="button button-primary button-hero" href="<?php 
echo  admin_url( 'admin.php?page=scrollsequence-pricing&trial=true' ) ;
?>">
            <?php 
_e( '14 DAYS FREE TRIAL', 'scrollsequence' );
?>
          </a>
          <br><br><br>
        </p>
        <p> </p>

      </td>
    </tr>
  </tbody>
  </table>
  <br><br><br>

<?php 
// FREE END
?>




  
  <p  class ="ssq-heading"><?php 
_e( 'Getting Started is easy, watch the steps below.', 'scrollsequence' );
?> </p> <br>
  <table class="form-table" >
  <tbody>

  <tr>  
  <th scope="row"><label ><?php 
_e( 'Getting Started Video', 'scrollsequence' );
?></label></th>
    <td>
     
      <iframe src="https://player.vimeo.com/video/413362050" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
    </td>
  </tr>

  <tr>
  <th scope="row"><label ><?php 
_e( 'Create a new Scene', 'scrollsequence' );
?></label></th>
    <td>
      <?php 
_e( 'Click on <i><strong>(1) Add New Scrollsequence</strong></i>, set a <i><strong>(2) title</strong></i> name and  <i><strong>(3) Add Scene</strong></i>.', 'scrollsequence' );
?>
      <br><br>
      <img src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../img/add-new-scrollsequence-images.png' ;
?>" width="640">
    </td>
  </tr>

  <tr>
  <th scope="row"><label for="default_post_format"><?php 
_e( 'Select Images', 'scrollsequence' );
?></label></th>
    <td>
      <?php 
_e( 'Click on <i><strong>(4) Select Images</strong></i> (5) confirm selection that you want to use. Hold down CTRL or SHIFT for multiple selection.<br> Take care about the order you select your images. After you made and confirmed your selection, you can easily drag and drop to reorder.', 'scrollsequence' );
?>
      <p> 
        <?php 
_e( 'If you do not have your own images available, you can use one of our <b>Image Packs</b>', 'scrollsequence' );
?>
        (<a href="https://scrollsequence.com/scrollsequence-image-pack-1-watch.zip?utm_source=plugin&utm_medium=<?php 
echo  getenv( 'HTTP_HOST' ) ;
?>&utm_campaign=dashboard">Pack 1</a>,
        <a href="https://scrollsequence.com/scrollsequence-image-pack-2-headphones.zip?utm_source=plugin&utm_medium=<?php 
echo  getenv( 'HTTP_HOST' ) ;
?>&utm_campaign=dashboard">Pack2</a>).
      </p>
      <br>
      <img src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../img/select-images.png' ;
?>" width="640">
      <br><br>
      <img src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../img/add-content.png' ;
?>" width="640">
    </td>
  </tr>

  <th scope="row"><label for="default_post_format"><?php 
_e( 'Create Scene Content', 'scrollsequence' );
?></label></th>
    <td>
      <?php 
_e( 'Standard TinyMCE editor is being used for writing the content. TinyMCE is the most advanced editor on the market. Supports shortcodes, oEmbed and many other features.', 'scrollsequence' );
?>
      <br>
      <?php 
_e( 'HTML content is made up of elements. Each element can have one unique <b>ID</b> and multiple <b>class</b>es.', 'scrollsequence' );
?>
      <br><br>
      <img src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../img/add-page-content.png' ;
?>" width="640">
      <br>
      <?php 
_e( '<b>Class</b>es and <b>ID</b>s are used as selectors for on scroll animation, details are described in paragraphs below.', 'scrollsequence' );
?>
      <br><br>
    </td>
  </tr>

  <th scope="row"><label for="default_post_format"><?php 
_e( 'Animate', 'scrollsequence' );
?></label></th>
    <td>
      <?php 
_e( 'Click on <i><strong>(6) Add Animation</strong></i>. The most basic is In/Out Animation.<br>Three basic parameters are required for each animated element. You can add more element animations with the little plus sign. ', 'scrollsequence' );
?>
      <br>
      <img src="<?php 
echo  plugin_dir_url( __FILE__ ) . '../img/animation.png' ;
?>" width="640">
      <br>
      <p><?php 
_e( 'Selector example use', 'scrollsequence' );
?>: </p> 





      <table class="widefat" style="width:640px;">
      <thead>
          <tr>
              <th style="padding-left:5px"> <?php 
_e( 'Selector', 'scrollsequence' );
?></th>
              <th style="padding-left:5px"> <?php 
_e( 'Description', 'scrollsequence' );
?></th>       

          </tr>
      </thead>
      <tbody>
         <tr>
           <td>#my-id</td>
           <td>
              <?php 
printf(
    /* translators: 1: Note */
    __( 'Select a HTML element with id="%1$s". IDs should be unique. This means that only one HTML element can have the same id.', 'scrollsequence' ),
    'my-id'
);
?>
           </td>
         </tr>
      </tbody>
      <tbody>
         <tr>
           <td>.my-class</td>
           <td>
              <?php 
printf(
    /* translators: 1: Note */
    __( 'Select each HTML element with class="%1$s". Multiple elements can have same class attribute.', 'scrollsequence' ),
    'my-class'
);
?>            
           </td>
         </tr>
      </tbody>
      </table>
      <br>
      <?php 
_e( 'Start and End example use', 'scrollsequence' );
?>: 
      <table class="widefat" style="width:640px;">
      <thead>
          <tr>
              <th>
               <div style="width:70%"><p style="text-align:left;padding-left:5px"> <?php 
_e( 'Start', 'scrollsequence' );
?><span style="float:right;"><?php 
_e( 'End', 'scrollsequence' );
?></span></p><div>
              </th>
              <th style="padding-left:5px"><?php 
_e( 'Description', 'scrollsequence' );
?></th>       
          </tr>
      </thead>
      <tbody>
         <tr>
           <td>
           <div style="width:70%"><p style="text-align:left;">0<span style="float:right;">15</span></p><div>
           </td>
           <td>
            <?php 
_e( 'Element is visible when page is loaded. Once user starts scrolling down, element is hidden once user reaches the fifteenth image.', 'scrollsequence' );
?>
           </td>
         </tr>
      </tbody>
      <tbody>
         <tr>
           <td>
             <div style="width:70%"><p style="text-align:left;">5<span style="float:right;">30</span></p><div>
           </td>
           <td>
            <?php 
_e( 'Element is hidden when page is loaded. Once user starts scrolling down, element is displayed from 5th to 30th image in the sequence. ', 'scrollsequence' );
?>
           </td>
         </tr>
      </tbody>
      </table>

     
      
      
    </td>
  </tr>
  </tbody></table>


  <table class="form-table" >
    <tbody>
      <tr>
      <th scope="row"><label ><?php 
_e( 'Full Tutorial Video', 'scrollsequence' );
?></label></th>
        <td>
         
          <iframe width="640" height="336" src="https://www.youtube.com/embed/Rbsw2Nwn4VY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

        </td>
      </tr>
    </tbody>
  </table>


  <p style="padding-top: 45px;"  class ="ssq-heading"><?php 
_e( 'Tips and Tricks', 'scrollsequence' );
?></p> <br>

  <table class="form-table" >
  <tbody>
  <tr>
  <th scope="row"><label ><?php 
_e( 'Basic Use', 'scrollsequence' );
?></label></th>
    <td>
      <ul style=" list-style-type: circle; padding-left: 50px">
        <li>
          <?php 
_e( 'Add another Scene to the sequence. Each Scene contains image sequence, content and setting like duration, alignment and scale. Scenes can be re-ordered by drag and drop. If you wish you can make a copy of a similar Scene.', 'scrollsequence' );
?>          
        </li>
        <li>
              <?php 
printf(
    /* translators: 1: %1$s:[scrollsequence] %2$s:[scrollsequence id="####" margintop="-200px"] */
    __( 'Add %1$s shortcode to control position of the image animation in the content. Margintop, marginbottom shortcode options give you control of the margins. Use negative margin to overlap with classic content before or after the animation. Example %2$s.', 'scrollsequence' ),
    '[scrollsequence]',
    '[scrollsequence id="####" margintop="-200px"]'
);
?>             
        
        </li>
        
      </ul>
    </td>
  </tr>
  <tr>
  <th scope="row"><label ><?php 
_e( 'Advanced Use', 'scrollsequence' );
?></label></th>
    <td>
      <ul style=" list-style-type: circle; padding-left: 50px">
        <li>
          <?php 
_e( 'Custom CSS is a great way how to add a magic touch to your design. Simply write or paste CSS code.', 'scrollsequence' );
?>
        </li>
        <li>
              <?php 
printf( __( 'Read our <a href="%1$s" target="_blank">documentation</a>, learn the basics, have a look at some examples and get inspiration for your project. ', 'scrollsequence' ), 'https://scrollsequence.com/documentation/' );
?>             
        </li>
        <li>
          <?php 
_e( 'Debug mode gives you information when you fall into trouble. If you stumble upon an issue, don not hesitate and ', 'scrollsequence' );
?>
          <a href="<?php 
echo  admin_url( 'admin.php?page=scrollsequence-contact' ) ;
?>">
          <?php 
_e( 'contact us', 'scrollsequence' );
?>
          </a>.
        </li>
      </ul>
    </td>
  </tr>
