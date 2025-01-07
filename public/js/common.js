// Class definition
var CommonFormControls = function () {
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

    var _initChangePasswordForm = function () {
        _changePasswordFormValidations = FormValidation.formValidation(
            document.getElementById('change_password_form'),
            {
                fields: {
                    old_password: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter a password'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password must be at least 6 characters long'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter a password'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password must be at least 6 characters long'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter a confirm password'
                            },
                            identical: {
                                compare: function () {
                                    return $('[name="password"]').val();
                                },
                                message: 'The password and its confirm are not the same',
                            },
                        }
                    }
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                }
            }
        );

        $('#change_password_submit_button').on('click', function (e) {
            e.preventDefault();
            _changePasswordFormValidations.validate().then(function (status) {
                if (status === 'Valid') {
                    $('#change_password_form').submit();
                }
            });
        });
    }

    var _initUpdateEntityProfileForm = function () {
        _updateEntityProfileFormValidations = FormValidation.formValidation(
            document.getElementById('update_entity_profile_form'),
            {
                fields: {
                    company_name:{
                        validators: {
                            notEmpty: {
                                message: 'Entity name is required'
                            },
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            remote: {
                                message: 'This email address is not unique',
                                url: httpPath + 'checkEntityEmailUnique',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    userId: $('#hidden_user_id').val()
                                }
                            }
                        }
                    },
                    authorized_person_first_name: {
                        validators: {
                            notEmpty: {
                                message: 'First & middle name is required'
                            }
                        }
                    },
                    authorized_person_last_name: {
                        validators: {
                            notEmpty: {
                                message: 'Last name is required'
                            }
                        }
                    },
                    authorized_person_gender: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a gender'
                            }
                        }
                    },
                    authorized_person_mobile_number: {
                        validators: {
                            notEmpty: {
                                message: 'Mobile number is required'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'Please enter a valid mobile number'
                            }
                        }
                    },
                    entity_authorized_person_support_document_hidden: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload document'
                            }
                        }
                    },
                    authorized_person_designation: {
                        validators: {
                            notEmpty: {
                                message: 'Designation/Status is required'
                            }
                        }
                    },
                    authorized_person_mobile_number_2: {
                        validators: {
                            notEmpty: {
                                message: 'Mobile Number Of Contact Person is required'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'Please enter a valid mobile number'
                            }
                        }
                    },
                    entity_authorized_person_signature_hidden: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload a signature'
                            }
                        }
                    },
                    company_address:{
                        validators:{
                            notEmpty:{
                                message:'Please Enter Address'
                            }
                        }
                    }
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                }
            }
        );

        $('#update_entity_profile_submit_button').on('click', function (e) {
            e.preventDefault();
            _updateEntityProfileFormValidations.validate().then(function (status) {
                if (status === 'Valid') {
                    $('#update_entity_profile_form').submit();
                }
            });
        });
    }

    var _initBuildingCompanyApplicationDataFilterForm = function () {
        _BuildingCompanyApplicationDataFilterFormValidations = FormValidation.formValidation(
            document.getElementById('building_companies_applications_data_filter_form'),
            {
                fields: {
                    filter_building:{
                        validators: {
                            notEmpty: {
                                message: 'Select a Building'
                            },
                        }
                    },
                    filter_company:{
                        validators: {
                            notEmpty: {
                                message: 'Select a Company'
                            },
                        }
                    }
                    
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                }
            }
        );

        // $('#building_companies_applications_data_filter_submit_button').on('click', function (e) {
        //     e.preventDefault();
        //     _BuildingCompanyApplicationDataFilterFormValidations.validate().then(function (status) {
        //         if (status === 'Valid') {
        //             $('#building_companies_applications_data_filter_form').submit();
        //         }
        //     });
        // });

        $('#building_companies_applications_data_filter_submit_button').on('click', function (e) {
            _BuildingCompanyApplicationDataFilterFormValidations.validate().then(function (status) {
                if (status == 'Valid') {
                    var formData = $('#building_companies_applications_data_filter_form').serialize();
                    var LiqourApplicationVerifyAndSubmitDetailSubmitButton = KTUtil.getById('building_companies_applications_data_filter_submit_button');
                    $.blockUI({ 
                        message: 'Please wait...', 
                        overlayCSS: { 
                            backgroundColor: '#000', 
                            opacity: 0.6, 
                            cursor: 'wait' 
                        }, 
                        css: { 
                            border: 0, 
                            padding: 0, 
                            backgroundColor: 'transparent' 
                        } 
                    });
                    $.ajax({
                        url: $('#building_companies_applications_data_filter_form').attr('action'),
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {
                            // Show loading state on button
                            KTUtil.btnWait(LiqourApplicationVerifyAndSubmitDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                        },
                        
                        complete: function () {
                            KTUtil.btnRelease(LiqourApplicationVerifyAndSubmitDetailSubmitButton);
                            $.unblockUI();
                        },
                        // xhrFields: {
                        //     // Specify that the response should be treated as a binary file
                        //     responseType: 'blob'
                        // },
                        success: function (response) {
                            console.log(response);
                            if(response.result == true)
                            {
                                var binary = atob(response.buildingCompanyApplicationsData.data);
                                var array = new Uint8Array(binary.length);
                                for (var i = 0; i < binary.length; i++) {
                                    array[i] = binary.charCodeAt(i);
                                }
        
                                // Create a Blob from the array
                                var file = new Blob([array], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
        
                                // Create a download link and trigger the download
                                var fileURL = URL.createObjectURL(file);
                                var a = document.createElement('a');
                                a.href = fileURL;
                                a.download = 'applications-excel.xlsx';
                                document.body.appendChild(a);
                                a.click();
                                document.body.removeChild(a);
    
                                $('#building_companies_applications_data_filter_form').trigger('reset');
                                $('#building_companies_applications_data_filter_form select').removeClass('is-valid');
                                $('#building_companies_applications_data_filter_form select').removeClass('is-invalid');
                                $('#buidlingcompaniesDataFilterModal').modal('hide');
                            }
                            else
                            {
                                showReportSwalAlert({ alertType: 'error', message: 'No application data found!', isScrollUp: 'Yes', callFor: '' });
                            }
                            
                            
                            
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveApplicationDetail' });
                        }
                    });
                } else {
                    KTUtil.scrollTop();
                    return false;
                }
            });
        });
    }

    

    return {
        // public functions
        init: function () {
            if ($('#change_password_form').length) {
                _initChangePasswordForm();
            }

            if ($('#update_entity_profile_form').length) {
                _initUpdateEntityProfileForm();
            }

            if ($('#building_companies_applications_data_filter_form').length) {
                _initBuildingCompanyApplicationDataFilterForm();
            }

        }
    };
}();

jQuery(document).ready(function () {
    // Other code

    CommonFormControls.init();

    $('.country-option').change(function () {
        var selectedOption = $(this).find('option:selected');
        var country_id = selectedOption.data('id');
        $('.state-option').html('<option value="">-- Select --</option>');
        $('.city-option').html('<option value="">-- Select --</option>');

        if (country_id > 0) {
            $.ajax({
                url: httpPath + 'common/getStateOptionFromSelectedCountry',
                type: 'POST',
                data: { country_id: country_id },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {

                },
                complete: function () {

                },
                success: function (response) {
                    if (response.html) {
                        $('.state-option').html(response.html);
                    }
                },
                error: function (xhr) {
                    showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', callFor: 'common' });
                }
            });
        }

    });

    $('.state-option').change(function () {
        var selectedOption = $(this).find('option:selected');
        var state_id = selectedOption.data('id');
        $('.city-option').html('<option value="">-- Select --</option>');

        if (state_id > 0) {
            $.ajax({
                url: httpPath + 'common/getCityOptionFromSelectedState',
                type: 'POST',
                data: { state_id: state_id },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {

                },
                complete: function () {

                },
                success: function (response) {
                    if (response.html) {
                        $('.city-option').html(response.html);
                    }
                },
                error: function (xhr) {
                    showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', callFor: 'common' });
                }
            });
        }
    });



});


/**
 * Functions for show success or error alert box
 */
function showReportSwalAlert(params) {
    var message = params.message;
    var alertType = params.alertType;
    var callFor = params.callFor;
    var isScrollUp;
    if (params.isScrollUp) {
        isScrollUp = params.isScrollUp;
    }
    Swal.fire({
        html: message,
        icon: alertType,
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: "btn font-weight-bolder btn-warning"
        }
    }).then(function () {
        if (params.redirectPage) {
            window.location.href = params.redirectPage;
        } else {
            if (params.tabeId) {
                $('#' + params.tabeId).trigger('click');
            }
            if (isScrollUp == 'Yes') {
                KTUtil.scrollTop();
            }
        }
    });
}

function blockUnBlockUiForProcess(params) {
    var blockId = params.blockId;
    var callFor = params.callFor;
    if (callFor == 'Block') {
        KTApp.block('#' + blockId, {
            overlayColor: '#000000',
            state: 'primary',
            message: 'Please wait...'
        });
    } else {
        KTApp.unblock('#' + blockId);
    }
}

function openConfirmMessageForDelete(params) {
    var confirmMessage = params.message;
    var actionType = params.actionType;
    var actionUrl = params.url;
    Swal.fire({
        title: "Are you sure?",
        text: confirmMessage,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn font-weight-bolder btn-warning",
            cancelButton: "btn font-weight-bolder btn-light-dark"
        }
    }).then(function (result) {
        if (result.value) {
            if (actionType == 'redirect') {
                window.location.href = actionUrl;
            }
        }
    });
}

function set_country_code(control, country_code) {
    var input = document.querySelector("."+control);
    var errorMsg = document.querySelector("#"+control+"-error-msg");
    var validMsg = document.querySelector("#"+control+"-valid-msg");

    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
    

    window.addEventListener("load", function () {
      
      
        var errorMsg = document.querySelector("#"+control+"-error-msg");
      
      function getIp(callback) {
       fetch('https://ipinfo.io', { headers: { 'Accept': 'application/json' }})
         .then((resp) => resp.json())
         .catch(() => {
           return {
             country: '',
           };
         })
         .then((resp) => callback(resp.country));
      }
        
        var iti = window.intlTelInput(input, {
                    formatOnDisplay: true,
                    autoInsertDialCode:true,
                    autoHideDialCode: true,
                    initialCountry: country_code,
                    separateDialCode: "false",
                    geoIpLookup: getIp,
                    utilsScript: httpPath + "js/utils.js",
              });
 
        
        input.addEventListener('keyup', formatIntlTelInput);
        input.addEventListener('change', formatIntlTelInput);
      
        function formatIntlTelInput() {
            if (typeof intlTelInputUtils !== 'undefined') { // utils are lazy loaded, so must check
                var currentText = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                if (typeof currentText === 'string') { // sometimes the currentText is an object :)
                    iti.setNumber(currentText); // will autoformat because of formatOnDisplay=true
                }
            }
        }
         
        
               
        input.addEventListener('keyup', function () {     
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
        $(input).addClass('form-control is-valid');
                        
                } else {                  
                    $(input).addClass('form-control is-invalid');
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];                   
                    $(errorMsg).show();
                }
            }

            
        });        
        input.addEventListener('change', reset);        
        input.addEventListener('keyup', reset);
        
        var reset = function () {
            $(input).removeClass('is-invalid');
            errorMsg.innerHTML = "";
            $(errorMsg).hide();
        
        };
        
      ////////////// testing - start //////////////
      
    //   input.addEventListener('keyup', function(e) {
    //     e.preventDefault();
    //     var num = iti.getNumber(),
    //         valid = iti.isValidNumber();
    //         validMsg.textContent = "Number: " + num + ", valid: " + valid;
    //   }, false);
      
      input.addEventListener("focus", function() {
        validMsg.textContent = "";
      }, false);
          
        
        $(input).on("focusout", function(e, countryData) {
            var intlNumber = iti.getNumber();
            console.log(intlNumber);   
        });
    });
          
          
        //-----------------------only-phone-number-input code (with +)-------------------------------start-------// 
         
    // var iti = window.intlTelInput(input, {
    //     formatOnDisplay: true,
    //     initialCountry: country_code,
    //     separateDialCode: "false",
    //     utilsScript: httpPath + "js/utils.js",
        
    // });


    // var reset = () => {
       
    //     input.classList.remove("error");
    //     errorMsg.innerHTML = "";
    //     errorMsg.classList.add("hide");
    //     validMsg.classList.add("hide");
    // };
    
    // input.addEventListener('blur', () => {
    //     reset();
    //         if (input.value.trim()) {
    //             if (iti.isValidNumber()) {
    //             validMsg.classList.remove("hide");
    //             } else {
    //             input.classList.add("error");
    //             var errorCode = iti.getValidationError();
    //             errorMsg.innerHTML = errorMap[errorCode];
    //             errorMsg.classList.remove("hide");
    //             }
    //         }
    // });

    //   // on keyup / change flag: reset
    // input.addEventListener('change', reset);
    // input.addEventListener('keyup', reset);
}





var KTBootstrapMaxlength = function () {

    // Private functions
    var demos = function () {
        // minimum setup
        $('.maxlengthclass').maxlength({
            warningClass: "label label-warning label-rounded label-inline",
            limitReachedClass: "label label-success label-rounded label-inline",
        });
    }
   
    return {
        // public functions
        init: function() {
            demos();
        },
        
    };
}();

jQuery(document).ready(function() {
    KTBootstrapMaxlength.init();

});


$('#super_admin_buidling_companies_filter_modal').on('click',function(){
    $('#buidlingcompaniesDataFilterModal').modal('show');
});