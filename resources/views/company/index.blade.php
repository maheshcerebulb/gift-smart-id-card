@extends('layouts.default')

@section('pageTitle', 'companys')



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

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Companies</h2>

                    <!--end::Page Title-->

                </div>

                <!--end::Page Heading-->

            </div>

            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center" style="gap: 10px;">

                <a href="{{ route('welcome') }}" class="btn btn-light font-weight-boldest text-uppercase">

                    <i class="flaticon2-left-arrow-1"></i>Back To Dashboard

                </a>

                <a href="javascript:;" class="btn btn-primary font-weight-boldest text-uppercase" id="add_new">

                    + Add Company

                </a>

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

                <div class="card card-custom card-border gutter-b">

                    <div class="card-body p-0">

                        <div class="table-responsive">

                        <table class="table table-hover table-head-custom table-vertical-center"  id="company-tabel">

                                <thead>

                                    <tr class="text-uppercase">

                                        <th width="30px"></th>

                                        <th>Name</th>

                                        <th>Application No</th>

                                        <th width="300px">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>



                            </table>



                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade bd-example-modal-lg" id="company_form_modal" tabindex="-1" company="dialog"

        aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="myLargeModalLabel">Add company</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span

                            aria-hidden="true">×</span> </button>

                </div>

                <div class="modal-body">



                </div>

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

        var table = $('#company-tabel').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('company.index') }}",

            columns: [{

                data: 'DT_RowIndex',

                name: 'DT_RowIndex',

                orderable: false,

                searchable: false

            },

            {

                data: 'name',

                name: 'name'

            },

            {

                data: 'application_no',

                name: 'application_no'

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

            ]

        });



        $(document).on('click', '#add_new', function () {

            // window.addEventListener('load', function() {



            // }, false);

            $.ajax({

                url: "{{ route('company.create') }}",

                success: function (response) {

                    // console.log(response);

                    $(".modal-body").html(response);

                    $(".modal-title").html("Add company");

                    checkValidation();

                    $("#company_form_modal").modal('show');

                }

            });

        });



        $(document).on('click', '.edit_form', function () {

            var id = $(this).data('id');



            $.ajax({

                url: $(this).data('path'),

                success: function (response) {

                    // console.log(response);

                    $(".modal-body").html(response);

                    $(".modal-title").html("Update company");

                    checkValidation();

                    $("#company_form_modal").modal('show');

                }

            });

        });



        $(document).on('click', '.delete-company', function () {

            if (confirm("Are you sure to delete this company?")) {

                let id = $(this).data("id");



                $.ajax({

                    type: 'DELETE',

                    url: 'company/' + id,

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },

                    data: {

                        'id': id,

                        _token: "{{ csrf_token() }}",

                    },

                    success: function (data) {

                        // toastr.success(data.msg);

                        table.draw();

                    },

                    error: function (data) {

                        table.draw();

                        // toastr.error('Something went wrong, Please try again');

                    }

                });

            }

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

    </script>

@endsection

