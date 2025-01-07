"use strict";
// Class definition
var EntityApplicationFormControls = function () {
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
    var entityApplicationDetailTabId = 'tab-entity-application-detail';
    var entityApplicationVerifyAndSubmitDetailTabId = 'tab-entity-application-verify-and-submit-detail';
    var _entityApplicationDetailFormValidations;
    var _entityApplicationVerifyAndSubmitDetailFormValidations;
    var _entitySearchApplicationFormValidations;
    var _entitySurrenderApplicationFormValidations;
    $('.datepicker').datepicker({
        maxDate: 0,
        format: 'dd-mm-yyyy',
        todayHighlight: true, // Highlight today's date
        endDate: new Date(),
        setDate: new Date(),
        autoclose: true
    });
    $('#entity_application_tab a').on('click', function (e) {
        e.preventDefault();
        // If click on other tab
        if (!$(this).hasClass("active")) {
            if (this.id == entityApplicationVerifyAndSubmitDetailTabId) {
                if ($('#is_entity_application_detail_valid').val() != 'Yes') {
                    _entityApplicationDetailFormValidations.validate();
                    showReportSwalAlert({ alertType: 'error', message: 'Sorry, looks like entity details is not submitted. Please complete it first.', isScrollUp: 'Yes', callFor: 'tabValidation', tabeId: '' + entityApplicationDetailTabId + '' });
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

    var _initEntityApplicationDetailForm = function () {
        _entityApplicationDetailFormValidations = FormValidation.formValidation(
            document.getElementById('entity_application_detail_form'),
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
                    image_hidden: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload image'
                            }
                        }
                    },
                    signature_hidden: {
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
								regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i,
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
                                    userId: $('.entity-application-user-id').val()
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


        $('#date_of_birth').on('changeDate', function() {
            // Trigger validation
            _entityApplicationDetailFormValidations.revalidateField('date_of_birth');
        });
    }



    var image_options = {
        init_no: 1,
        field_selector: 'image',
        file_name_hidden_field: 'image_hidden',
        max_files: 1,
        max_file_size: 0.050,
        accepted_files: '.png,.jpg,.jpeg',
    };
    initDropZoneFiles(image_options);

    var signature_upload_options = {
        init_no: 2,
        field_selector: 'signature',
        file_name_hidden_field: 'signature_hidden',
        max_files: 1,
        max_file_size: 0.050,
        accepted_files: '.png,.jpg,.jpeg',
    };
    initDropZoneSignatureFiles(signature_upload_options);
    function initDropZoneFiles(req_data) {
       
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
                        $('#previous_image_hidden').val('');
                        $('#old_image').prop('src','');
                        $('#old_image').remove();
                        $('#image-remove-btn').remove();
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
    function initDropZoneSignatureFiles(req_data) {
       
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
                        $('#previous_signature_hidden').val('');
                        $('#old_signature').prop('src','');
                        $('#old_signature').remove();
                        $('#signature-remove-btn').remove();
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

    $('#entity_application_detail_submit_button').on('click', function (e) {
        _entityApplicationDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                $.blockUI
                var actionFor = $('#entity_application_detail_form').attr('action-for');

                var dialCode = $(".entity_application_mobile_data .iti__country-list .iti__active").attr("data-dial-code");
                var countryCode = $(".entity_application_mobile_data .iti__country-list .iti__active").attr("data-country-code");
              
                var formData = $('#entity_application_detail_form').serialize() + '&dial_code=' + dialCode  + '&country_code=' + countryCode;

                
                var entityApplicationDetailSubmitButton = KTUtil.getById('entity_application_detail_submit_button');
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
                    url: $('#entity_application_detail_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(entityApplicationDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(entityApplicationDetailSubmitButton);
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
                            $('.entity-application-id').val(response.entityApplicationData.id);
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
                            $('#card-id-entity-name').html(response.entityApplicationData.entity_name.toUpperCase());
                            $('#card-id-type').html(response.entityApplicationData.entity_type.toUpperCase());
                            $('#card-id-designation').html(response.entityApplicationData.designation.toUpperCase());
                            $('#card-id-valid-up-to').html(response.entityApplicationData.expire_date);
                            $('.card-id-contact-no').html(response.entityApplicationData.mobile_number);
                            $('#card-id-date-of-issue').html(response.entityApplicationData.issue_date);
                            $('#authorized_signatory').val(response.entityApplicationData.authorized_person_first_name.toUpperCase() + ' ' + response.entityApplicationData.authorized_person_last_name.toUpperCase());
                            $('#is_entity_application_detail_valid').val("Yes"); // Set entity detail valid flag - useful for validate while click on next tab
                            $('#authorized_signatory').prop('readonly', true);
                            $.unblockUI();
                            showReportSwalAlert({ alertType: 'success', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityApplicationDetail', tabeId: '' + entityApplicationVerifyAndSubmitDetailTabId + '' });
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

    var _initEntityApplicationVerifyAndSubmitDetailForm = function () {
        _entityApplicationVerifyAndSubmitDetailFormValidations = FormValidation.formValidation(
            document.getElementById('entity_application_verify_and_submit_detail_form'),
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

    $('#entity_application_verify_and_submit_detail_submit_button').on('click', function (e) {
        _entityApplicationVerifyAndSubmitDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var formData = $('#entity_application_verify_and_submit_detail_form').serialize();
                var entityApplicationVerifyAndSubmitDetailSubmitButton = KTUtil.getById('entity_verify_and_submit_detail_submit_button');
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
                    url: $('#entity_application_verify_and_submit_detail_form').attr('action'),
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

    var _initEntitySearchApplicationForm = function () {
        _entitySearchApplicationFormValidations = FormValidation.formValidation(
            document.getElementById('entity_application_search_form'),
            {
                fields: {
                    search_application: {
                        validators: {
                            notEmpty: {
                                message: 'This Field is required'
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

    $('#search_application_submit_button').on('click', function (e) {
        console.log(e);
        _entitySearchApplicationFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var actionFor = $('#entity_application_search_form').attr('action-for');
                var formData = $('#entity_application_search_form').serialize();
                var entitySearchApplicationDetailSubmitButton = KTUtil.getById('search_application_submit_button');
                $.ajax({
                    url: $('#entity_application_search_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(entitySearchApplicationDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(entitySearchApplicationDetailSubmitButton);
                    },
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            
                            $('.form-control').removeClass('is-valid');
                            $('#search-application-datatable').html(response);
                            showReportSwalAlert({ alertType: 'success', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityApplicationDetail', tabeId: '' + entityApplicationVerifyAndSubmitDetailTabId + '' });
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

    var _initEntitySurrenderApplicationForm = function () {
        _entitySurrenderApplicationFormValidations = FormValidation.formValidation(
            document.getElementById('entity_surrender_application_form'),
            {
                fields: {
                    surrender_reason: {
                        validators: {
                            notEmpty: {
                                message: 'Choose reason for surrender'
                            }
                        }
                    },
                     surrender_signature_hidden: {
                         validators: {
                             notEmpty: {
                                 message: 'Please upload document'
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

    var image_options = {
        init_no: 1,
        field_selector: 'surrender_signature',
        file_name_hidden_field: 'surrender_signature_hidden',
        max_files: 1,
        max_file_size: 0.5,
        accepted_files: '.png,.jpg,.jpeg',
    };
    initSurrenderDropZoneFiles(image_options);
    function initSurrenderDropZoneFiles(req_data) {
        var dropzoneInstance;
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
            init: function () {
                this.on("success", function (file, message, xhr) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $('#previous_surrender_signature_hidden').val('');
                        $('#old_surrender_signature').prop('src','');
                        $('#old_surrender_signature').remove();
                        $('#signature-remove-btn').remove();
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

    $('#surrender_application_submit_button').on('click', function (e) {
        console.log(e);
        _entitySurrenderApplicationFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var actionFor = $('#entity_surrender_application_form').attr('action-for');
                var formData = $('#entity_surrender_application_form').serialize();
                var entitySurrenderApplicationDetailSubmitButton = KTUtil.getById('surrender_application_submit_button');
                $.ajax({
                    url: $('#entity_surrender_application_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(entitySurrenderApplicationDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(entitySurrenderApplicationDetailSubmitButton);
                    },
                    success: function (response) {
                        console.log(response);
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

    return {
        // public functions
        init: function () {
            if ($('#entity_application_detail_form').length) {
                _initEntityApplicationDetailForm();
                _initEntityApplicationVerifyAndSubmitDetailForm();

            }
            if ($('#entity_application_search_form').length) {
                _initEntitySearchApplicationForm();
            }
            if ($('#entity_surrender_application_form').length) {
                _initEntitySurrenderApplicationForm();
            }
        }
    };
}();


jQuery(document).ready(function () {
    EntityApplicationFormControls.init();
});
function generateCardPdf() {
    // Make an AJAX request to the Laravel route
    fetch('generate-pdf')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Extract the PDF path from the response
            const pdfPath = data.pdfPath;

            // Create a hidden iframe to trigger the download
            const iframe = document.createElement('iframe');
            iframe.style.display = 'block';
            iframe.src = pdfPath;

            // Append the iframe to the document body
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function removeImage()
{
    $('#previous_image_hidden').val('');
    $('#old_image').prop('src','');
    $('#old_image').remove();
    $('#image-remove-btn').remove();
}

function removeSignature()
{
    $('#previous_signature_hidden').val('');
    $('#old_signature').prop('src','');
    $('#old_signature').remove();
    $('#signature-remove-btn').remove();
}

function removeSurrenderSignature()
{
    $('#previous_surrender_signature_hidden').val('');
    $('#surrender_signature_hidden').val('');

    $('#old_surrender_signature').prop('src','');
    $('#old_surrender_signature').remove();
    
    $('#signature-remove-btn').remove();
}

$(document).ready(function () {
    $('input[name="surrender_reason"]').change(function () {
        var selectedValue = $('input[name="surrender_reason"]:checked').val();
        console.log(selectedValue);
        // Now you can use the selected value as needed
        if (selectedValue == 4) {
            $('#surrender_comment').css('display', 'block');
        } else {
            $('#surrender_comment').val('');
            $('#surrender_comment').css('display', 'none');
        }
    });

    // Trigger the change event if the radio button is initially checked
    if ($('input[name="surrender_reason"]:checked').val() == 4) {
        $('#surrender_comment').css('display', 'block');
    }
});

    function handleProceedToPrintClick(event) {
        // Prevent the default behavior of the link (e.g., navigating to a new page)
        event.preventDefault();
        // Make the AJAX request to change application status
        $.ajax({
            url: event.target.href,
            type: 'GET',
            success: function(response) {
                console.log(response.message);
                response.pdfPath = baseUrl + 'pdfs/idcard-generated.pdf';
                // Initiate download on the client side
                var downloadLink = document.createElement('a');
                // alert(downloadLink.href);
                downloadLink.href = response.pdfPath;
                downloadLink.download = 'idcard-generated.pdf';
                downloadLink.click();
                // Handle the response as needed
                // Reload the page after a short delay
                setTimeout(function() {
                    window.location.reload();
                }, 1000); // Adjust the delay (in milliseconds) as needed
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    }



    'use strict';

// Class definition
var EntityProfileImageChange = function () {
	// Private functions
	var _entityProfileImageChange = function () {
		// Example 1
		var avatar1 = new KTImageInput('EntityProfileImageChange');

        avatar1.on('change', function(imageInput) {
            // Example AJAX request
            console.log(imageInput);
            var b = imageInput.wrapper.outerHTML;
            console.log(b);
            $.ajax({
                url: httpPath+'entity/entity-profile-image-change',
                type: 'POST',
                data: JSON.stringify({
                    image: imageInput
                }),
                contentType: 'application/json', // Set content type to JSON
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    swal.fire({
                        title: 'Image successfully changed!',
                        type: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'Awesome!',
                        confirmButtonClass: 'btn btn-primary font-weight-bold'
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr);
                    swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while changing the image.',
                        type: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        confirmButtonClass: 'btn btn-primary font-weight-bold'
                    });
                }
            });
        });

		// Example 2
		// var avatar2 = new KTImageInput('kt_image_2');

		// // Example 3
		// var avatar3 = new KTImageInput('kt_image_3');

		// Example 4
		// var avatar4 = new KTImageInput('kt_image_4');

		// avatar4.on('cancel', function(imageInput) {
		// 	swal.fire({
        //         title: 'Image successfully canceled !',
        //         type: 'success',
        //         buttonsStyling: false,
        //         confirmButtonText: 'Awesome!',
        //         confirmButtonClass: 'btn btn-primary font-weight-bold'
        //     });
		// });

		// avatar4.on('change', function(imageInput) {
		// 	swal.fire({
        //         title: 'Image successfully changed !',
        //         type: 'success',
        //         buttonsStyling: false,
        //         confirmButtonText: 'Awesome!',
        //         confirmButtonClass: 'btn btn-primary font-weight-bold'
        //     });
		// });

		// avatar4.on('remove', function(imageInput) {
		// 	swal.fire({
        //         title: 'Image successfully removed !',
        //         type: 'error',
        //         buttonsStyling: false,
        //         confirmButtonText: 'Got it!',
        //         confirmButtonClass: 'btn btn-primary font-weight-bold'
        //     });
		// });

		// // Example 5
		// var avatar5 = new KTImageInput('kt_image_5');

		// avatar5.on('cancel', function(imageInput) {
		// 	swal.fire({
        //         title: 'Image successfully changed !',
        //         type: 'success',
        //         buttonsStyling: false,
        //         confirmButtonText: 'Awesome!',
        //         confirmButtonClass: 'btn btn-primary font-weight-bold'
        //     });
		// });

		// avatar5.on('change', function(imageInput) {
		// 	swal.fire({
        //         title: 'Image successfully changed !',
        //         type: 'success',
        //         buttonsStyling: false,
        //         confirmButtonText: 'Awesome!',
        //         confirmButtonClass: 'btn btn-primary font-weight-bold'
        //     });
		// });

		// avatar5.on('remove', function(imageInput) {
		// 	swal.fire({
        //         title: 'Image successfully removed !',
        //         type: 'error',
        //         buttonsStyling: false,
        //         confirmButtonText: 'Got it!',
        //         confirmButtonClass: 'btn btn-primary font-weight-bold'
        //     });
		// });
	}

	return {
		// public functions
		init: function() {
			_entityProfileImageChange();
		}
	};
}();

KTUtil.ready(function() {
	EntityProfileImageChange.init();
});
$('#EntityProfileImageChange .btn').on('click',function(){
    // alert(1);
    $('#entityProfileImage').click();
    $('#entityProfileImage').change(function(event) {
        var file = event.target.files[0]; // Get the selected file
        console.log(file);
        // Create FormData object to send the file via AJAX
        var formData = new FormData();
        formData.append('entityProfileImage', file);

        // AJAX request to send the file
        $.ajax({
            url: httpPath+'entity/entity-profile-image-change',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Set content type to false to prevent jQuery from setting the Content-Type header
            success: function(response) {
                // Handle success response
                $('#EntityProfileImageChange .image-input-wrapper').css('background-image', 'url(' + response.filePath + ')');
                $('#entity-profile-image').attr('src', response.filePath);
                // Optionally, do something with the response
            },
            error: function(xhr, status, error) {
                // Handle error
                var errorMessage = 'Sorry, something went wrong, please try again.';
                if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.entityProfileImage) {
                    errorMessage = xhr.responseJSON.errors.entityProfileImage.join(', ');
                }
                showReportSwalAlert({
                    alertType: 'error',
                    message: errorMessage,
                    isScrollUp: 'Yes',
                });
                // Optionally, show an error message to the user
            }
        });
    });
});