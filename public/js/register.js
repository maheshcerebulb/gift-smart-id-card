// Class definition
var RegisterFormControls = function () {
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
    var entityDetailTabId = 'tab-entity-detail';
    var entityAuthorizedPersonDetailTabId = 'tab-entity-authorized-person-detail';
    var entityVerifyAndSubmitDetailTabId = 'tab-entity-verify-and-submit-detail';
    var _entityDetailFormValidations;
    var _entityAuthorizedPersonDetailFormValidations;
    var _entityVerifyAndSubmitDetailFormValidations;
    var _entitySEZAddressFormValidations;


    $('#register_tab a').on('click', function (e) {
        e.preventDefault();
        // If click on other tab
        if (!$(this).hasClass("active")) {
            if (this.id == entityAuthorizedPersonDetailTabId) {
                if ($('#is_entity_detail_valid').val() != 'Yes') {
                    _entityDetailFormValidations.validate();
                    showReportSwalAlert({ alertType: 'error', message: 'Sorry, looks like entity details is not submitted. Please complete it first.', isScrollUp: 'Yes', callFor: 'tabValidation', tabeId: '' + entityDetailTabId + '' });
                } else {
                    KTUtil.scrollTop();
                }
            } else if (this.id == entityVerifyAndSubmitDetailTabId) {
                // Validate entity detail tab
                if ($('#is_entity_detail_valid').val() == 'Yes') {
                    if ($('#is_entity_authorized_person_detail_valid').val() != 'Yes') {
                        _entityDetailFormValidations.validate();
                        showReportSwalAlert({ alertType: 'error', message: 'Sorry, looks like authorized person details is not submitted. Please complete it first.', isScrollUp: 'Yes', callFor: 'tabValidation', tabeId: '' + entityAuthorizedPersonDetailTabId + '' });
                    } else {
                        $.ajax({
                            url: httpPath + 'users/getEntityDetailForFinalStepOnRegister',
                            type: 'POST',
                            data: { id: $('.entity-id').val() },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.result) {
                                    $('#person_designation').html(response.authorized_person_designation);
                                    $('#authorized_signatory_name').val(response.authorized_signatory_name);
                                    $('#authorized_person_place').val(response.place);
                                }
                                else {
                                    var messageParameter = { alertType: 'error', message: response.message, isScrollUp: 'Yes', callFor: 'tabValidation', tabeId: '' + entityDetailTabId + '' };

                                    if (response.redirectPage) {
                                        messageParameter['redirectPage'] = response.redirectPage;
                                    }
                                    showReportSwalAlert(messageParameter);
                                }
                            },
                            error: function (xhr) {
                                showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', callFor: 'common' });
                            }
                        });
                        KTUtil.scrollTop();
                    }
                } else {
                    _entityDetailFormValidations.validate();
                    showReportSwalAlert({ alertType: 'error', message: 'Sorry, looks like entity details is not submitted. Please complete it first.', isScrollUp: 'Yes', callFor: 'tabValidation', tabeId: '' + entityDetailTabId + '' });
                }
            }
        } else {
            return false;
        }
    });

    $('.step-back-button').on('click', function (e) {
        var clickAttribute = $(this).attr('back-for');
        $('#' + clickAttribute).trigger('click');
        KTUtil.scrollTop();
    });

    // Private functions
    var _initEntityDetailForm = function () {
        _entityDetailFormValidations = FormValidation.formValidation(
            document.getElementById('entity_detail_form'),
            {
                fields: {
                    unit_category: {
                        validators: {
                            notEmpty: {
                                message: 'Please select Entity category'
                            }
                        }
                    },
                    company_name: {
                        validators: {
                            notEmpty: {
                                message: 'Company name is required'
                            },
                            // stringLength: {
                            //     max: 15,
                            //     message: 'Company name must be less than or equal to 15 characters'
                            // }
                        }
                    },
                    constitution_of_business: {
                        validators: {
                            notEmpty: {
                                message: 'Please select constitution of business'
                            }
                        }
                    },

                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            emailAddress: {
                                message: 'Email address is not valid'
                            },
                            remote: {
                                message: 'This email address is not unique',
                                url: httpPath + 'checkEntityEmailUnique',
                                data: {
                                    email: function () {
                                        return $("input[name='email']").val();
                                    }
                                },
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataFilter: function (data) {
                                    var json = JSON.parse(data);
                                    if (json.msg == "true") {
                                        return "\"" + "That username is taken" + "\"";
                                    } else {
                                        return 'true';
                                    }
                                }
                            }
                        }
                    },
                    request_id: {
                        validators: {
                            notEmpty: {
                                message: 'Application No (Form F) is required'
                            },
                            remote: {
                                message: 'This Application No (Form F) is not valid',
                                url: httpPath + 'checkCompanyId',
                                data: {
                                    request_id: function () {
                                        return $("input[name='request_id']").val();
                                    }
                                },
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataFilter: function (data) {
                                    var json = JSON.parse(data);
                                    if (json.msg == "true") {
                                        return "\"" + "That username is taken" + "\"";
                                    } else {
                                        return 'true';
                                    }
                                },
                                depends: function() {
                                    // Check if the field is empty
                                    return $.trim($("input[name='request_id']").val()).length > 0;
                                }
                            }
                        },                       
                    },
                    company_address: {
                        validators: {
                            notEmpty: {
                                message: 'Entity tower name in sez is required'
                            }
                        }
                    },
                    company_country: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a country'
                            }
                        }
                    },
                    company_state: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a state'
                            }
                        }
                    },
                    company_city: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a city'
                            }
                        }
                    },
                    company_pin_code: {
                        validators: {
                            notEmpty: {
                                message: 'Pin Code is required'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'Enter only digits'
                            }
                        }
                    },
                    pan_number: {
                        validators: {
                            notEmpty: {
                                message: 'Pan number is required'
                            },
                            regexp: {
                                regexp: /^.{0,10}$/,
                                message: 'Please enter valid 10 character pan number'
                            }
                        }
                    }
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
		
		$('#unit_category').on('change', function() {
		 var unitCategoryValue = $(this).val();
			 if (unitCategoryValue === 'Other') {
				    _entityDetailFormValidations.disableValidator('request_id', 'notEmpty');
					_entityDetailFormValidations.disableValidator('request_id', 'remote');
                    _entityDetailFormValidations.disableValidator('pan_number', 'notEmpty');
                    _entityDetailFormValidations.disableValidator('pan_number', 'regexp');
				} else {
					_entityDetailFormValidations.enableValidator('request_id', 'notEmpty');
					_entityDetailFormValidations.enableValidator('request_id', 'remote');
                    _entityDetailFormValidations.enableValidator('pan_number', 'notEmpty');
                    _entityDetailFormValidations.enableValidator('pan_number', 'regexp');
				}
			});

    }

    $('#entity_detail_submit_button').on('click', function (e) {
        _entityDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var actionFor = $('#entity_detail_form').attr('action-for');

                var dialCode1 = $(".entity_auth_person_mobile_data .iti__country-list .iti__active").attr("data-dial-code");
                var countryCode1 = $(".entity_auth_person_mobile_data .iti__country-list .iti__active").attr("data-country-code");


                var dialCode2 = $(".entity_contact_person_mobile_data .iti__country-list .iti__active").attr("data-dial-code");
                var countryCode2 = $(".entity_contact_person_mobile_data .iti__country-list .iti__active").attr("data-country-code");
              
                var formData = $('#entity_detail_form').serialize() + '&dial_code=' + dialCode1  + '&country_code=' + countryCode1 + '&dial_code_2=' + dialCode2  + '&country_code_2=' + countryCode2;
                
                var entityDetailSubmitButton = KTUtil.getById('entity_detail_submit_button');
                $.ajax({
                    url: $('#entity_detail_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(entityDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(entityDetailSubmitButton);
                    },
                    success: function (response) {
                        if (response.result) {
                            if (response.entityId) {
                                $('.entity-id').val(response.entityId);
                                $('#is_entity_detail_valid').val("Yes"); // Set entity detail valid flag - useful for validate while click on next tab
                            }
                            showReportSwalAlert({ alertType: 'success', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityDetail', tabeId: '' + entityAuthorizedPersonDetailTabId + '' });
                        } else {
                            $('.form-control').removeClass('is-valid');
                            showReportSwalAlert({ alertType: 'error', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityDetail' });
                        }
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

    var _initEntityAuthorizedPersonDetailForm = function () {
        _entityAuthorizedPersonDetailFormValidations = FormValidation.formValidation(
            document.getElementById('entity_authorized_person_detail_form'),
            {
                fields: {
                    authorized_person_first_name: {
                        validators: {
                            notEmpty: {
                                message: 'First name is required'
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
                            // regexp: {
                            //     regexp: /^[0-9]{10}$/,
                            //     message: 'Please enter a valid mobile number'
                            // }
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
                            // regexp: {
                            //     regexp: /^[0-9]{10}$/,
                            //     message: 'Please enter a valid mobile number'
                            // }
                        }
                    },
                    entity_authorized_person_signature_hidden: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload a signature'
                            }
                        }
                    }
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

        var file_upload_options = {
            init_no: 1,
            field_selector: 'entity_authorized_person_support_document',
            file_name_hidden_field: 'entity_authorized_person_support_document_hidden',
            upload_path: 'users/uploadEntityAuthorizedPersonSupportDocument',
            remove_file_path: 'users/removeEntityAuthorizedPersonSupportDocument',
            max_files: 1,
            max_file_size: 10,
            accepted_files: '.png,.jpg,.jpeg,.pdf',
        };
        initDropZoneFiles(file_upload_options);

        var signature_upload_options = {
            init_no: 2,
            field_selector: 'entity_authorized_person_signature',
            file_name_hidden_field: 'entity_authorized_person_signature_hidden',
            upload_path: 'users/uploadEntityAuthorizedPersonSignature',
            remove_file_path: 'users/removeEntityAuthorizedPersonSignature',
            max_files: 1,
            max_file_size: 10,
            accepted_files: '.png,.jpg,.jpeg',
        };
        initDropZoneFiles(signature_upload_options);



        function initDropZoneFiles(req_data, upload_path) {
            var init_no = req_data.init_no;

            window['field_selector_' + init_no] = req_data.field_selector;
            window['upload_path_' + init_no] = req_data.upload_path;
            window['remove_file_path_' + init_no] = req_data.remove_file_path;
            window['max_files_' + init_no] = req_data.max_files;
            window['max_file_size_' + init_no] = req_data.max_file_size;
            window['accepted_files_' + init_no] = req_data.accepted_files;
            window['file_name_hidden_field_' + init_no] = req_data.file_name_hidden_field;

            /*field_selector = req_data.field_selector;
            upload_path = req_data.upload_path;
            remove_file_path = req_data.remove_file_path;
            max_files = req_data.max_files;
            max_file_size = req_data.max_file_size;
            accepted_files = req_data.accepted_files;
            file_name_hidden_field = req_data.file_name_hidden_field;*/
            console.log(window['field_selector_' + init_no]);
            // return false;
            $('#' + window['field_selector_' + init_no]).dropzone({
                url: httpPath + window['upload_path_' + init_no], // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: window['max_files_' + init_no],
                maxFilesize: window['max_file_size_' + init_no], // MB
                addRemoveLinks: true,
                uploadMultiple: true,
                //parallelUploads: 100, // use it with uploadMultiple
                acceptedFiles: window['accepted_files_' + init_no],
                dictMaxFilesExceeded: "You can not upload more than {{maxFiles}} files.", // Default: You can not upload any more files.
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "sending": function (file, xhr, formData) {
                    formData.append("temp_entity_id", $('.entity-id').val());
                },
                init: function () {
                    this.on("success", function (file, response, xhr) {
                        if (response.result) {
                            var added_file_name = response.file_name;
                            $('#' + window['file_name_hidden_field_' + init_no]).val(added_file_name);
                            // Add your custom logic for success
                            var previewElement = file.previewElement;
    
                            // Add remove file event
                            $(previewElement).find('.dz-remove').on('click', function (e) {
                                var preview_div = $(this).closest('.dz-preview');
                                $('#' + window['file_name_hidden_field_' + init_no]).val('');
    
                                // Send an AJAX request to remove the file on the server
                                $.ajax({
                                    url: httpPath + window['remove_file_path_' + init_no],
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: { file_name: added_file_name, temp_entity_id: $('.entity-id').val() },
                                    success: function (remove_response) {
                                        if (remove_response.result) {
                                            preview_div.remove();
                                        }
                                        else {
                                            showReportSwalAlert({ alertType: 'error', message: remove_response.message, callFor: 'common' });
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        // Handle error
                                    }
                                });
                            });
                        }
                        else {
                            this.removeFile(file);
                        }
                    });
                    this.on("error", function (file, message, xhr) {
                        // Remove the file from the dropzone
                        this.removeFile(file);
                        var message_line = '';
                        if (message.message) {
                            message_line = message.message;
                        } else {
                            message_line = message;
                        }
                        showReportSwalAlert({ alertType: 'error', message: message_line, callFor: 'common' });
                    });
    
                    this.on("removedfile", function (file) {
                        // Use dropzoneInstance to refer to the Dropzone instance
                    });
                }
                // success: function (file, response) {
                //     if (response.result) {
                //         var added_file_name = response.file_name;
                //         $('#' + window['file_name_hidden_field_' + init_no]).val(added_file_name);
                //         // Add your custom logic for success
                //         var previewElement = file.previewElement;

                //         // Add remove file event
                //         $(previewElement).find('.dz-remove').on('click', function (e) {
                //             var preview_div = $(this).closest('.dz-preview');
                //             $('#' + window['file_name_hidden_field_' + init_no]).val('');

                //             // Send an AJAX request to remove the file on the server
                //             $.ajax({
                //                 url: httpPath + window['remove_file_path_' + init_no],
                //                 type: 'POST',
                //                 headers: {
                //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //                 },
                //                 data: { file_name: added_file_name, temp_entity_id: $('.entity-id').val() },
                //                 success: function (remove_response) {
                //                     if (remove_response.result) {
                //                         preview_div.remove();
                //                     }
                //                     else {
                //                         showReportSwalAlert({ alertType: 'error', message: remove_response.message, callFor: 'common' });
                //                     }
                //                 },
                //                 error: function (xhr, status, error) {
                //                     // Handle error
                //                 }
                //             });
                //         });
                //     }
                //     else {
                //         this.removeFile(file);
                //     }
                // },
                // error: function (file, message, xhr) {
                //     // Remove the file from the dropzone
                //     this.removeFile(file);
                //     var message_line = '';
                //     if (message.message) {
                //         message_line = message.message;
                //     } else {
                //         message_line = message;
                //     }
                //     showReportSwalAlert({ alertType: 'error', message: message_line, callFor: 'common' });
                // },
                // removedfile: function (file) {
                //     //this.files.push(file);
                // },
            });
        }
    }

    $('#entity_authorized_person_detail_submit_button').on('click', function (e) {
        _entityAuthorizedPersonDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                if ($('.entity-id').val() > 0) {
                    var actionFor = $('#entity_authorized_person_detail_form').attr('action-for');

                    var dialCode = $(".entity_auth_person_mobile_data .iti__country-list .iti__active").attr("data-dial-code");
                    var countryCode = $(".entity_auth_person_mobile_data .iti__country-list .iti__active").attr("data-country-code");

                    var dialCode2 = $(".entity_contact_person_mobile_data .iti__country-list .iti__active").attr("data-dial-code");
                    var countryCode2 = $(".entity_contact_person_mobile_data .iti__country-list .iti__active").attr("data-country-code");
                  
                    var formData = $('#entity_authorized_person_detail_form').serialize() + '&dial_code=' + dialCode  + '&country_code=' + countryCode + '&dial_code_2=' + dialCode2  + '&country_code_2=' + countryCode2;
    

                    // var formData = $('#entity_authorized_person_detail_form').serialize();
                    var entityAuthorizedPersonDetailSubmitButton = KTUtil.getById('entity_authorized_person_detail_submit_button');
                    $.ajax({
                        url: $('#entity_authorized_person_detail_form').attr('action'),
                        type: 'POST',
                        data: formData,
                        beforeSend: function () {
                            // Show loading state on button
                            KTUtil.btnWait(entityAuthorizedPersonDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                        },
                        complete: function () {
                            KTUtil.btnRelease(entityAuthorizedPersonDetailSubmitButton);
                        },
                        success: function (response) {
                            if (response.result) {
                                $('#is_entity_authorized_person_detail_valid').val("Yes"); // Set vehicle detail valid flag - useful for validate while click on next tab
                                showReportSwalAlert({ alertType: 'success', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityAuthorizedPersonDetail', tabeId: '' + entityVerifyAndSubmitDetailTabId + '' });
                            } else {
                                var messageParameter = { alertType: 'error', message: response.message, isScrollUp: 'Yes', callFor: 'saveEntityAuthorizedPersonDetail' };
                                if (response.redirectPage) {
                                    messageParameter['redirectPage'] = response.redirectPage;
                                }
                                showReportSwalAlert(messageParameter);
                            }
                        },
                        error: function (xhr) {
                            showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveEntityAuthorizedPersonDetail' });
                        }
                    });
                } else {
                    showReportSwalAlert({ alertType: 'error', message: 'Please save entity detail first', callFor: 'saveEntityAuthorizedPersonDetail', isScrollUp: 'Yes' });
                }
            } else {
                KTUtil.scrollTop();
                return false;
            }
        });
    });

    var _initEntityVerifyAndSubmitDetailForm = function () {
        _entityVerifyAndSubmitDetailFormValidations = FormValidation.formValidation(
            document.getElementById('entity_verify_and_submit_detail_form'),
            {
                fields: {
                    accept_term: {
                        validators: {
                            notEmpty: {
                                message: 'Please check this declaration'
                            }
                        }
                    },
                    authorized_signatory_name: {
                        validators: {
                            notEmpty: {
                                message: 'Name of authorized signatory is required'
                            }
                        }
                    },
                    authorized_person_place: {
                        validators: {
                            notEmpty: {
                                message: 'Place is required'
                            }
                        }
                    }
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

    $('#entity_verify_and_submit_detail_submit_button').on('click', function (e) {
        _entityVerifyAndSubmitDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var formData = $('#entity_verify_and_submit_detail_form').serialize();
                var entityVerifyAndSubmitDetailSubmitButton = KTUtil.getById('entity_verify_and_submit_detail_submit_button');
                $.ajax({
                    url: $('#entity_verify_and_submit_detail_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(entityVerifyAndSubmitDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(entityVerifyAndSubmitDetailSubmitButton);
                    },
                    success: function (response) {
                        if (response.result) {
                            var dynamicForm = $('<form>', {
                                'id': 'dynamicForm',
                                'action': 'register/success',
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
                        showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveEntityDetail' });
                    }
                });
            } else {
                KTUtil.scrollTop();
                return false;
            }
        });
    });

    var _initEntitySEZAddressDetailForm = function () {
        _entitySEZAddressFormValidations = FormValidation.formValidation(
            document.getElementById('add_address_form'),
            {
                fields: {
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Address field is required',
                            },
                            stringLength: {
                                max: 100,
                                message: 'Enter Address up to 100 characters'
                            },
                            remote: {
                                message: 'This address is not unique',
                                url: httpPath+'check-address',
                                data: {
                                   
                                },
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataFilter: function (data) {
                                    var json = JSON.parse(data);
                                    if (json.msg == "true") {
                                        return "\"" + "That Address is already exists" + "\"";
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

    $('#add_address_submit_button').on('click', function (e) {
        e.preventDefault();
        _entitySEZAddressFormValidations.validate().then(function (status) {
           
            if (status == 'Valid') {
               
                var formData = $('#add_address_form').serialize();
                var _entitySEZAddressFormSubmitButton = KTUtil.getById('add_address_submit_button');
                $.ajax({
                    url: $('#add_address_form').attr('action'),
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
                        $('#address_input').val('');
                        // $('.country-option').append(response);
                        $('.company_address-option').append(response);

                        $("#addresspopup").modal('hide');
                        showReportSwalAlert({ alertType: 'success', message: 'Address added successfully', isScrollUp: 'Yes' });

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
            if ($('#entity_detail_form').length) {
                _initEntityDetailForm();
                _initEntityAuthorizedPersonDetailForm();
                _initEntityVerifyAndSubmitDetailForm();
            }

            _initEntitySEZAddressDetailForm();
        }
    };
}();

jQuery(document).ready(function () {
    // Other code

    RegisterFormControls.init();

    $('#add_address').on('click', function () {
        $("#addresspopup").modal('show');
    });
    
    // $('#add_address_submit_button').on('click', function () {
        
    //     $.ajax({
    //         url: httpPath + 'common/add_address', 
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: { query: $('#address_input').val() },
    //         success: function (data) {
    //             // Update the results div with the AJAX response
    //             $('#address_input').val('');
    //             $('.country-option').append(data);
    //             $("#addresspopup").modal('hide');
    //         }
    //     });
    // });

    $('#application_no').on('keyup', function () {
        if ($(this).val().length > 3) {
            $.ajax({
                url: httpPath + 'common/getCompany', // Replace with your actual endpoint
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { query: $(this).val() },
                success: function (data) {
                    // Update the results div with the AJAX response
                    $('#company_name').val(data);
                }
            });
        }
    });

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

$(document).ready(function () {
    // When the dropdown changes
    $('#constitution_of_business').on('change', function () {
        // Check if the selected option is 'Other'
        if ($(this).val() === 'Other') {
            // Show the text box
            $('#otherInput').show();
        } else {
            // Hide the text box
            // $('#constitution_of_business').val('');
            $('#otherInput').hide();
        }
    });
});



function checkValidation() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }