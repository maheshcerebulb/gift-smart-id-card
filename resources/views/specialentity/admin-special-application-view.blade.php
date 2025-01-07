@extends('layouts.default')

@section('pageTitle', 'Recent Special Application List')



@section('css')

    <link href="{{ URL::asset('datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />

    <style>

        tr.selected {
            background-color: #AED6F1 !important; /* Change to your desired background color */
        }
        .dataTables_wrapper .dataTable tbody tr.selected td{
            background-color: #AED6F1 !important; /* Change to your desired background color */
        }
    </style>
@endsection

@section('content')

<div class="main d-flex flex-column flex-row-fluid">

    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">

        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <!--begin::Info-->

            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->

                <div class="d-flex align-items-baseline flex-wrap mr-5">

                    <!--begin::Page Title-->

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Recent Special Application List</h2>

                    <!--end::Page Title-->

                </div>

                <!--end::Page Heading-->

            </div>

            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">

                <a href="{{ route('welcome') }}" class="btn btn-light font-weight-boldest text-uppercase">

                    <i class="flaticon2-left-arrow-1"></i>Back To Dashboard

                </a>
                @if(Auth::user()->getRoleNames()->first()=='Sub Admin')
                {{-- <button id="verifiedRecord" class="btn btn-primary left-gap"  disabled="disabled" title="If status is verified you can approve">Verified</button> --}}

                @endif
                @if(Auth::user()->getRoleNames()->first()=='Admin')
                    <button id="approveRecord" class="btn btn-primary left-gap"  disabled="disabled" title="If status is submited then you can approve">Approve</button>

                @endif

                <button id="printRecord" class="btn btn-warning left-gap" disabled="disabled" title="If status is Activated then you can print">Print</button>

                {{-- <a href="javascript:;" onclick="generateCardPdf()" class="btn btn-light font-weight-boldest text-uppercase">

                    <i class="flaticon2-left-arrow-1"></i>Generate Card PDF

                </a> --}}
                {{-- <a href="javascript:;" class="btn btn-primary font-weight-boldest text-uppercase left-gap" id="super_admin_buidling_companies_filter_modal">
                    Report
                </a> --}}
               

            </div>

            <!--end::Toolbar-->

        </div>

    </div>

    <!--end::Subheader-->

    <!--begin::Content-->

    <div class="content flex-column-fluid pt-5" id="kt_content">

        <!-- Start:: flash message element -->

        @include('elements.flash-message')

        @include('users.show-counts')

        <!-- End:: flash message element -->

        <div class="row">

            <div class="col-lg-12">

                <div class="card card-custom card-border gutter-b">

                    <div class="card-body p-0">

                        <div class="table-responsive">

                        <table class="table table-hover table-head-custom table-vertical-center" id="application_table">

                                <thead>

                                    <tr class="text-uppercase">

                                        <th>No</th>

                                        <th>Serial Number</th>

                                        <th>Entity</th>

                                        <th>Application Type</th>

                                        <th>Application</th>

                                        <th>Date</th>

                                        <th>Expiry Date</th>

                                        <th>Employee Name</th>

                                        <th>Status</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>



                                </tbody>

                            </table>

                        </div>

                        <!--end: Tab Content -->

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>




@include('modals.filter-buidling-entity-form')
<div class="modal fade" id="viewApplicationModal" tabindex="-1" role="dialog" aria-labelledby="viewApplicationModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

        <div class="modal-content">



        </div>

    </div>

</div>

<div class="modal fade" id="rejectApplicationModal" tabindex="-1" role="dialog" aria-labelledby="rejectApplicationModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Reason to reject</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form method="POST" action="{{url('entity/rejectApplication')}}" class="form fv-plugins-bootstrap fv-plugins-framework" id="rejectForm">

                @csrf

                <div class="modal-body">

                    <div class="form-group row fv-plugins-icon-container">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="input-group" data-z-index="6">

                                <textarea class="form-control form-control-solid required" placeholder="Enter reason to reject ID Card application"  name="comment" ></textarea>

                                <input type="hidden" name="status" value="{{config('constant.ENTITY_APPLICATION_REJECTED')}}">

                            <input type="hidden" name="application_id" id="application_id">

                            </div>

                            <div class="fv-plugins-message-container"></div>

                        </div>

                    </div>



                </div>

                <div class="modal-footer border-0">

                    <button type="button" class="btn btn-xl btn-bg-white h5 font-weight-bolder px-10" data-link=""  id="cancel_reject_application">Cancel</a>

                    <button type="button" class="btn btn-lg btn-common font-weight-bolder h5 px-10" data-link=""  id="submit_reject_application">Reject</a>

                </div>

            </form>

        </div>

    </div>

</div>
<div class="modal fade" id="sendbackApplicationModal" tabindex="-1" role="dialog" aria-labelledby="sendbackApplicationModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Reason to send back</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form method="POST" action="{{url('entity/sendbackApplication')}}" class="form fv-plugins-bootstrap fv-plugins-framework" id="sendbackForm">

                @csrf

                <div class="modal-body">

                    <div class="form-group row fv-plugins-icon-container">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="input-group" data-z-index="6">

                                <textarea class="form-control form-control-solid required" placeholder="Enter reason to send back ID Card application"  name="comment" ></textarea>

                                <input type="hidden" name="status" value="{{config('constant.ENTITY_APPLICATION_SENDBACK')}}">

                            <input type="hidden" name="application_id" id="application_id">

                            </div>

                            <div class="fv-plugins-message-container"></div>

                        </div>

                    </div>



                </div>

                <div class="modal-footer border-0">

                    <button type="button" class="btn btn-xl btn-bg-white h5 font-weight-bolder px-10" data-link=""  id="cancel_sendback_application">Cancel</a>

                    <button type="button" class="btn btn-lg btn-common font-weight-bolder h5 px-10" data-link=""  id="submit_sendback_application">Send Back</a>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection

@section('scripts')

    <script src="{{ URL::asset('datatable/js/jquery.dataTables.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/jszip.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/pdfmake.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/vfs_fonts.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/buttons.html5.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/buttons.print.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/dataTables.responsive.min.js') }}"></script>

    <script src="{{ URL::asset('datatable/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ URL::asset('js/datatables.js') }}"></script>

    <script src="{{ URL::asset('js/popover.js') }}"></script>

    <script type="text/javascript">
    var Entitynames = <?php echo json_encode($companyNames); ?>;
    var statuses = <?php echo json_encode($statuses); ?>;
    var userCategory = <?php echo json_encode(Auth::user()->getRoleNames()->first()); ?>;
    console.log(statuses);


    $(document).ready(function() {
        // alert(userCategory);
        // var stateSave = userCategory == 'Sub Admin';
        var table = $('#application_table').DataTable({

            select: 'multi',// 'single' or 'multi' for single or multiple row selection

            processing: true,

            serverSide: true,

            stateSave: userCategory == 'Sub Admin' ? true : false,

            ajax: "{{ route('admin.special-applications-view') }}",

            columns: [

                {

                    data: 'DT_RowIndex',

                    name: 'DT_RowIndex',

                    orderable: false,

                    searchable: false,

                    visible:false,

                },

                {

                    data: 'serial_no',

                    name: 'serial_no'

                },

                {

                    data: 'company_name',

                    name: 'company_name',

                    orderable: false

                },

                {

                    data: 'application_type',

                    name: 'application_type'

                },
                {

                    data: 'type',

                    name: 'type',

                    orderable: false

                },
                {

                    data: 'issue_date',

                    name: 'issue_date'

                },

                {

                    data: 'expire_date',

                    name: 'expire_date'

                },

                

                {

                    data: 'name',

                    name: 'name',

                },

                {

                    data: 'status',

                    name: 'status',

                    orderable: false,

                    width:'max-content',

                    

                },
               
                {

                    data: 'action',

                    name: 'action',

                    orderable: false,

                    searchable: false

                },

            ],

            order: [

                [1, 'asc']

            ],

            createdRow: function(row, data, dataIndex) {

                // Set data-id attribute for each row

                $(row).attr('data-id', data.id);

            },

            initComplete: function (d) {

                $('#application_table tbody').on('click', 'tr', function() {
                    
                       var isSubmited = $(this).find('td:eq(7)').text();
                      
                       if (isSubmited == 'Submited') {
                           $(this).toggleClass('selected');
                       }
                   });

                this.api().columns([2,4,8]).every(function () {

                var column = this;

                // var Jobs = $("#application_table th").eq([d]);

                // console.log(1,Jobs);



                var select = $('<select class="drop-down"><option value="">ALL</option></select>')

                        .appendTo($(column.header()))

                        .on('change', function () {



                            var val = $.fn.dataTable.util.escapeRegex(

                                $(this).val()

                            );



                            console.log('Before Search:', column);

                            column

                                .search(val ? '^' + val + '$' : '', true, false)

                                .draw();

                            console.log('After Search:', column);



                            if(val=='Activated' || val=='Approved'){

                                $("#printRecord").removeAttr('disabled');

                            }else{

                                $("#printRecord").attr('disabled','disabled');
                            }



                            // if(val=='Verified' || val=='Submited'){

                            //     $("#approveRecord").removeAttr('disabled');
                            //     $("#verifiedRecord").removeAttr('disabled');

                            // }
                            if(val=='Verified' || val=='Submited' ){

                                $("#approveRecord").removeAttr('disabled');
                                // $("#verifiedRecord").removeAttr('disabled');
                            }
                            else{

                                $("#approveRecord").attr('disabled','disabled');
                                // $("#verifiedRecord").attr('disabled','disabled');

                            }

                        });

                        // Check the index of the column header
                        var columnIndex = column.index();
                        if(columnIndex == 2)
                        {
                            $.each(Entitynames, function(index, value) {
                                select.append('<option value="' + value + '" >' + value + '</option>');
                            });
                        }
                        else if(columnIndex == 4)
                        {
                            select.append('<option value="Other">Other</option>');
                        }
                        else
                        {
                            $.each(statuses, function(index, value) {
                                select.append('<option value="' + value + '">' + value + '</option>');
                            });
                        }
                        

                        var state = table.state.loaded();
                        if (state) {
                            var selectedValue = state.columns[column.index()].search.search;
                            if (selectedValue) {
                                select.val(selectedValue.substring(1, selectedValue.length - 1));
                            }
                        }

                    

                });
                table.state.saveParams = function(settings, data) {
                    data.columns.forEach(function(column, index) {
                        var select = $(table.column(index).header()).find('.drop-down');
                        data.columns[index].search = select.val() ? '^' + select.val() + '$' : '';
                    });
                };

            },

        });

        

         

        $('#application_table tbody').on('click', 'tr', function() {

            $(this).toggleClass('selected');

        });       



        $('#approveRecord').on('click', function() {

            var selectedIds = getSelectedRowIds();

            console.log(selectedIds);

            $.ajax({

                url: "{{route('entity.approveapp')}}",

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                method: 'POST',

                cache: false, // Disable caching                

                data:{ids:selectedIds},

                success: function (data) {

                    window.location.reload();

                }

            })

        });
        
        $('#verifiedRecord').on('click', function() {

            var selectedIds = getSelectedRowIds();

           
            $.ajax({

                url: "{{route('entity.verifiedapp')}}",

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                method: 'POST',

                cache: false, // Disable caching                

                data:{ids:selectedIds},

                success: function (data) {

                    window.location.reload();

                }

            })

        });



        $('#printRecord').on('click', function() {

            var selectedIds = getSelectedRowIds();

            $.ajax({

            url: "{{route('entity.generate-pdf')}}",

            method: 'POST',

            data: { selectedIds: selectedIds },

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            success: function (data) {

                if (data && data.pdfPath) {

                        var viewUrl = "{{ asset('public/pdfs/idcard-generated.pdf') }}";

                        // Open the PDF in a new tab

                        window.open(viewUrl, '_blank');

                } else {

                    // Handle error or show a message

                    console.error('Error downloading PDF');

                }

            },

            error: function (error) {

                console.error('Error downloading PDF:', error);

            }

        });

            console.log(selectedIds);

        });

    });

    // Function to get selected row IDs

    function getSelectedRowIds() {

        var selectedIds = [];

        $('#application_table tbody tr.selected').each(function() {

            var id = $(this).data('id'); // Assuming you have a data-id attribute

            selectedIds.push(id);

        });

        return selectedIds;

    }



    $(document).on('click', '.viewApplication', function () {

        console.log($(this).data('id'));

        var id = $(this).data('id');

        $.ajax({

            url: httpPath + 'entity/getApplication/' + id,

            success: function (data) {

                $("#viewApplicationModal .modal-content").html(data);

                $("#viewApplicationModal").modal('show');

            }

        })

    });



    $(document).on('click', '#approve_application', function () {

        var url = $(this).attr('data-link');

        showConfirmation({

            title: 'Are you sure?', confirmButtonText: 'Yes, Approve', text: 'You want to Approve this Application?', isScrollUp: 'Yes', redirectPage: url

        });

    });



    $(document).on('click', '#reject_application', function () {

        var link = $(this).attr('data-link');

        var id = $(this).data('id');

        $("#submit_reject_application").attr('data-link', link);

        $("#rejectApplicationModal textarea").text(null);

        $("#application_id").val(id);

        $("#viewApplicationModal").modal('hide');

        $("#rejectApplicationModal").modal('show');

    });



    $(document).on('click', '#cancel_reject_application', function () {

        $("#rejectApplicationModal").modal('hide');

        $("#viewApplicationModal").modal('show');

    });



    var _rejectFormValidations = FormValidation.formValidation(

        document.getElementById('rejectForm'),

        {

            fields: {

                comment: {

                    validators: {

                        notEmpty: {

                            message: 'Please enter a reason to reject the ID Card application.'

                        }

                        // Add more validators if needed

                    }

                }

                // Add more fields if needed

            },

            plugins: {

                trigger: new FormValidation.plugins.Trigger(),

                bootstrap: new FormValidation.plugins.Bootstrap(),

            }

        }

    );



    $('#submit_reject_application').on('click', function (e) {

        e.preventDefault();



        // Validate the form

        _rejectFormValidations

            .validate()

            .then(function (status) {

                if (status === 'Valid') {

                    // Proceed with your confirmation logic

                    var url = $('#submit_reject_application').attr('data-link');

                    showConfirmation({

                        title: 'Are you sure?',

                        confirmButtonText: 'Yes, Reject',

                        text: 'You want to Reject this Application?',

                        isScrollUp: 'Yes',

                        submitPage: 1,

                        formId: 'rejectForm',

                        // redirectPage : 'applications'
                    });

                    // You can submit the form if needed

                    // $('#rejectForm').submit();

                }

            });

    });

/**

 * Functions for confirmation alert box

 */

function showConfirmation(params) {

    var title = params.title;

    var text = params.text;

    var confirmButtonText = params.confirmButtonText;

    var form = "#" + params.formId;

    var isScrollUp;

    Swal.fire({

        title: title,

        text: text,

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#3085d6',

        cancelButtonColor: '#d33',

        confirmButtonText: confirmButtonText

    }).then((result) => {

       
        if (result.isConfirmed) {

           
            if (params.redirectPage) {

                window.location.href = params.redirectPage;

            } else if (params.submitPage) {

                $(form).submit();

            }

            // Handle the confirmed action here

            // Swal.fire(

            //     'Deleted!',

            //     'Your file has been deleted.',

            //     'success'

            // );

        } else {

            if (params.formId == 'rejectForm') {

                $("#rejectApplicationModal").modal('show');

            }
            else if(params.formId == 'sendbackForm')
            {
                $("#sendbackApplicationModal").modal('show');
            }

        }

    });

}

function verifyentityapplication(id)
{
    Swal.fire({
        title: `Are you sure you want to Verify?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX request
            $.ajax({
                url: httpPath+'entity/verifiedapp',
                type: 'POST',
                data: { id: id, },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response if needed
                    $('#viewApplicationModal').modal('hide');
                    window.location.reload();
                    // $('#application_table').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error response if needed
                    Swal.fire('Error', 'An error occurred. Please try again later.', 'error');
                }
            });
        }
    });
}

function blockunentityapplication(id,status,msg)
{
    Swal.fire({
        title: `Are you sure you want to `+msg+`?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX request
            $.ajax({
                url: httpPath+'entity/blockorunblockapp',
                type: 'POST',
                data: { id: id,
                        status:status },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response if needed
                    $('#viewApplicationModal').modal('hide');
                    window.location.reload();
                    // $('#application_table').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                  
                    // Handle error response if needed
                    Swal.fire('Error', 'An error occurred. Please try again later.', 'error');
                }
            });
        }
    });
}

function surrenderverifyentityapplication(id)
{
    Swal.fire({
        title: `Are you sure you want to Verify?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX request
            $.ajax({
                url: httpPath+'entity/surrenderverifiedapp',
                type: 'POST',
                data: { id: id, },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response if needed
                    $('#viewApplicationModal').modal('hide');
                    window.location.reload();
                    // $('#application_table').DataTable().ajax.reload();
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


function terminateverifyentityapplication(id)
{
    Swal.fire({
        title: `Are you sure you want to Terminate?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX request
            $.ajax({
                url: httpPath+'entity/terminateverifiedapp',
                type: 'POST',
                data: { id: id, },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response if needed
                    $('#viewApplicationModal').modal('hide');
                    window.location.reload();
                    // $('#application_table').DataTable().ajax.reload();
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


$(document).on('click', '#sendback_application', function () {

        var link = $(this).attr('data-link');

        var id = $(this).data('id');

        $("#submit_sendback_application").attr('data-link', link);

        $("#sendbackApplicationModal textarea").text(null);

        $("#sendbackForm #application_id").val(id);

        $("#viewApplicationModal").modal('hide');

        $("#sendbackApplicationModal").modal('show');

        });



        $(document).on('click', '#cancel_sendback_application', function () {

        $("#sendbackApplicationModal").modal('hide');

        $("#viewApplicationModal").modal('show');

        });



        var _sendbackFormValidations = FormValidation.formValidation(

        document.getElementById('sendbackForm'),

        {

            fields: {

                comment: {

                    validators: {

                        notEmpty: {

                            message: 'Please enter a reason to reject the ID Card application.'

                        }

                        // Add more validators if needed

                    }

                }

                // Add more fields if needed

            },

            plugins: {

                trigger: new FormValidation.plugins.Trigger(),

                bootstrap: new FormValidation.plugins.Bootstrap(),

            }

        }

        );



        $('#submit_sendback_application').on('click', function (e) {

        e.preventDefault();



        // Validate the form

        _sendbackFormValidations

            .validate()

            .then(function (status) {

                if (status === 'Valid') {

                    // Proceed with your confirmation logic

                    var url = $('#submit_sendback_application').attr('data-link');

                    showConfirmation({

                        title: 'Are you sure?',

                        confirmButtonText: 'Yes, Send back',

                        text: 'You want to Send back this Application?',

                        isScrollUp: 'Yes',

                        submitPage: 1,

                        formId: 'sendbackForm'

                    });

                    Swal.fire({

        title: title,

        text: text,

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#3085d6',

        cancelButtonColor: '#d33',

        confirmButtonText: confirmButtonText

    }).then((result) => {

       
        if (result.isConfirmed) {

           
            if (params.redirectPage) {

                window.location.href = params.redirectPage;

            } else if (params.submitPage) {

                $(form).submit();

            }

            // Handle the confirmed action here

            // Swal.fire(

            //     'Deleted!',

            //     'Your file has been deleted.',

            //     'success'

            // );

        } else {

            if (params.formId == 'rejectForm') {

                $("#rejectApplicationModal").modal('show');

            }

        }

    });

                    // You can submit the form if needed

                    $('#sendbackForm').submit();
                }

            });

        });

    </script>

@endsection

