"use strict";

// Class Definition
var KTLogin = function() {
	
	var _login;
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;
		var formSubmitButton = KTUtil.getById('kt_login_signin_submit');
		var formObj = KTUtil.getById('kt_login_signin_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			formObj,
			{
				fields: {
					login: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							regexp: {
								regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,20})$/i,
								message: 'Enter valid email adress'
							}
							
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Password is required'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		).on('core.form.valid', function () {
			var formData =  $('#kt_login_signin_form').serialize();
			$.ajax({
				url: httpPath+'login',
				type: 'POST',
				data: formData,
				beforeSend: function(){
                    // Show loading state on button
					KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                },
				complete: function(){
                    KTUtil.btnRelease(formSubmitButton);
                },
				success: function (response) {
					window.location.href = 'welcome';
					console.log(response);
				},
				error: function(xhr){
					console.log(xhr);
					if (xhr.status == 422) {
						var errorResponse = xhr.responseJSON;
						// Display error message to the user
						Swal.fire({
								text: errorResponse.error,
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn font-weight-bold btn-light-primary"
								}
							}).then(function() {
								$('.form-control').removeClass('is-valid');
								KTUtil.scrollTop();
							});
					} else {
						alert('Sorry, something went wrong, please try again.');
					}
					// alert('Sorry, something went wrong, please try again.');
                    // Swal.fire({
					// 	text: "Sorry, something went wrong, please try again.",
					// 	icon: "error",
					// 	buttonsStyling: false,
					// 	confirmButtonText: "Ok, got it!",
					// 	customClass: {
					// 		confirmButton: "btn font-weight-bold btn-light-primary"
					// 	}
					// }).then(function() {
					// 	$('.form-control').removeClass('is-valid');
					// 	KTUtil.scrollTop();
					// });
                }
			});
		}).on('core.form.invalid', function () {
			alert('Sorry, looks like there are some errors detected, please try again.');
			// Swal.fire({
			// 	text: "Sorry, looks like there are some errors detected, please try again.",
			// 	icon: "error",
			// 	buttonsStyling: false,
			// 	confirmButtonText: "Ok, got it!",
			// 	customClass: {
			// 		confirmButton: "btn font-weight-bold btn-light-primary"
			// 	}
			// }).then(function () {
			// 	KTUtil.scrollTop();
			// });
		});
        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });
    }

    var _handleForgotForm = function(e) {
        var forgotValidation;
		var formSubmitButton = KTUtil.getById('kt_login_forgot_submit');
		var formObj = KTUtil.getById('kt_login_forgot_form');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        forgotValidation = FormValidation.formValidation(
			formObj,
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Email address is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		).on('core.form.valid', function () {			
			var forgotFormData =  $('#kt_login_forgot_form').serialize();
			$.ajax({
				url: httpPath+'forgotPassword',
				type: 'POST',
				data: forgotFormData,
				beforeSend: function(){
                    // Show loading state on button
					KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                },
				complete: function(){
                    KTUtil.btnRelease(formSubmitButton);
                },
				success: function (response) {
					if(response.result){
						Swal.fire({
							text: response.message,
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						}).then(function() {
							KTUtil.scrollTop();
							$('#kt_login_forgot_form')[0].reset(); // clear form
							$('#kt_login_signin_form')[0].reset(); // clear form
							_showForm('signin');
						});
                    } else {
						Swal.fire({
							text: response.message,
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						}).then(function() {
							$('.form-control').removeClass('is-valid');
							KTUtil.scrollTop();
						});
                    }
				},
				error: function(xhr){
                    Swal.fire({
						text: "Sorry, something went wrong, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					}).then(function() {
						$('.form-control').removeClass('is-valid');
						KTUtil.scrollTop();
					});
                }
			});
		}).on('core.form.invalid', function () {
			Swal.fire({
				text: "Sorry, looks like there are some errors detected, please try again.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function () {
				KTUtil.scrollTop();
			});
		});
		/*forgotValidation.validate().then(function(status) {
			if (status == 'Valid') {
				// Submit form
				KTUtil.scrollTop();
			} else {
				swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					KTUtil.scrollTop();
				});
			}
		});*/

        // Handle submit button
        /*$('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();
			validation = FormValidation.formValidation(
			formObj,
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Email address is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			});
            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    // Submit form
                    KTUtil.scrollTop();
				} else {
					swal.fire({
		                text: "Sorry, looks like there are some errors detected, please try again.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });*/

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleForgotForm();
        }
    };
}();

//Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();

});





