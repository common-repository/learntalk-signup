/* Ajax call to send form data */
function forgot_pass_fun() {
    jQuery('.error_msg').html('');
    jQuery('form#signin_user').hide();
    jQuery('form#forgot_pass').show();
}

function lrnts_loading_open(parentClass, imgurl) {
    $this = jQuery('.' + parentClass + ' .loading_gif');
    $this.show();
    $this.css("background", "white url(" + imgurl + ")");
    $this.addClass('loading_lrnts');
    jQuery('.error_msg').html('');
    jQuery('.success_msg').html('');
    

}

function lrnts_loading_close(parentClass) {
    $this = jQuery('.' + parentClass + ' .loading_gif');
    $this.css('background', '');
    $this.hide();
    $this.removeClass('loading_lrnts');

}

jQuery(document).ready(function(jQuery) {
    var imgurl = gatJsVars.imageURL;
    var apiDomain = gatJsVars.getApiDomain;
    var apiSignIn = gatJsVars.getApiSignin;
    var apiForgtoPass = gatJsVars.getApiForgotPass;
    var apiXTokan = gatJsVars.getApiXTokan;

    jQuery('button#forgot_pass').hide();

    jQuery('a#cancel_forgot').click(function() {
        jQuery('.error_msg').html('');
        jQuery('#lrnts_forgot_email').val('');
        jQuery('form#forgot_pass').hide();
        jQuery('form#signin_user').show();
        jQuery('.success_msg').html('');
    });

    jQuery('#lrnts_submit_forgot').click(function(e) {
        e.preventDefault();
        lrnts_loading_open('signingForm', imgurl);
        var email = jQuery('#lrnts_forgot_email').val();

        jQuery.ajax({
            type: 'GET',
            url: apiForgtoPass,
            dataType: 'json',
            async: true,
            tokan:apiXTokan,
            data: {
                email: email,
            },
           
            success: function(response) {
                if (response.error) {

                    jQuery('.error_msg_fp').append('<p>' + response.error + '</p>');

                } else {

                    if (response.status == 200) {
                        jQuery('.success_msg_fp').append('<p>' + response.message + '</p>');
                        jQuery('#lrnts_forgot_email').val('');

                    }
                }
                lrnts_loading_close('signingForm');
            },
            error: function(data) {
                if (email == '') {
                    jQuery('.error_msg_fp').html('');
                    jQuery('.error_msg_fp').append('<p>Please enter email id</p>');
                } else {
                    if (data.statusText == 'error') {
                        jQuery('.error_msg_fp').append('<p>Email id is not found</p>');
                    }

                }

                lrnts_loading_close('signingForm');
            }
        });
    });



    jQuery('#lrnts_submit_signup').click(function(e) {
        e.preventDefault();
      
        var firstName = jQuery('#lrnts_name').val();
        var email = jQuery('#lrnts_email').val();
        var password = jQuery('#lrnts_password').val();
        var password_confirmation = jQuery('#lrnts_password_confirmation').val();
        if(email==''){
              jQuery('.error_msg').html('');
              jQuery('.success_msg').html('');
            jQuery('.error_msg_signup').append('<p>Please fill up blank fields</p>');
            return false;
        }
          lrnts_loading_open('signupForm', imgurl);
        jQuery.ajax({
            type: 'POST',
            url: apiDomain,
            dataType: 'json',
            async: true,
            tokan:apiXTokan,
            data: {
                'user[first_name]': firstName,
                'user[email]': email,
                'user[password]': password,
                'user[password_confirmation]': password_confirmation,
                fb_timezone: '-5',

            },
            success: function(response) {
                if (response.userErrors) {

                    if (firstName == '' || email == '') {
                        jQuery('.error_msg_signup').append('<p>' + response.userErrors['first_name'] + '</p>');
                    }
                
                    if (response.userErrors['email']) {
                        jQuery('.error_msg_signup').append('<p>' + response.userErrors['email'] + '</p>');
                    }

                    if (response.userErrors['password']) {
                        jQuery('.error_msg_signup').append('<p>' + response.userErrors['password'] + '</p>');
                    }

                    if (response.userErrors['password_confirmation']) {
                        jQuery('.error_msg_signup').append('<p>' + response.userErrors['password_confirmation'] + '</p>');
                    }

                } else {

                    if (response.user['auto_login'] !== '' || response.user['auth_token'] !== null) {
                        jQuery('.success_msg_signup').append('<p>Registration Successfully...</p>');
                        $redirect_url = response.user['auto_login'];
                        window.location.href = $redirect_url;
                    }
                }
                lrnts_loading_close('signupForm');
            },
            error: function(data) {

                if (data.statusText == 'error') {
                    jQuery('.error_msg_signup').append('<p>Please fillup blank fields</p>');
                }
                lrnts_loading_close('signupForm');
            }
        });

    });


    jQuery('#lrnts_submit_signin').click(function(e) {
        e.preventDefault();

        lrnts_loading_open('signingForm', imgurl);
        var email = jQuery('#lrnts_email_signin').val();
        var password = jQuery('#lrnts_password_signin').val();

        jQuery.ajax({
            type: 'POST',
            url: apiSignIn,
            dataType: 'json',
            async: true,
            tokan:apiXTokan,
            data: {
                'user[email]': email,
                'user[password]': password,
            },

            success: function(result) {
                if (result.base) {
                    if (email == '' || password == '') {
                        jQuery('.error_msg_signin').append('<p>Please fill up blank fields</p>');
                    } else {
                        jQuery('.error_msg_signin').append('<p>' + result.base + '</p>');
                    }

                } else {
                    if (result.user['auto_login'] !== '' || result.user['auth_token'] !== null) {
                        jQuery('.success_msg_signin').append('<p>Login Successfully...</p>');
                        $redirect_url = result.user['auto_login'];
                        window.location.href = $redirect_url;
                    }
                }
                lrnts_loading_close('signingForm');
            },
            error: function(data) {
              // console.log(data);
                if (data.statusText == 'error') {
                    jQuery('.error_msg_signin').append('<p>Something went wrong...</p>');
                }

                lrnts_loading_close('signingForm');
            }
        });

    });
});