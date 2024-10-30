<?php
if (!function_exists('lrnts_create_signup_form')) {
    function lrnts_create_signup_form()  {
        $form = '';
        
        $form .= '<div class="header-signup signupForm">
                <div class="error_msg_signup error_msg"></div>
                <div class="success_msg_signup success_msg"></div>
            
                <form  action="" class="form-horizontal regform-en"  id="new_user" method="post">
                
                    <div class="lrnts-form-group">
                        <div class="lrnts_field"><input class="form-control input-lg"  id="lrnts_name" name="lrnts_name" placeholder="Name" type="text" required></div>
                    </div>

                    <div class="lrnts-form-group">
                        <div class="lrnts_field"><input class="form-control input-lg" id="lrnts_email" name="lrnts_email" placeholder="E-mail address" type="email" required></div>
                    </div>

                    <div class="lrnts-form-group">
                        <div class="lrnts_field"><input class="form-control input-lg" id="lrnts_password" name="lrnts_password" placeholder="Password" type="password" required></div>
                    </div>
                    <div class="lrnts-form-group">
                        <div class="lrnts_field"><input class="form-control input-lg" id="lrnts_password_confirmation" name="lrnts_password_confirmation" placeholder="Confirm Password" type="password" required></div>
                    </div>

                    <div class="lrnts-form-group">
                        <div class="lrnts_field">
                            <button id="lrnts_submit_signup" class="btn" type="submit">Sign up</button>
                            </div>
                    </div>

                </form>
                <div class="loading_gif"></div>
            </div>';
        
        return $form;
        
    }
}

if (!function_exists('lrnts_create_signin_form')) {
    function lrnts_create_signin_form() {
        $signin_form = '';
        
        $signin_form .= '<div class="header-signup signingForm">
                    <div class="error_msg_signin error_msg"></div>
                    <div class="success_msg_signin success_msg"></div>
                <form  action="" class="form-horizontal regform-en"  id="signin_user" method="post" novalidate="true">
                
                        <div class="lrnts-form-group">
                            <div class="lrnts_field"><input class="form-control input-lg" id="lrnts_email_signin" name="lrnts_email" placeholder="E-mail address" type="email" required>
                            </div>
                        </div>

                        <div class="lrnts-form-group">
                            <div class="lrnts_field"><input class="form-control input-lg" id="lrnts_password_signin" name="lrnts_password" placeholder="Password" type="password" required>
                            </div>
                        </div>
                        
                        <div class="lrnts-form-group submit-row">
                            <div class="lrnts_field">
                                <button id="lrnts_submit_signin" class="btn" type="submit">Sign in</button>
                            </div>
                            <div class="forgot-link">
                         <a href="javascript:void(0);" class="forgot_pass_link" onclick="forgot_pass_fun()">Forgot Password?</a>
                            </div>
                        </div>
                </form>
                
                <div class="error_msg_fp error_msg"></div>
                <div class="success_msg_fp success_msg"></div>

                <form action="" class="form-horizontal regform-en"  id="forgot_pass" method="post" style="display:none">
                
                        <div class="forgot_pass_title">
                        <p>Forgot Password?</p>
                        </div>
                        <div class="forgot_pass_subtitle">
                        <p>Provide your email address and instructions to reset your password will be sent to you.</p>
                        </div>
                        <div class="lrnts-form-group">
                            <div class="lrnts_field"><input class="form-control input-lg" id="lrnts_forgot_email" name="lrnts_forgot_email" placeholder="E-mail address" type="email" required>
                            </div>
                        </div>

                        <div class="lrnts-form-group submit-row">
                            <div class="lrnts_field">
                                <button id="lrnts_submit_forgot" class="btn" type="submit">Submit</button>
                            </div>
                            <div class="lrnts_field">
                                <a href="javascript:void(0);" id="cancel_forgot" class="btn" >Cancel</a>
                            </div>
                        </div>
                    
                </form>
                    <div class="loading_gif"></div>
            </div>';
        
        return $signin_form;
    }
}

include('settings-api.php');