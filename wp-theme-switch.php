<?php
/*
Plugin Name: WP Theme Switch
Plugin URI:
Description: This plugin help switch theme
Author: osmansorkar
Version: 1.0
Author URI: http://fb.com/osmansorkar
*/



/*
 *
 * for change theme enter website address like belo
 * www.yourwebsite.com/?theme=yourthemename
 * */

/*
 * This Function create a cookie so that we know which theme will run
 * */
function wp_theme_switch_set_cookie() {

		/*
		 *  Check is theme has or not
		 * */
		if(!file_exists(get_theme_root() . '/' . $_GET["theme"])) {
			wp_die('invalid theme name');
		}

		setcookie('theme',$_GET["theme"], 0, '/', '/');
		wp_safe_redirect(home_url());
		exit();
}

/*
 * Get theme name from url by the get method and run
 * Action to set cookie
 * */
if(isset($_GET["theme"])){
	add_action( 'init', 'wp_theme_switch_set_cookie');
}


/*
 *  Check the theme cookie and active
 *  the theme by change 2 filter
 * */
if(isset( $_COOKIE["theme"])){

	add_filter("pre_option_template",function (){
		return $_COOKIE["theme"];
	});

	add_filter("pre_option_stylesheet",function (){
		return $_COOKIE["theme"];
	});

}


