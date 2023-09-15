<?php 

		/**
		* This adds the Scrollsequence CPT 
		*
		*
		* 
		*/

		$cap_type = 'post';
		$plural = 'Scrollsequence';
		$single = 'Scrollsequence';
		$cpt_name = 'scrollsequence';
		$opts['can_export'] = TRUE;
		$opts['capability_type'] = $cap_type;
		$opts['description'] = '';
		$opts['exclude_from_search'] = FALSE;
		$opts['has_archive'] = FALSE;
		$opts['hierarchical'] = FALSE;
		$opts['map_meta_cap'] = TRUE;
		//$opts['menu_icon'] = 'dashicons-format-gallery';
		$opts['menu_icon'] = 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" viewBox="-150 -150 1300 1300" xmlns="http://www.w3.org/2000/svg">


			<polyline points="162,322 500,500 340,575 0,400 162,322" 
			style="fill:rgb(124,173,62);stroke:rgb(124,173,62);stroke-width:5;" />
			<polyline points="500,500 500,650 340,575"
			style="fill:rgb(74,108,47);stroke:rgb(74,108,47);stroke-width:5;"/>

			<polyline points="845,675 500,500, 650,425 1000,600 845,675"
			style="fill:rgb(124,173,62);stroke:rgb(124,173,62);stroke-width:5;" />
			<polyline points="500,500, 500,350 650,425" 
			style="fill:rgb(74,108,47);stroke:rgb(74,108,47);stroke-width:5;  "/>

			<polyline points="500,0 1000,250, 1000,400 500,150 0,400 0,250 500,0"
			style="fill:rgb(207,223,218);stroke:rgb(207,223,218);stroke-width:5;"/>

			<polyline points="0,600 500,850 1000,600  1000,750 500,1000 0,750 0,600" 
			style="fill:rgb(207,223,218);stroke:rgb(207,223,218);stroke-width:5;"/>


			</svg>');

		$opts['menu_position'] = 25;
		$opts['public'] = TRUE;
		$opts['publicly_querable'] = TRUE;
		$opts['query_var'] = TRUE;
		$opts['register_meta_box_cb'] = '';

		$opts['rewrite'] = array('slug' => 'scrollsequence','with_front' => false);  //Ak mod Aktodo 
		$opts['show_in_admin_bar'] = TRUE;
		$opts['show_in_menu'] = TRUE;
		$opts['show_in_nav_menu'] = TRUE;

		// Akmod: Line below turns on gutenberg editor. 
			// (When activated "Scrollsequence_Group" context need to change to "normal" for it to be displayed)
		//$opts['show_in_rest'] = TRUE;   

		
		// When line below is active, and page is saved without title => save does not happen
			$opts['supports'] = array('title','editor','excerpt','thumbnail','post-formats', 'revisions'); // Ak mod gutenberg 


		$opts['labels']['add_new'] = esc_html__( "Add New {$single}", 'scrollsequence' );
		$opts['labels']['add_new_item'] = esc_html__( "Add New {$single}", 'scrollsequence' );
		$opts['labels']['all_items'] = esc_html__( $plural, 'scrollsequence' );
		$opts['labels']['edit_item'] = esc_html__( "Edit {$single}" , 'scrollsequence' );
		$opts['labels']['menu_name'] = esc_html__( $plural, 'scrollsequence' );
		$opts['labels']['name'] = esc_html__( $plural, 'scrollsequence' );
		$opts['labels']['name_admin_bar'] = esc_html__( $single, 'scrollsequence' );
		$opts['labels']['new_item'] = esc_html__( "New {$single}", 'scrollsequence' );
		$opts['labels']['not_found'] = esc_html__( "No {$plural} Found", 'scrollsequence' );
		$opts['labels']['not_found_in_trash'] = esc_html__( "No {$plural} Found in Trash", 'scrollsequence' );
		$opts['labels']['parent_item_colon'] = esc_html__( "Parent {$plural} :", 'scrollsequence' );
		$opts['labels']['search_items'] = esc_html__( "Search {$plural}", 'scrollsequence' );
		$opts['labels']['singular_name'] = esc_html__( $single, 'scrollsequence' );
		$opts['labels']['view_item'] = esc_html__( "View {$single}", 'scrollsequence' );
		register_post_type( strtolower( $cpt_name ), $opts );

		// When line below is active, and page is saved without title => save does not happen
			//add_post_type_support($cpt_name, array('excerpt','revisons','thumbnail'));

		//remove_post_type_support( $cpt_name, 'editor');  // THIS REMOVES THE DEFAULT WYSIWIG EDITOR





