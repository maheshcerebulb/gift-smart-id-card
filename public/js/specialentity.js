"use strict";
// Class definition
var SpecialEntityApplicationFormControls = function () {
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
    var specialentityApplicationDetailTabId = 'tab-special-entity-application-detail';
    var specialentityApplicationVerifyAndSubmitDetailTabId = 'tab-special-entity-application-verify-and-submit-detail';
    var _specialentityApplicationDetailFormValidations;
    var _specialentityApplicationVerifyAndSubmitDetailFormValidations;
	var _specialentityApplicationDepartmentFormValidations;
    var _specialentitySearchApplicationFormValidations;
    var _specialentitySurrenderApplicationFormValidations;
    $('.datepicker').datepicker({
        maxDate: 0,
        format: 'dd-mm-yyyy',
        todayHighlight: true, // Highlight today's date
        endDate: new Date(),
        setDate: new Date(),
        autoclose: true
    });

    
    $('#special_entity_application_tab a').on('click', function (e) {
        e.preventDefault();
        // If click on other tab
        if (!$(this).hasClass("active")) {
            if (this.id == specialentityApplicationVerifyAndSubmitDetailTabId) {
                if ($('#is_special_entity_application_detail_valid').val() != 'Yes') {
                    _specialentityApplicationDetailFormValidations.validate();
                    showReportSwalAlert({ alertType: 'error', message: 'Sorry, looks like special entity details is not submitted. Please complete it first.', isScrollUp: 'Yes', callFor: 'tabValidation', tabeId: '' + specialentityApplicationDetailTabId + '' });
                } else {
                    KTUtil.scrollTop();
                }
            }
            else {
                KTUtil.scrollTop();
            }
        }
        else {
            return false;
        }
    });

    $('.step-back-button').on('click', function (e) {
        var clickAttribute = $(this).attr('back-for');
        $('#' + clickAttribute).trigger('click');
        KTUtil.scrollTop();
    });

   
    // var currentDate = new Date().toISOString().split('T')[0];
    // console.log(currentDate);
    // $('.date').attr('max', currentDate);

    var _initSpecialEntityApplicationDetailForm = function () {
        _specialentityApplicationDetailFormValidations = FormValidation.formValidation(
            document.getElementById('special_entity_application_detail_form'),
            {
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: {
                                message: 'First name is required'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                            notEmpty: {
                                message: 'Last name is required'
                            }
                        }
                    },
                    gender: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a gender'
                            }
                        }
                    },
                    type: {
                        validators: {
                            notEmpty: {
                                message: 'Please select application type'
                            }
                        }
                    },
					application_department: {
                        validators: {
                            notEmpty: {
                                message: 'Please select department'
                            }
                        }
                    },
                    other_entity: {
                        validators: {
                            notEmpty: {
                                message: 'Entity name is required'
                            }
                        }
                    },
                    mobile_number: {
                        validators: {
                            notEmpty: {
                                message: 'Mobile number is required'
                            },
                            // regexp: {
                            //     regexp: /^[0-9]{10}$/,
                            //     message: 'Please enter a valid 10-digit mobile number'
                            // }
                        }
                    },

                    designation: {
                        validators: {
                            notEmpty: {
                                message: 'Designation is required'
                            },
                            stringLength: {
                                max: 30,
                                message: 'Designation must be less than or equal to 15 characters'
                            }
                        }
                    },
                    date_of_birth: {
                        validators: {
                            notEmpty: {
                                message: 'Date of birth is required'
                            },
                            callback: {
                                message: 'Person must be 18 years or older',
                                callback: function(input) {
                                    var dob = input.value;
                                    var dobParts = dob.split("-"); // Splitting the DOB string into day, month, and year
                                    var dobDate = new Date(dobParts[2], dobParts[1] - 1, dobParts[0]); // Year, month (0-indexed), day
                                    var today = new Date();
                                    // Calculate the age
                                    var age = today.getFullYear() - dobDate.getFullYear();
                                 
                                    // Check if the birthday has occurred this year
                                    var hasBirthdayOccurred = (today.getMonth() > dobDate.getMonth()) || 
                                                              (today.getMonth() === dobDate.getMonth() && today.getDate() >= dobDate.getDate());
                                    // Adjust age if the current month and day haven't passed the birth month and day yet
                                    if (!hasBirthdayOccurred) {
                                        age--;
                                    }
                                 
                                    // Check if the age is 18 or older
                                    if (age < 18) {
                                        return false;
                                    } else if (age === 18) {
                                        // Check if the birth date is less than 18 years ago
                                        var birthDateThisYear = new Date(today.getFullYear() - 18, dobDate.getMonth(), dobDate.getDate());
                                        if (dobDate > birthDateThisYear) {
                                            return false;
                                        }
                                    }
                                 
                                    return true;
                                }
                            }
                        }
                    },                    
                    special_image_hidden: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload image'
                            }
                        }
                    },
                    special_signature_hidden: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload singature'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            regexp: {
								regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i,
								message: 'Enter valid email adress'
							},
                            remote: {
                                message: 'This email address is not unique',
                                url: function(validator) {
                                    // Check application_type or entity_type condition
                                    if (application_type == 1 && entity_type == 1) {
                                        // If both conditions are true, do not call the remote validator
                                        return 'javascript:void(0)';
                                    } else {
                                        // Otherwise, call the remote validator
                                        return httpPath + 'checkEntityApplicationEmailUnique';
                                    }
                                },
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    userId: $('.special-entity-application-user-id').val()
                                }
                            }
                        }
                    },
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    //submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );


        $('#special_date_of_birth').on('changeDate', function() {
            // Trigger validation
            _specialentityApplicationDetailFormValidations.revalidateField('special_date_of_birth');
        });
    }



    var image_options = {
        init_no: 1,
        field_selector: 'special_image',
        file_name_hidden_field: 'special_image_hidden',
        max_files: 1,
        max_file_size: 0.050,
        accepted_files: '.png,.jpg,.jpeg',
    };
    initSpecialDropZoneFiles(image_options);

    var signature_upload_options = {
        init_no: 2,
        field_selector: 'special_signature',
        file_name_hidden_field: 'special_signature_hidden',
        max_files: 1,
        max_file_size: 0.050,
        accepted_files: '.png,.jpg,.jpeg',
    };
    initSpecialDropZoneSignatureFiles(signature_upload_options);
    function initSpecialDropZoneFiles(req_data) {
        $("#" + req_data['field_selector']).dropzone({
            url: "upload-file", // This can be any value since we won't actually upload to the server
            paramName: "file",
            maxFiles: req_data['max_files'],
            maxFilesize: req_data['max_file_size'],
            uploadMultiple: false,
            acceptedFiles: req_data['accepted_files'],
            addRemoveLinks: true,
            dictMaxFilesExceeded: "You can not upload more than {{maxFiles}} files.",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            accept: function(file, done) {
                const _URL = window.URL || window.webkitURL;
                    const img = new Image();
                    img.onload = function() {
                        if (img.width >= 120 && img.width <= 140 && img.height >= 170 && img.height <= 190) {
                            done();
                        } else {
                            done("The image dimensions are too small. Minimum dimensions are 130 PX x 180 PX or 3.5 CM x 4.5 CM.");
                        }
                    };
                    img.onerror = function() {
                        done("Invalid image file.");
                    };
                    img.src = _URL.createObjectURL(file);
            },
            init: function () {
                this.on("success", function (file, message, xhr) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $('#previous_special_image_hidden').val('');
                        $('#old_special_image').prop('src','');
                        $('#old_special_image').remove();
                        $('#special-image-remove-btn').remove();
                        $("#" + req_data['file_name_hidden_field']).val(event.target.result);
                        // var removeButton = Dropzone.createElement('<button class="btn btn-danger btn-remove-image">Remove Image</button>');
                        file.previewElement.querySelector(".dz-remove").addEventListener('click', function () {
                            // Remove the file from Dropzone
                            $("#" + req_data['file_name_hidden_field']).val("");
                            // Clear the input field value
                        });
                        // Append the remove button to the file preview
                    };
                    reader.readAsDataURL(file);
                });
                this.on("error", function (file, message, xhr) {
                    this.removeFile(file);
                    var message_line = '';
                    if (message.message) {
                        message_line = message.message
                    } else {
                        message_line = message;
                    }
                    showReportSwalAlert({ alertType: 'error', message: message_line, callFor: 'common' });
                });

                this.on("removedfile", function (file) {
                    // Use dropzoneInstance to refer to the Dropzone instance
                });
            }
        });
    }
    function initSpecialDropZoneSignatureFiles(req_data) {
        $("#" + req_data['field_selector']).dropzone({
            url: "upload-file", // This can be any value since we won't actually upload to the server
            paramName: "file",
            maxFiles: req_data['max_files'],
            maxFilesize: req_data['max_file_size'],
            uploadMultiple: false,
            acceptedFiles: req_data['accepted_files'],
            addRemoveLinks: true,
            dictMaxFilesExceeded: "You can not upload more than {{maxFiles}} files.",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            accept: function(file, done) {
                const _URL = window.URL || window.webkitURL;
                    const img = new Image();
                    img.onload = function() {
                        if ((img.width >= 130 && img.width <= 150) && (img.height >= 50 && img.height <= 70)) {
                            done();
                        } else {
                            done("The signature dimensions are too small. Minimum dimensions are 140 PX x 60 PX or 3.7 CM x 1.5 CM.");
                        }
                    };
                    img.onerror = function() {
                        done("Invalid image file.");
                    };
                    img.src = _URL.createObjectURL(file);
            },
            init: function () {
                this.on("success", function (file, message, xhr) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $('#previous_special_signature_hidden').val('');
                        $('#old_special_signature').prop('src','');
                        $('#old_special_signature').remove();
                        $('#special-signature-remove-btn').remove();
                        $("#" + req_data['file_name_hidden_field']).val(event.target.result);
                        // var removeButton = Dropzone.createElement('<button class="btn btn-danger btn-remove-image">Remove Image</button>');
                        file.previewElement.querySelector(".dz-remove").addEventListener('click', function () {
                            // Remove the file from Dropzone
                            $("#" + req_data['file_name_hidden_field']).val("");
                            // Clear the input field value
                        });
                        // Append the remove button to the file preview
                    };
                    reader.readAsDataURL(file);
                });
                this.on("error", function (file, message, xhr) {
                    this.removeFile(file);
                    var message_line = '';
                    if (message.message) {
                        message_line = message.message
                    } else {
                        message_line = message;
                    }
                    showReportSwalAlert({ alertType: 'error', message: message_line, callFor: 'common' });
                });

                this.on("removedfile", function (file) {
                    // Use dropzoneInstance to refer to the Dropzone instance
                });
            }
        });
    }

    $('#special_entity_application_detail_submit_button').on('click', function (e) {
        _specialentityApplicationDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                $.blockUI
                var actionFor = $('#special_entity_application_detail_form').attr('action-for');

                var dialCode = $(".special_entity_application_mobile_data .iti__country-list .iti__active").attr("data-dial-code");
                var countryCode = $(".special_entity_application_mobile_data .iti__country-list .iti__active").attr("data-country-code");
              
                var formData = $('#special_entity_application_detail_form').serialize() + '&dial_code=' + dialCode  + '&country_code=' + countryCode;

                
                var specialentityApplicationDetailSubmitButton = KTUtil.getById('special_entity_application_detail_submit_button');
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
                    url: $('#special_entity_application_detail_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(specialentityApplicationDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(specialentityApplicationDetailSubmitButton);
                        $.unblockUI();
                    },
                    success: function (response) {
                        if (response.result) {
                            console.log(response.entityApplicationData);
                            if(response.entityApplicationData.application_type == '1')
                            {
                                $('#card-id-qrcodeImage').attr('src', response.entityApplicationData.qrcode);
                            }
                            // if(response.entityApplicationData.type=='Permanent'){
                                $('.background-image').css('background-image', 'url(' + response.entityApplicationData.backgroundimg + ')');
                            console.log(response.entityApplicationData.backgroundimg)
                            // }
                            $('.special-entity-application-id').val(response.entityApplicationData.id);
                            $('#card_type').text(response.entityApplicationData.type);
                            $('#card-id-preview-image').attr('src', response.entityApplicationData.image);                            
                            $('#card-id-qrcodeImage').attr('src', response.entityApplicationData.qrcode);
                            // $('#card-id-application-number').html(response.entityApplicationData.serial_no);
                            $('#card-id-application-number').html('-');
                            $('.entity-application-draft-status').val(response.entityApplicationData.draft_status);
                            $('#entity_name').html(response.entityApplicationData.authorized_person_first_name.toUpperCase()+' '+response.entityApplicationData.authorized_person_last_name.toUpperCase());
                            $('#unit_category').html(response.entityApplicationData.entity_type.toUpperCase());
                            $('#company_name').html(response.entityApplicationData.entity_name.toUpperCase());
                            $('#card-id-application-type').html(response.entityApplicationData.type);
                            $('#card-id-designation').html(response.entityApplicationData.designation);
                            $('#card-id-name').html(response.entityApplicationData.first_name.toUpperCase() + ' ' + response.entityApplicationData.last_name.toUpperCase());
                            if (response.entityApplicationData.type != 'Other') {
                                $('#card-id-entity-name').html(response.entityApplicationData.entity_name.toUpperCase());
                            } else {
                                $('#card-id-entity-name').html(response.entityApplicationData.other_entity.toUpperCase());
                            }
                            $('#card-id-type').html(response.entityApplicationData.entity_type.toUpperCase());
                            $('#card-id-designation').html(response.entityApplicationData.designation.toUpperCase());
                            $('#card-id-valid-up-to').html(response.entityApplicationData.expire_date);
                            $('.card-id-contact-no').html(response.entityApplicationData.mobile_number);
                            $('#card-id-department').html(response.entityApplicationData.department);
                            $('#card-id-date-of-issue').html(response.entityApplicationData.issue_date);
                            $('#authorized_signatory').val(response.entityApplicationData.authorized_person_first_name.toUpperCase() + ' ' + response.entityApplicationData.authorized_person_last_name.toUpperCase());
                            $('#is_special_entity_application_detail_valid').val("Yes"); // Set entity detail valid flag - useful for validate while click on next tab
                            $('#authorized_signatory').prop('readonly', true);
                            $.unblockUI();
                            showReportSwalAlert({ alertType: 'success', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityApplicationDetail', tabeId: '' + specialentityApplicationVerifyAndSubmitDetailTabId + '' });
                        } else {
                            $('.form-control').removeClass('is-valid');
                            showReportSwalAlert({ alertType: 'error', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityApplicationDetail' });
                        }
                    },
                    error: function (xhr) {
                        $('.form-control').removeClass('is-valid');
                        showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveEntityApplicationDetail' });
                    }
                });
            } else {
                KTUtil.scrollTop();
                return false;
            }
        });
    });

    var _initSpecialEntityApplicationVerifyAndSubmitDetailForm = function () {
        _specialentityApplicationVerifyAndSubmitDetailFormValidations = FormValidation.formValidation(
            document.getElementById('special_entity_application_verify_and_submit_detail_form'),
            {
                fields: {
                    accept_term: {
                        validators: {
                            notEmpty: {
                                message: 'Please check this declaration'
                            }
                        }
                    },
                    // authorized_signatory : {
                    //     validators: {
                    // 		notEmpty: {
                    // 			message: 'Name of authorized signatory is required'
                    // 		}
                    // 	}
                    // },
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    //submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );
    }

    $('#special_entity_application_verify_and_submit_detail_submit_button').on('click', function (e) {
        _specialentityApplicationVerifyAndSubmitDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var formData = $('#special_entity_application_verify_and_submit_detail_form').serialize();
                var entityApplicationVerifyAndSubmitDetailSubmitButton = KTUtil.getById('special_entity_application_verify_and_submit_detail_submit_button');
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
                    url: $('#special_entity_application_verify_and_submit_detail_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(entityApplicationVerifyAndSubmitDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(entityApplicationVerifyAndSubmitDetailSubmitButton);
                        $.unblockUI();
                    },
                    success: function (response) {
                        if (response.result) {
                            var dynamicForm = $('<form>', {
                                'id': 'dynamicForm',
                                'action': httpPath +'entity/entityApplication/success',
                                'method': 'POST'
                            });

                            dynamicForm.append($('<input>', {
                                'type': 'hidden',
                                'name': '_token',
                                'value': $('meta[name="csrf-token"]').attr('content')
                            }));

                            dynamicForm.append($('<input>', {
                                'type': 'hidden',
                                'name': 'user_id',
                                'value': response.user_id
                            }));
                            dynamicForm.append($('<input>', {
                                'type': 'hidden',
                                'name': 'entityApplicationId',
                                'value': response.entityApplicationId
                            }));

                            // Append the form to the body
                            $('body').append(dynamicForm);

                            // Submit the form
                            dynamicForm.submit();
                        } else {
                            var messageParameter = { alertType: 'error', message: response.message, isScrollUp: 'Yes', callFor: 'saveVerifyAndSubmitDetail' };
                            if (response.redirectPage) {
                                messageParameter['redirectPage'] = response.redirectPage;
                            }
                            showReportSwalAlert(messageParameter);
                        }
                        // if(response.result){
                        //     showReportSwalAlert({alertType:'success', message:'Application Submitted Successfully', isScrollUp:'No', callFor:'saveEntityApplicationDetail'});

                        // } else {
                        //     var messageParameter = {alertType:'error', message:response.message, isScrollUp:'Yes', callFor:'saveVerifyAndSubmitDetail'};
                        //     if(response.redirectPage){
                        //         messageParameter['redirectPage'] = response.redirectPage;
                        //     }
                        //     showReportSwalAlert(messageParameter);
                        // }
                    },
                    error: function (xhr) {
                        $('.form-control').removeClass('is-valid');
                        showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveEntityApplicationDetail' });
                    }
                });
            } else {
                KTUtil.scrollTop();
                return false;
            }
        });
    });

    
	var _initSpecialEntityApplicationDepartmentDetailForm = function () {
        _specialentityApplicationDepartmentFormValidations = FormValidation.formValidation(
            document.getElementById('add_department_form'),
            {
                fields: {
                    department: {
                        validators: {
                            notEmpty: {
                                message: 'Department field is required',
                            },
                            stringLength: {
                                max: 100,
                                message: 'Enter Department up to 100 characters'
                            },
                            remote: {
                                message: 'This department is not unique',
                                url: httpPath+'check-department',
                                data: {
                                   
                                },
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataFilter: function (data) {
                                    var json = JSON.parse(data);
                                    if (json.msg == "true") {
                                        return "\"" + "That Department is already exists" + "\"";
                                    } else {
                                        return 'true';
                                    }
                                }
                            }
                        }
                    },
                    
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    //submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );
    }

    $('#add_department_submit_button').on('click', function (e) {
        e.preventDefault();
        _specialentityApplicationDepartmentFormValidations.validate().then(function (status) {
           
            if (status == 'Valid') {
               
                var formData = $('#add_department_form').serialize();
                var _entitySEZAddressFormSubmitButton = KTUtil.getById('add_department_submit_button');
                $.ajax({
                    url: $('#add_department_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(_entitySEZAddressFormSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(_entitySEZAddressFormSubmitButton);
                    },
                    success: function (response) {
                        $('#department_input').val('');
                        $('#application_department').append(response);

                        $("#departmentpopup").modal('hide');
                        showReportSwalAlert({ alertType: 'success', message: 'Department added successfully', isScrollUp: 'Yes' });

                    },
                    error: function (xhr) {
                        $('.form-control').removeClass('is-valid');
                        showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveEntityDetail' });
                    }
                });
            } else {
                
                KTUtil.scrollTop();
                return false;
            }
        });
    });
    
    return {
        // public functions
        init: function () {
            if ($('#special_entity_application_detail_form').length) {
                _initSpecialEntityApplicationDetailForm();
                _initSpecialEntityApplicationVerifyAndSubmitDetailForm();
				_initSpecialEntityApplicationDepartmentDetailForm();

            }
        }
    };
}();


jQuery(document).ready(function () {
    SpecialEntityApplicationFormControls.init();
	$('#add_department').on('click', function () {
        $("#departmentpopup").modal('show');
    });
});


function removeImage()
{
    $('#previous_special_image_hidden').val('');
    $('#old_special_image').prop('src','');
    $('#old_special_image').remove();
    $('#special-image-remove-btn').remove();
}

function removeSignature()
{
    $('#previous_special_signature_hidden').val('');
    $('#old_special_signature').prop('src','');
    $('#old_special_signature').remove();
    $('#special-signature-remove-btn').remove();
}


    
$('input[name="type"]').on('click', function() {
    var application_type = $(this).val(); // Fixed here, it should be $(this).val() instead of this.value()

    if (application_type == 'Other') {
        $('#application_department_div').css('display', 'block');
    } else {
        $('#application_department_div').css('display', 'none');
    }
});