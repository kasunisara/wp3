

<form method="post" action="options.php">
    <?php 
settings_fields( 'scrollsequence-settings-group' );
?>
    <?php 
do_settings_sections( 'scrollsequence-settings-group' );
?>
    <table class="form-table">


	        <tr valign="top">
		        <th scope="row"><?php 
_e( 'High Definition Canvas', 'scrollsequence' );
?></th>
		        <td>
					<input type="radio" id="sticky-js-id" name="ssq_option_canvas_dpr" value="quality"  <?php 
checked( 'quality', get_option( 'ssq_option_canvas_dpr' ), true );
?>>
					<label for="sticky-js-id">
						<?php 
_e( 'Maximum Image Quality (default)', 'scrollsequence' );
?> - 
						<?php 
_e( 'Retina and high pixel density devices will show HD images.', 'scrollsequence' );
?>
					</label><br>
					<br>
					<input type="radio" id="canvas-dpr-id" name="ssq_option_canvas_dpr" value="performance"  <?php 
checked( 'performance', get_option( 'ssq_option_canvas_dpr' ), true );
?>>
					<label for="canvas-dpr-id">
						<?php 
_e( 'Maximum Performance ', 'scrollsequence' );
?> - 
						<?php 
_e( 'Retina and high pixel density devices may show blured images.', 'scrollsequence' );
?>
							
					</label><br>
					

		        </td>
	        </tr>


	        <tr valign="top">
		        <th scope="row"><?php 
_e( 'Image Preload Percentage', 'scrollsequence' );
?></th>
		        <td>
		        	<input type="range" name="ssq_option_preload_percentage" min="0.0" max="0.5" step="0.02" value="<?php 
echo  esc_attr( get_option( 'ssq_option_preload_percentage' ) ) ;
?>" class="slider" id="ssqRange"> <span id="ssqRangeOutput"></span>
		        	<p class="description" ><?php 
_e( 'Display animation after percentage of images are finished preloading. Default 12%', 'scrollsequence' );
?></p>
		        </td>
	        </tr>


	        <tr valign="top">
		        <th scope="row"><?php 
_e( 'Position Sticky', 'scrollsequence' );
?></th>
		        <td>

					<input type="radio" id="sticky-css-id" name="ssq_option_position_sticky" value="sticky-css"  <?php 
checked( 'sticky-css', get_option( 'ssq_option_position_sticky' ), true );
?>>
					<label for="sticky-css-id"><?php 
_e( 'CSS Sticky (recommended) - works with some themes', 'scrollsequence' );
?></label><br>
					<br>
					<input type="radio" id="sticky-js-id" name="ssq_option_position_sticky" value="sticky-js"  <?php 
checked( 'sticky-js', get_option( 'ssq_option_position_sticky' ), true );
?>>
					<label for="sticky-js-id"><?php 
_e( 'Javascript Sticky (default) - works with most themes', 'scrollsequence' );
?></label><br>

		        	<p class="description" ><?php 
_e( 'See documentation for more details. ', 'scrollsequence' );
?></p>
		        	<p><a href="https://scrollsequence.com/documentation/" target="_blank">Documentation</a></p>
		        </td>
	        </tr>




        <?php 
// END OF PRO ONLY
?>
    </table>
    
    <?php 
submit_button();
?>

</form>


<script>
(function () {
	var slider = document.getElementById("ssqRange");
	var output = document.getElementById("ssqRangeOutput");
	output.innerHTML = Math.round(slider.value*100)+'%'; // Display the default slider value
	// Update the current slider value (each time you drag the slider handle)
	slider.oninput = function() {
	  output.innerHTML = Math.round(this.value*100)+'%';
	}

var x = document.getElementById("ssqRange");
var defaultVal = x.defaultValue;
var currentVal = x.value;
console.log('defaultVal',defaultVal,'currentVal:',currentVal)

})();
</script>
