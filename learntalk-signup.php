<?php
/*
Plugin Name:     LearnTalk Signup
Plugin URI:      https://learntalk.org/en/corporate-solution
Description:     Allows customers to signup/signin on the learntalk page using the API. Please use [lrnts_signup] shortcode for signup form and use [lrnts_signin] shortcode for signin form
Author:          Learntalk
Author URI:      https://learntalk.org
Version:         1.0.0
License:          GPLv3
License URI: http://www.gnu.org/licenses/quick-guide-gplv3.html
*/


/* DEFINE GLOBAL VARIABLE OF PLUGIN */
$options = get_option('lrnts_api_settings');
define('LRNTS_PLUGIN_URL', plugins_url('', __FILE__));
define('LRNTS_API_REGISTRATION_DEFAULT', 'https://learntalk.org/api/v1/registration');
define('LRNTS_API_SIGNIN_DEFAULT', 'https://learntalk.org/api/v1/login');
define('LRNTS_API_FORGOT_PASS_DEFAULT', 'https://learntalk.org/api/v1/forgot_password');
define('LRNTS_API_X_AUTH_TOKAN_DEFAULT', '86b8222937a9b3b2b9676804429c78ba');

if (empty($options['lrnts_signup_api'])) {
    define('LRNTS_API_REGISTRATION', LRNTS_API_REGISTRATION_DEFAULT);
} else {
    define('LRNTS_API_REGISTRATION', $options['lrnts_signup_api']);
}

if (empty($options['lrnts_signin_api'])) {
    define('LRNTS_API_SIGNIN', LRNTS_API_SIGNIN_DEFAULT);
} else {
    define('LRNTS_API_SIGNIN', $options['lrnts_signin_api']);
}

if (empty($options['lrnts_api_forgotpass'])) {
    define('LRNTS_API_FORGOT_PASS', LRNTS_API_FORGOT_PASS_DEFAULT);
} else {
    define('LRNTS_API_FORGOT_PASS', $options['lrnts_api_forgotpass']);
}

if (empty($options['lrnts_api_xauthtokan'])) {
    define('LRNTS_API_X_AUTH_TOKAN', LRNTS_API_X_AUTH_TOKAN_DEFAULT);
} else {
    define('LRNTS_API_X_AUTH_TOKAN', $options['lrnts_api_xauthtokan']);
}
/* DEFINE GLOBAL VARIABLE OF PLUGIN */



/* INCLUDE CSS AND JS HOOK - START */
if (!function_exists('lrnts_add_script_style_enqueue_scripts')) {
    
    function lrnts_add_script_style_enqueue_scripts() {
         if ( ! wp_script_is( 'jquery', 'enqueued' )) {
               wp_enqueue_script( 'jquery' );
         }
        
        wp_enqueue_style('lrnts_api_css', LRNTS_PLUGIN_URL . '/css/lrnts_style.css');
        wp_enqueue_script('lrnts_api_js', LRNTS_PLUGIN_URL . '/js/lrnts-ajax.js');
        $image_url = plugins_url('images/pa_process.gif', __FILE__);
        
        $getJsData = array(
            'imageURL' => $image_url,
            'getApiDomain' => LRNTS_API_REGISTRATION,
            'getApiSignin' => LRNTS_API_SIGNIN,
            'getApiForgotPass' => LRNTS_API_FORGOT_PASS,
            'getApiXTokan' => LRNTS_API_X_AUTH_TOKAN
        );
        
        wp_localize_script('lrnts_api_js', 'gatJsVars', $getJsData);
    }
}
add_action('wp_enqueue_scripts', 'lrnts_add_script_style_enqueue_scripts');
/* INCLUDE CSS AND JS HOOK - END */


add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'lrnts_add_plugin_settings_link');

if (!function_exists('lrnts_add_plugin_settings_link')) {
    function lrnts_add_plugin_settings_link($links)  {
        $links[] = '<a href="' . admin_url('options-general.php?page=lrnts-settings-api') . '">' . __('Settings API') . '</a>';
        return $links;
    }
}

add_shortcode('lrnts_signup', 'lrnts_create_signup_form');
add_shortcode('lrnts_signin', 'lrnts_create_signin_form');

include('functions/form-shortcode.php');