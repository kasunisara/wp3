<?php
   add_action('elementor/widgets/widgets_registered', function () {
      include_once('elementor/widget/drawsvg.widget.php');
      include_once('elementor/widget/imageSequence.widget.php');
      include_once('elementor/widget/splitText3.widget.php');
   });
   include_once "elementor/category.class.php";
   include_once "elementor/add_section.class.php";
   include_once "elementor/add_content.class.php";
   include_once "elementor/css.class.php";
 