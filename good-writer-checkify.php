<?php
/*
Plugin Name: Good Writer Checkify
Plugin URI: http://stevebailey.biz/blog/wp-attention-boxes
Description: A Checklist tool that serves as your own "Blog-Entry Mentor" in the form of a set of checkboxes.
Version: 0.3.0
Author: Steve Bailey
Author URI: http://stevebailey.biz/blog/wp-attention-boxes
License: GPL

Copyright 2011 Steve Bailey (email steveswdev@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/
include_once "includes/good-writer-checkify-includes.inc";
include "good-writer-checkify-admin.php";

new Good_Writer_Checkify; 

class Good_Writer_Checkify {
	private $initial_notes;
	
	function __construct() {
		$this->initial_notes = __("[ Just some starter Sample Notes: ] ", 'good-writer-checkify') . "\n\n";
		$this->initial_notes .= __("Possible Sites for blogging tips", 'good-writer-checkify')  . "\n";
		$this->initial_notes .= "	http://problogger.net"  . "\n";
		$this->initial_notes .= "	http://sethgodin.typepad.com/seths_blog/"  . "\n\n";
		$this->initial_notes .= __("Random thoughts: What did my most popular blog entries have in common:", 'good-writer-checkify')  . "\n";
		$this->initial_notes .= __("	- Didn't try to edit my own extreme opinions.. left them in", 'good-writer-checkify')  . "\n";
		$this->initial_notes .= __("	- Told that crazy story about me and my cousin or other funny craziness that my readers liked", 'good-writer-checkify')  . "\n";
		
		new Good_Writer_Checkify_Options;    // starts necessary options Initialization hooks located in Options page's class, via its own __construct
		add_action( 'wp_print_styles', array( &$this,'enqueue_my_styles') );
	
		add_action("save_post", 'save_goodwriter_details');
		register_activation_hook(__FILE__, array( &$this,'goodwriter_activation_hook' ));
			
		$this->gwc_run_upgrade_procedure();
	}
	
	
	
 	function goodwriter_activation_hook() {
 		global $wp_version; 
		if (version_compare($wp_version, "2.7", "<")) { 
			deactivate_plugins(basename(__FILE__)); // Deactivate our plugin
			wp_die("This plugin requires WordPress version 2.7 or higher.");
		}
	}


	function gwc_run_upgrade_procedure() {
		global $good_writer_checkify_version;
		$current_gwc_checkify_version = get_option('good_writer_checkify_version');
		if  (empty($current_gwc_checkify_version)) {
			$options = get_option('good_writer_checkify_options');
			$options['good_writer_notes'] = $this->initial_notes;
			$options['show_checkboxes_in_edit'] = "yes";
			update_option('good_writer_checkify_options', $options);
		}
		if ( (empty($current_gwc_checkify_version)) || ($current_gwc_checkify_version != $good_writer_checkify_version )) {
		   update_option('good_writer_checkify_version', $good_writer_checkify_version); 
		}
	}
  

   // The Wordpress-preferred method of adding CSS needed by plugin.
   // Basically making this plugin's styles.css available to posts   
	function enqueue_my_styles() {
		$myStyleUrl = plugins_url('/css/styles.css', __FILE__);
		$myStyleFile = plugin_dir_path('/css/styles.css', __FILE__);
		if ( file_exists($myStyleFile) ) {
			wp_register_style('my_gwc_StyleSheets', $myStyleUrl);
			wp_enqueue_style( 'my_gwc_StyleSheets');
		}
	}
   
} // end of class

   function front_end_scripts_method() {
		//error_log("front_end_scripts_method");
		wp_register_script( 'good_writer_checkify_plugin_frontend_script',plugins_url('/js/gwc-frontend-options.js', __FILE__),  array('jquery'));
		wp_enqueue_script('good_writer_checkify_plugin_frontend_script');		
	}


	function save_goodwriter_details($post_id) {	
		global $total_reminders;
		// verify this came from the our screen and with proper authorization.
		/*if ( !wp_verify_nonce( $_POST['goodwriter_noncename'], 'post_type'.$post_id )) {
			return $post_id;
		}*/
		
		/*if ( !wp_verify_nonce( $_POST['goodwriter_noncename'], basename( __FILE__ ) ) ) {
		  error_log("in save_g: " .  basename( __FILE__ ));
          return $post_id;
       }*/
		
 
		// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
			return $post_id;
 
	// Check permissions
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
 
		// OK, we're authenticated: we need to find and save the data	
		
		
		$post = get_post($post_id);
		
		$vals[$indx] = get_post_meta($post->ID, 'quality_blog_tip_done' . $indx, TRUE);
		if ( (($post->post_type == 'post') || ($post->post_type == 'page')) && ($_POST['action'] != 'inline-save')) { 
		 
			foreach (range(1,$total_reminders) as $indx) {
			 // error_log($_POST['quality_blog_tip_done' . $indx]);
			  if($_POST['quality_blog_tip_done' . $indx] == "yes") {
	          	$checkbox = "yes";
  			   } else {
			    $checkbox = "no";
               }
             // echo "$indx"; 
			  update_post_meta($post_id, 'quality_blog_tip_done' . $indx, $checkbox);
			}
		
		}
		return $post_id;
	}
   


?>