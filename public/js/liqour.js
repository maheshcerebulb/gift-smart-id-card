"use strict";
// Class definition
var LiqourApplicationFormControls = function () {
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
    var LiqourApplicationDetailTabId = 'tab-liqour-application-detail';
    var LiqourApplicationVerifyAndSubmitDetailTabId = 'tab-liqour-application-verify-and-submit-detail';
    var _LiqourApplicationDetailFormValidations;                              
    var _LiqourApplicationVerifyAndSubmitDetailFormValidations;
    var _LiqourApplicationDataFilterFormValidations;
   
    $('.datepicker').datepicker({
        maxDate: 0,
        format: 'dd-mm-yyyy',
        todayHighlight: true, // Highlight today's date
        endDate: new Date(),
        setDate: new Date(),
        autoclose: true
    });
    $('#liqour_application_tab a').on('click', function (e) {
        e.preventDefault();
        // If click on other tab
        if (!$(this).hasClass("active")) {
            if (this.id == LiqourApplicationVerifyAndSubmitDetailTabId) {
                if ($('#is_liqour_application_detail_valid').val() != 'Yes') {
                    _LiqourApplicationDetailFormValidations.validate();
                    showReportSwalAlert({ alertType: 'error', message: 'Sorry, looks like  details is not submitted. Please complete it first.', isScrollUp: 'Yes', callFor: 'tabValidation', tabeId: '' + LiqourApplicationDetailTabId + '' });
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

    var _initLiqourApplicationDetailForm = function () {
        _LiqourApplicationDetailFormValidations = FormValidation.formValidation(
            document.getElementById('liqour_application_detail_form'),
            {
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: {
                                message: 'First & middle name is required'
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
                    
                    liqour_image_hidden: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload image'
                            }
                        }
                    },
                    
                    temporary_address: {
                        validators: {
                            notEmpty: {
                                message: 'Temporary address is required'
                            }
                        }
                    },
                    permanent_address: {
                        validators: {
                            notEmpty: {
                                message: 'Permanent address is required'
                            }
                        }
                    },
                    company_name: {
                        validators: {
                            notEmpty: {
                                message: 'Company name is required'
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
        field_selector: 'liqour_image',
        file_name_hidden_field: 'liqour_image_hidden',
        max_files: 1,
        max_file_size: 0.5,
        accepted_files: '.png,.jpg,.jpeg',
    };
    initDropZoneFiles(image_options);
    function initDropZoneFiles(req_data) {
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

    $('#liqour_application_detail_submit_button').on('click', function (e) {
        _LiqourApplicationDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                $.blockUI
                var actionFor = $('#liqour_application_detail_form').attr('action-for');


                var dialCode = $(".liqour_mobile_data .iti__country-list .iti__active").attr("data-dial-code");
                var countryCode = $(".liqour_mobile_data .iti__country-list .iti__active").attr("data-country-code");

              
                var formData = $('#liqour_application_detail_form').serialize() + '&dial_code=' + dialCode  + '&country_code=' + countryCode;

            
                var LiqourApplicationDetailSubmitButton = KTUtil.getById('liqour_application_detail_submit_button');
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
                    url: $('#liqour_application_detail_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(LiqourApplicationDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(LiqourApplicationDetailSubmitButton);
                        $.unblockUI();
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.liqourApplicationData) {
                            console.log(response.liqourApplicationData);
                            
                            $('.liqour-application-id').val(response.liqourApplicationData.id);
                            $('#card_type').text(response.liqourApplicationData.type);
                            $('#card-id-liqour-preview-image').attr('src', response.liqourApplicationData.image);
                            $('#card-id-liqour-qrcodeImage').attr('src', response.liqourApplicationData.qrcode);
                            $('#card-id-liqour-application-number').html(response.liqourApplicationData.serial_no);
                            
                            // $('#_name').html(response.liqourApplicationData.authorized_person_first_name.toUpperCase()+' '+response.ApplicationData.authorized_person_last_name.toUpperCase());
                            // $('#unit_category').html(response.liqourApplicationData._type.toUpperCase());
                            // $('#company_name').html(response.liqourApplicationData._name.toUpperCase());
                            $('#card-id-liqour-person-image').attr('src', response.liqourApplicationData.image);                            
                            $('#card-id-liqour-qrcodeImage').attr('src', response.liqourApplicationData.qrcode);

                            $('#card-id-liqour-designation').html(response.liqourApplicationData.designation);
                            $('.card-id-liqour-name').html(response.liqourApplicationData.first_name+ ' ' + response.liqourApplicationData.last_name);

                            $('#card-id-liqour-name').html(response.liqourApplicationData.first_name+ ' ' + response.liqourApplicationData.last_name);
                            $('.card-id-liqour-designation').html(response.liqourApplicationData.designation);

                            $('#card-id-liqour-designation').html(response.liqourApplicationData.designation);
                            $('.card-id-liqour-company-name').html(response.liqourApplicationData.company_name);

                            $('#card-id-liqour-company-name').html(response.liqourApplicationData.company_name);

                            $('.card-id-liqour-temporary-address').html(response.liqourApplicationData.temporary_address);
                            $('.card-id-liqour-permanent-address').html(response.liqourApplicationData.permanent_address);

                            $('#card-id-liqour-temporary-address').html(response.liqourApplicationData.temporary_address);
                            $('#card-id-liqour-permanent-address').html(response.liqourApplicationData.permanent_address);

                            $('.card-id-liqour-serial-number').html(response.liqourApplicationData.serial_number);
                            $('#card-id-liqour-valid-up-to').html(response.liqourApplicationData.expire_date);
                            $('.card-id-liqour-valid-up-to').html(response.liqourApplicationData.expire_date);
                            $('.card-id-liqour-contact-no').html(response.liqourApplicationData.mobile_number);
                            $('#card-id-liqour-date-of-issue').html(response.liqourApplicationData.created_at);
                            $('#authorized_signatory').val(response.liqourApplicationData.authorized_person_first_name + ' ' + response.liqourApplicationData.authorized_person_last_name);
                            $('#is_liqour_application_detail_valid').val("Yes"); // Set  detail valid flag - useful for validate while click on next tab
                            // $('#authorized_signatory').prop('readonly', true);
                            $.unblockUI();
                            var nextTabAnchor = $('#'+LiqourApplicationVerifyAndSubmitDetailTabId);
                            nextTabAnchor.click();
                            // showReportSwalAlert({ alertType: 'success', message: response.message, isScrollUp: 'Yes', callFor: 'saveLiqourApplicationDetail', tabeId: '' + LiqourApplicationVerifyAndSubmitDetailTabId + '' });
                        } else {
                            $('.form-control').removeClass('is-valid');
                            showReportSwalAlert({ alertType: 'error', message: response.message, isScrollUp: 'Yes', callFor: 'saveLiqourApplicationDetail' });
                        }
                    },
                    error: function (xhr) {
                        $('.form-control').removeClass('is-valid');
                        showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveApplicationDetail' });
                    }
                });
            } else {
                KTUtil.scrollTop();
                return false;
            }
        });
    });

    var _initLiqourApplicationVerifyAndSubmitDetailForm = function () {
        _LiqourApplicationVerifyAndSubmitDetailFormValidations = FormValidation.formValidation(
            document.getElementById('liqour_application_verify_and_submit_detail_form'),
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

    $('#liqour_application_verify_and_submit_detail_submit_button').on('click', function (e) {
        _LiqourApplicationVerifyAndSubmitDetailFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var formData = $('#liqour_application_verify_and_submit_detail_form').serialize();
                var LiqourApplicationVerifyAndSubmitDetailSubmitButton = KTUtil.getById('liqour_application_verify_and_submit_detail_submit_button');
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
                    url: $('#liqour_application_verify_and_submit_detail_form').attr('action'),
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        // Show loading state on button
                        KTUtil.btnWait(LiqourApplicationVerifyAndSubmitDetailSubmitButton, _buttonSpinnerClasses, "Please wait"); // Simulate Ajax request
                    },
                    complete: function () {
                        KTUtil.btnRelease(LiqourApplicationVerifyAndSubmitDetailSubmitButton);
                        $.unblockUI();
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.result) {
                            var dynamicForm = $('<form>', {
                                'id': 'dynamicForm',
                                'action': httpPath +'liqour/liqourApplication/success',
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
                                'name': 'liqourApplicationId',
                                'value': response.liqourApplicationId
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
                        if(response.result){
                            // showReportSwalAlert({alertType:'success', message:'Application Submitted Successfully', isScrollUp:'No', callFor:'saveLiqourApplicationDetail'});

                        } else {
                            var messageParameter = {alertType:'error', message:response.message, isScrollUp:'Yes', callFor:'saveLiqourVerifyAndSubmitDetail'};
                            if(response.redirectPage){
                                messageParameter['redirectPage'] = response.redirectPage;
                            }
                            showReportSwalAlert(messageParameter);
                        }
                    },
                    error: function (xhr) {
                        $('.form-control').removeClass('is-valid');
                        showReportSwalAlert({ alertType: 'error', message: 'Sorry, something went wrong, please try again.', isScrollUp: 'Yes', callFor: 'saveApplicationDetail' });
                    }
                });
            } else {
                KTUtil.scrollTop();
                return false;
            }
        });
    });

    var _initLiqourApplicationDataFilterForm = function () {
        _LiqourApplicationDataFilterFormValidations = FormValidation.formValidation(
            document.getElementById('liqour_application_data_filter_form'),
            {
                fields: {
                    liqour_filter_company: {
                        validators: {
                            notEmpty: {
                                message: 'Please select company'
                            }
                        }
                    },

                    liqour_filter_datarange: {
                        validators: {
                            notEmpty: {
                                message: 'Please select from and to date'
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

    $('#liqour_application_data_filter_submit_button').on('click', function (e) {
        _LiqourApplicationDataFilterFormValidations.validate().then(function (status) {
            if (status == 'Valid') {
                var formData = $('#liqour_application_data_filter_form').serialize();
                var LiqourApplicationVerifyAndSubmitDetailSubmitButton = KTUtil.getById('liqour_application_data_filter_submit_button');
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
                    url: $('#liqour_application_data_filter_form').attr('action'),
                    type: 'POST',
                    data: formData,
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
                            var binary = atob(response.liqourApplicationData.data);
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
                            a.download = 'liqour-excel.xlsx';
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);

                            $('#liqour_application_data_filter_form').trigger('reset');
                            $('#liqour_application_data_filter_form input').removeClass('is-valid');
                            $('#liqour_application_data_filter_form input').removeClass('is-invalid');
                            $('#liqour_application_data_filter_form select').removeClass('is-valid');
                            $('#liqour_application_data_filter_form select').removeClass('is-invalid');
                            $('#liqourDataFilterModal').modal('hide');
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

    return {
        // public functions
        init: function () {
            if ($('#liqour_application_detail_form').length) {
                _initLiqourApplicationDetailForm();
                _initLiqourApplicationVerifyAndSubmitDetailForm();
                
            }

            _initLiqourApplicationDataFilterForm();
            
        }
    };
}();


jQuery(document).ready(function () {
    LiqourApplicationFormControls.init();

    
});

function getLiqourApplicationGeneratedCard(id) {
    // Get the ID from data-id attribute

    // AJAX request
    $.ajax({
        url: httpPath+'liqour/liqourApplicationGenerateCardToPdf', // Your server endpoint URL
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id }, // Data to be sent in the request
        success: function(response) {
            // Print the HTML response directly to the document
            console.log(response.message);
                response.pdfPath = baseUrl + 'pdfs/liqour/liqour-card-generated.pdf';
                // Initiate download on the client side
                var downloadLink = document.createElement('a');
                
                downloadLink.href = response.pdfPath;
                downloadLink.download = 'liqour-card-generated.pdf';
                downloadLink.click();
        },
        error: function(xhr, status, error) {
            console.error(error); // Log any errors
        }
    });
}

// function printCard(id){
//     console.log(id);
//     $.ajax({
//         url: 'liqourApplicationGenerateCardToPrint/'+id, // Your server endpoint URL
//         method: 'GET',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         // data: { id: id }, // Data to be sent in the request
//         success: function(response) {
//             // Print the HTML response directly to the document
//             console.log(response.message);
//             w = window.open(window.location.href,"_blank");
//             w.document.open();
//             w.document.write(response);
//             w.document.close();
//             setTimeout(function() {
//                 w.window.print();
//             }, 10);                    
//         },
//         error: function(xhr, status, error) {
//             console.error(error); // Log any errors
//         }
//     });
// }

function liqourApplicationStatusChange(id,is_active)
{
    Swal.fire({
        title: `Are you sure you want to ${is_active === 1 ? 'Active' : 'Inctive'}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX request
            $.ajax({
                url: httpPath+'liqour/liqourApplicationStatusChange',
                type: 'POST',
                data: { id: id, is_active: is_active },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response if needed
                    if (response.liqourApplicationData) {
                        $('#liqour-application-tabel').DataTable().ajax.reload();

                        showReportSwalAlert({ alertType: 'success', message: response.message, isScrollUp: 'Yes', callFor: 'saveLiqourApplicationDetail'});

                    } else {
                        showReportSwalAlert({ alertType: 'error', message: response.message, isScrollUp: 'Yes', callFor: 'saveLiqourApplicationDetail' });
                    }
                },
                error: function(xhr, status, error) {
                    alert(status);
                    // Handle error response if needed
                    Swal.fire('Error', 'An error occurred. Please try again later.', 'error');
                }
            });
        }
    });
}



$('#liqour_data_filter_modal').on('click',function(){
    $('#liqourDataFilterModal').modal('show');
});




var KTBootstrapDaterangepicker = function () {
    
    // Private functions
    var demos = function () {
        // minimum setup
        $('#kt_daterangepicker_1, #kt_daterangepicker_1_modal').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        });

        // input group and left alignment setup
    }

    var validationDemos = function() {
        // input group and left alignment setup
        $('#kt_daterangepicker_1_validate').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#kt_daterangepicker_1_validate .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

             
    }

    return {
        // public functions
        init: function() {
            demos(); 
            validationDemos();
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapDaterangepicker.init();
});