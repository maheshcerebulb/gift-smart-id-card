@extends('layouts.default')

@section('pageTitle', 'Recent Application List')



@section('css')

    <link href="{{ URL::asset('datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />

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

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Special Application List</h2>

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

                {{-- <a href="javascript:;" onclick="generateCardPdf()" class="btn btn-light font-weight-boldest text-uppercase">

                    <i class="flaticon2-left-arrow-1"></i>Generate Card PDF

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

        <!-- End:: flash message element -->

        <div class="row">

            <div class="col-lg-12">

                <div class="card card-custom card-border gutter-b border-0">

                    <div class="card-body p-0">

                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <table class="table table-separate datatable table-head-custom table-checkable dataTable no-footer dtr-inline" id="application_table">

                                <thead>

                                    <tr class="text-uppercase">

                                        <th>No</th>

                                        {{-- <th>Application Number</th> --}}
                                        <th>Serial No.</th>
                                        {{-- <th>Entity</th> --}}

                                        <th>Application Type</th>

                                        <th>Application</th>

                                        <th>Date</th>

                                        <th>Expiry Date</th>

                                        <th>Employee Name</th>

                                        <th>Status</th>
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
    var statuses = <?php echo json_encode($statuses); ?>;
    var applicationTypes = <?php echo json_encode($applicationTypes); ?>;

    $(document).ready(function() {

        var table = $('#application_table').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('admin.special-entity-view') }}",

            columns: [

                {

                    data: 'DT_RowIndex',

                    name: 'DT_RowIndex',

                    orderable: false,

                    searchable: false,

                    visible:false,

                },

                //{
//
                //    data: 'application_number',
//
                //    name: 'application_number'
//
                //},
                {

                    data: 'serial_no',
                    
                    name: 'serial_no'
                    
                },
                {

                    data: 'application_type',

                    name: 'application_type'

                },
                {

                    data: 'type',

                    name: 'type'

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

                    orderable: false,

                },

                {

                    data: 'status',

                    name: 'status',

                    orderable: false,

                },

            ],

            order: [

                [3, 'DESC']

            ],
            initComplete: function (d) {

                   
                    this.api().columns([7,3]).every(function () {

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


                            });

                            // Check the index of the column header
                            var columnIndex = column.index();
                            if(columnIndex == 7)
                            {
                                $.each(statuses, function(index, value) {
                                    select.append('<option value="' + value + '" >' + value + '</option>');
                                });
                            }
                            else if(columnIndex == 3)
                            {
                                $.each(applicationTypes, function(index, value) {
                                    select.append('<option value="' + value + '" >' + value + '</option>');
                                });
                            }
                            
                        });

                    },

        });





    });



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

                        formId: 'rejectForm'

                    });

                    // You can submit the form if needed

                    $('#rejectForm').submit();

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

        }

    });

}

    </script>

@endsection

