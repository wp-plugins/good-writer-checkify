<?php

class Good_Writer_Checkify_Options {

	// Hook up some handler functions at start of plugin load
	// -------------------------------------------------------
	function __construct() {
		add_action('admin_menu', array( &$this,'gwc_plugin_menu'));
		add_action( 'admin_init', array( &$this,'gwc_register_settings' ));
		add_action( 'admin_init', array( &$this,'gwc_div_carousel'));
		//wp_register_script( 'good_writer_checkify_clue_tip_plugin_script', WP_PLUGIN_URL . '/good-writer-checkify/js/jquery.cluetip.js' );
		add_action('admin_enqueue_scripts', array( &$this,'gwc_admin_scripts_method'));
	
	}
  
	function gwc_admin_scripts_method() {
		wp_register_script( 'good_writer_checkify_clue_tip_plugin_script',plugins_url('/js/jquery.cluetip.js', __FILE__));
		wp_register_script( 'good_writer_checkify_plugin_script',plugins_url('/js/gwc-admin-options.js', __FILE__));
		wp_enqueue_script('good_writer_checkify_clue_tip_plugin_script');
		wp_enqueue_script('good_writer_checkify_plugin_script');
		
		$myStyleUrl = plugins_url('/css/gwc-admin-styles.css', __FILE__);
		$myStyleClueTipUrl = plugins_url('/js/jquery.cluetip.css', __FILE__);
        
        wp_register_style('my_gwc_StyleSheets', $myStyleUrl);
		wp_enqueue_style( 'my_gwc_StyleSheets');
		wp_register_style('my_gwc_cluetip_StyleSheets', $myStyleClueTipUrl);
		wp_enqueue_style( 'my_gwc_cluetip_StyleSheets');

	}

	function gwc_plugin_menu() {
		$mypage = add_options_page('Good Writer Checkify Options Page','Good Writer Checkify', 'administrator', __FILE__, array( &$this,'gwc_plugin_options')); 
		//add_action( "admin_print_scripts-$mypage", array( &$this,'gwc_admin_head') );
	}

    // Tell Wordpress to load a custom CSS file which only be used for this plugin, while using the Options Page
	// ---------------------------------------------------------------------------------------------------
	/*function gwc_admin_head() {
		$plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
	
		echo '<link rel="stylesheet" href="' . $plugindir . '/css/gwc-admin-styles.css" type="text/css" />';
		echo '<link rel="stylesheet" href="' . $plugindir . '/js/jquery.cluetip.css" type="text/css" />';
	}*/

	/* Adds a box to the main column on the Post and Page edit screens */
	function gwc_div_carousel() {
		$this->enqueue_metabox_styles();
		add_meta_box( 
			'gwc_sectionid',
			__( 'Good Writer Checkify', 'gwc_textdomain' ),
			array($this, 'gwc_print_div_carousel'),
			'post' 
		);
		add_meta_box( 
			'gwc_sectionid',
			__( 'Good Writer Checkify', 'gwc_textdomain' ),
			array($this, 'gwc_print_div_carousel'),
			'post' 
		);
	}
	
	/* Prints the box content */
	function gwc_print_div_carousel ( $post ) {
	    $default_options = get_option('good_writer_checkify_options'); 
		$vals = array();
		if (empty($post->post_title)) {
		
			foreach (range(1,10) as $indx) {
				$vals[$indx] = $default_options['quality_blog_tip' . $indx . '_default'];
			}
		}
	    else {
			foreach (range(1,10) as $indx) {
				$vals[$indx] = get_post_meta($post->ID, 'quality_blog_tip_done' . $indx, TRUE);
		   
			}
		}
		$styled_ul = "";
		if (!isset($default_options['show_checkboxes_in_edit'])) {
		  $styled_ul = ' reminder_list';
		}
		echo '<ul class="outer_reminder_ul_post_page' . $styled_ul . '">';
		echo '<input type="hidden" name="goodwriter_noncename" value="', wp_create_nonce(basename(__FILE__)), '" />';
		foreach (range(1,10) as $indx) {
			$tip_span_class = ($vals[$indx] == "yes" ? "tip_span checked_off" : "tip_span");
			if (!empty($default_options['quality_blog_tip' .  $indx])) {
				if (isset($default_options['show_checkboxes_in_edit'])) {
					echo '<li class="mark_off_li"><input type="checkbox" name="quality_blog_tip_done' . $indx . '" value="yes"' . ($vals[$indx] == "yes" ? " checked" : "") . '/>';
					echo  '<span class="' . $tip_span_class . '">' . $default_options['quality_blog_tip' .  $indx] .'</span></li>';
				} else {
					echo '<li >' . $default_options['quality_blog_tip' .  $indx] .'</li>';
				}
					
			}

		}
		echo '</ul>'; 

     }

	function enqueue_metabox_styles() {
		$myStyleUrl = WP_PLUGIN_URL . '/good-writer-checkify/css/gwc-postmetabox-styles.css';
		$myStyleFile = WP_PLUGIN_DIR . '/good-writer-checkify/css/gwc-postmetabox-styles.css';
		/*$clueTipStyleFile = WP_PLUGIN_DIR . '/good-writer-checkify/js/jquery.cluetip.css';
		$clueTipStyleUrl = WP_PLUGIN_URL . '/good-writer-checkify/js/jquery.cluetip.css';*/
		if ( file_exists($myStyleFile) ) {
			wp_register_style('good_writer_checkify_metabox_StyleSheets', $myStyleUrl);
			wp_enqueue_style( 'good_writer_checkify_metabox_StyleSheets');
		}
		/*if ( file_exists($clueTipStyleFile) ) {
			wp_register_style('good_writer_checkify_cluetip_metabox_StyleSheets', $clueTipStyleUrl);
			wp_enqueue_style( 'good_writer_checkify_cluetip_metabox_StyleSheets');
		}*/
	}


	


	function gwc_register_settings(){
		register_setting( 'good_writer_checkify_user_options', 'good_writer_checkify_options', 'good_writer_checkify_validate' );
	}

	function gwc_plugin_options() { ?>
        
		<div class="wrap">
		
			<div class="icon32" id="icon-options-general"><br></div>
			<h2 style="float: left;">Add your Good Writer Principles </h2>
			<img id="check_icon" src="<?php echo WP_PLUGIN_URL . '/good-writer-checkify/images/check.jpg'; ?>">
			<div id="you_can_store_message">You can store up to 10 Tips/Requirements/Guidelines</div>
			<form method="post" action="options.php">
			
				<?php settings_fields('good_writer_checkify_user_options'); ?>
				
				<?php $options = get_option('good_writer_checkify_options'); ?>
				<?php if (isset($options['show_checkboxes_in_edit'])) {
					$show_checkboxes_in_post = 1;
					$is_default_visible = "visible";
				}
			    else {
					$show_checkboxes_in_post = 0;
					$is_default_visible = "hidden";
				}
				?>
				<div id="gwc_control_bar" style="">  
				
				<input id="toggleShowCheckMarks" type="checkbox" name="good_writer_checkify_options[show_checkboxes_in_edit]" value="yes" <?php echo ($show_checkboxes_in_post == 1 ? " checked" : ""); ?> >
				 <span  id="show_checkbox_message" title="Doesn't removing checkboxes negate the purpose ? | Nah, it's your blog, your needs.. maybe you just want to be reminded without being distracted by checkboxes .. instead the meta box will show bullet points.">Show Checkbox's in Post/Page-editing</span>
				</div>
				
				<table id="quality_tips_table" class="form-table>"
					<tr>
					   
					    <th>&nbsp;</th> 
					    <th>Reminders / Tips</th> 
					    <th class="blog_tip_col_default" style="visibility: <?php echo $is_default_visible; ?>" >
					      <span title="What are these ? | If you want any of these items checked-off, by default, when you start a brand new post, check them here" id="default_checkbox_tip"><img src="<?php echo WP_PLUGIN_URL . '/good-writer-checkify/images/info.jpg'; ?>"></span>
					    </th> 
					</tr>
					<?php foreach (range(1,10) as $indx) { 
						$default_on = $options['quality_blog_tip' . $indx . '_default'];
					?>
					
					<tr>
						<td class="blog_tip_col">#<?php echo $indx; ?>
		 				</td>
		 				<td class="blog_tip_col"><input type="text" id="blogtip_<?php echo $indx; ?>" name="good_writer_checkify_options[quality_blog_tip<?php echo $indx; ?>]" value="<?php echo $options['quality_blog_tip' . $indx]; ?>" />
		 				</td>
		 				<td class="blog_tip_col_default" style="visibility: <?php echo $is_default_visible; ?>">
		 					<input type="checkbox" name="good_writer_checkify_options[quality_blog_tip<?php echo $indx; ?>_default]" value="yes" <?php echo ($default_on == "yes" ? " checked" : ""); ?>>
		 				</td
					</tr>
	                <?php }
	             ?>
				
				</table>
				<p>&nbsp;</p>
				<div>
					<div style="width: 700px;">
						<span id="random_notes"  title="Possible Uses|- List some sites that feature blogging tips|- Paste in some good blogging principles that you ran across from other sites, but still need editing/abbreviating before placing into above check items.">Random Notes Area</span>
						<span id="random_notes_2"  title="Might be better to ... | use your own note-taking tool instead of this.   Something that is more easily available to you on your PC/Mac, such as popup Notepad / browser plugin, etc.. to let you more spontaneously jot down ideas and blog tips you see on the Web and elsewhere.">( more info )</span>
					</div>
					<textarea id="good_writer_notes" name="good_writer_checkify_options[good_writer_notes]" ><?php echo $options['good_writer_notes']; ?></textarea>
	            	<p class="submit"> <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  </p>
	            </div>
	
			</form>
		</div>

<?php }

} 


function good_writer_checkify_validate($input) {
       
   // $input['bwidth1'] =  intval($input['bwidth1']);
   // $input['bwidth2'] =  intval($input['bwidth2']);
   // $input['bwidth3'] =  intval($input['bwidth3']);
   // $input['bwidth4'] =  intval($input['bwidth4']);
    
	return $input;
}


?>