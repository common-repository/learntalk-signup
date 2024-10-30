<?php
add_action('admin_menu', 'lrnts_api_add_admin_menu');
add_action('admin_init', 'lrnts_api_settings_init');


if (!function_exists('lrnts_api_add_admin_menu')) {
    
    function lrnts_api_add_admin_menu() {
        add_options_page('Learntalk API', 'Learntalk API', 'manage_options', 'lrnts-settings-api', 'lrnts_api_options_page');
    }
}


if (!function_exists('lrnts_api_settings_init')) {
    
    function lrnts_api_settings_init()  {
        register_setting('lrntsApiPlugin', 'lrnts_api_settings');
        add_settings_section('lrnts_api_lrntsApiPlugin_section', __('', 'lrntsApiPlugin'), 'lrnts_api_settings_section_callback', 'lrntsApiPlugin');
        
        add_settings_field('lrnts_signup_api', __('Signup API ', 'lrntsApiPlugin'), 'lrnts_signup_render', 'lrntsApiPlugin', 'lrnts_api_lrntsApiPlugin_section');
        
        add_settings_field('lrnts_signin_api', __('Signin API', 'lrntsApiPlugin'), 'lrnts_signin_render', 'lrntsApiPlugin', 'lrnts_api_lrntsApiPlugin_section');
        
        add_settings_field('lrnts_api_forgotpass', __('Forgot password API', 'lrntsApiPlugin'), 'lrnts_api_forgotpass_render', 'lrntsApiPlugin', 'lrnts_api_lrntsApiPlugin_section');
        
        add_settings_field('lrnts_api_xauthtokan', __('X-Auth-Tokan', 'lrntsApiPlugin'), 'lrnts_api_xauthtokan_render', 'lrntsApiPlugin', 'lrnts_api_lrntsApiPlugin_section');
        
        
    }
}

function lrnts_signup_render(){
    $options = get_option('lrnts_api_settings');
    
    if (empty($options['lrnts_signup_api'])) {
        $lrnts_signup_api = LRNTS_API_REGISTRATION_DEFAULT;
    } else {
        $lrnts_signup_api = $options['lrnts_signup_api'];
    }
?>
 <input type='text' name='lrnts_api_settings[lrnts_signup_api]' placeholder="Enter signup api" style="width:350px" value='<?php echo $lrnts_signup_api;?>'>
  
    <?php
}

function lrnts_signin_render(){
    $options = get_option('lrnts_api_settings');
    if (empty($options['lrnts_signin_api'])) {
        $lrnts_signin_api = LRNTS_API_SIGNIN_DEFAULT;
    } else {
        $lrnts_signin_api = $options['lrnts_signin_api'];
    } ?>
 
  <input type='text' name='lrnts_api_settings[lrnts_signin_api]' placeholder="Enter signin api" style="width:350px"  value='<?php echo $lrnts_signin_api;?>'>
<?php } 

function lrnts_api_forgotpass_render(){
    $options = get_option('lrnts_api_settings');
    if (empty($options['lrnts_api_forgotpass'])) {
        $lrnts_api_forgotpass = LRNTS_API_FORGOT_PASS_DEFAULT;
    } else {
        $lrnts_api_forgotpass = $options['lrnts_api_forgotpass'];
    }
?>
 
  <input type='text' name='lrnts_api_settings[lrnts_api_forgotpass]' placeholder="Enter forgot password api"  style="width:350px" value='<?php echo $lrnts_api_forgotpass;?>'>
    <?php
}
function lrnts_api_xauthtokan_render(){
    
    $options = get_option('lrnts_api_settings');
    if (empty($options['lrnts_api_xauthtokan'])) {
        $lrnts_api_xauthtokan = LRNTS_API_X_AUTH_TOKAN_DEFAULT;
    } else {
        $lrnts_api_xauthtokan = $options['lrnts_api_xauthtokan'];
    } ?>
 
  <input type='text' name='lrnts_api_settings[lrnts_api_xauthtokan]' placeholder="Enter X-Auth-Tokan"  style="width:350px" value='<?php  echo $lrnts_api_xauthtokan;?>'>

<?php
}

function lrnts_api_settings_section_callback(){
    echo __('Please add signup, signin and forgot password API.', 'lrntsApiPlugin');
}

if (!function_exists('lrnts_api_options_page')) {
    
    function lrnts_api_options_page() {
        settings_errors('lrntsApiPlugin_messages');
?>
       <form action='options.php' method='post'>
            <h2>Learntalk API Settings </h2>

<?php

        settings_fields('lrntsApiPlugin');
        do_settings_sections('lrntsApiPlugin');
        submit_button();
?>

        </form>
    <div class="notice notice-info ">
        <p>Please use this shortcode for <strong>Signup</strong> form</p>
        <code> [lrnts_signup] </code>
        <p></p>
        <p>Please use this shortcode for <strong>Signin</strong> form</p>
       <code> [lrnts_signin] </code>
        <p></p>
    </div>
<?php
    }
}