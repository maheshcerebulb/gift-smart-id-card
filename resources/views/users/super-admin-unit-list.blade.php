@extends('layouts.default')

@section('pageTitle', 'Unit List')



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

        <div class="container-fluid">

            <!--begin::Info-->

            <div class="d-flex justify-content-between align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->

                <div class="d-flex align-items-baseline flex-wrap mr-5">

                    <!--begin::Page Title-->

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Unit List</h2>

                    <!--end::Page Title-->

                </div>
                <div >
                    <a href="{{ route('welcome') }}" class="btn btn-light font-weight-boldest text-uppercase">

                        <i class="flaticon2-left-arrow-1"></i>Back To Dashboard

                    </a>

                </div>

                <!--end::Page Heading-->

            </div>

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

                        <table class="table table-hover table-head-custom table-vertical-center" id="superadmin_unit_table">

                                <thead>

                                    <tr class="text-uppercase">

                                        <th>No</th>
                                        <th>Application Number</th>
                                        <th>Date</th>
                                        <th>Unit Category</th>
                                        <th>Company Name</th>
                                        <th>Authorized Person Name</th>
                                        <th>email</th>
                                        <th>Authorized Person Mobile Number</th>
                                        {{-- <th>Action</th> --}}

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
 
   var unitAddress = <?php echo json_encode($unitAddress); ?>;
    $(document).ready(function() {

        

        var table = $('#superadmin_unit_table').DataTable({

            select: 'multi',// 'single' or 'multi' for single or multiple row selection

            processing: true,

            serverSide: true,
            dom: 'Bfrtip',
            lengthMenu: [[-1], ["All"]],
            buttons: [
               'excel',
            ],
            ajax: {
                url: "{{ route('admin.unitlist-view') }}",
                type: "POST", // or "POST" depending on your route definition
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d) {
                    // Add parameters here
                    d.building = unitAddress;
                    // Add more parameters if needed
                }
            },

            columns: [

                {

                    data: 'DT_RowIndex',

                    name: 'DT_RowIndex',

                    orderable: false,

                    searchable: false,

                    visible:false,

                },
                {
                    data: 'application_number',

                    name: 'application_number',

                    orderable: false

                },
                {

                    data: 'created_at',

                    name: 'created_at'

                },
                {

                    data: 'unit_category',

                    name: 'unit_category'

                },
                
                {

                    data: 'company_name',

                    name: 'company_name'

                },
                {

                    data: 'authorized_person_name',

                    name: 'authorized_person_name',

                    orderable: false

                },
               
                {

                    data: 'email',

                    name: 'email',

                    orderable: false

                },
                {

                    data: 'authorized_person_mobile_number',

                    name: 'authorized_person_mobile_number',

                    orderable: false

                },
                // {

                //     data: 'action',

                //     name: 'action',

                //     orderable: false,

                //     searchable: false

                // },

            ],

            order: [

                [1, 'asc']

            ],

            createdRow: function(row, data, dataIndex) {

                // Set data-id attribute for each row

                $(row).attr('data-id', data.id);

            },

            initComplete: function (d) {
            },  

        });


        



        

    });

    // Function to get selected row IDs

    

    </script>

@endsection
