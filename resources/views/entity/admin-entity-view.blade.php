@extends('layouts.default')

@section('pageTitle', 'Recent Application List')



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

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Recent Entity List</h2>

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

                        <table class="table table-hover table-head-custom table-vertical-center" id="application_table">

                                <thead>

                                    <tr class="text-uppercase">
                                        <th>No</th>
                                        <th>Application Number</th>
                                        <th>Date</th>
                                        <th>Unit Category</th>
                                        <th style="width: 30px;">Company Name</th>
                                        <th>Entity Tower Name Sez</th>
                                        <th>Authorized Person Name</th>
                                        <th>email</th>
                                        <th>Authorized Person Mobile Number</th>
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





<div class="modal fade" id="viewApplicationModal" tabindex="-1" role="dialog" aria-labelledby="viewApplicationModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

        <div class="modal-content">



        </div>

    </div>

</div>




@endsection

<?php
 if(isset($unitAddress))
 {
    $encodedunitAddress = $unitAddress;
 }
 else {
    $encodedunitAddress = null;
 }
?>
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
 var BuildingAddress = <?php echo json_encode($BuildingAddress); ?>;
 var unitAddress = <?php echo json_encode($encodedunitAddress); ?>;

    $(document).ready(function() {        

        var table = $('#application_table').DataTable({

            select: 'multi',// 'single' or 'multi' for single or multiple row selection

            processing: true,

            serverSide: true,

            ajax: {
                url: "{{ route('admin.entity-view') }}",
                type: "GET",
                data: function(d) {
                    // Add unitAddress to the AJAX request data
                    d.unitAddress = unitAddress;
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

                    name: 'company_name',

                    width: '40px' // Set the width of the column to 40 pixels

                },
                {

                    data: 'company_address',

                    name: 'company_address'

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

                this.api().columns([5]).every(function () {

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
                        if(columnIndex == 5)
                        {
                            $.each(BuildingAddress, function(index, value) {
                                var option = $('<option value="' + value + '">' + value + '</option>');
                                // Check if the value matches the unit address, and mark it as selected
                                if (value === unitAddress) {
                                    option.prop('selected', true);
                                    
                                }
                                select.append(option);
                                
                            });
                            select.css('width', '50%');

                        }
                        
                });

                },

        });



        $(document).on('click', '.viewApplication', function () {

            console.log($(this).data('id'));

            var id = $(this).data('id');

            $.ajax({

                url: httpPath + 'entity/getEntity/' + id,

                success: function (data) {

                    $("#viewApplicationModal .modal-content").html(data);

                    $("#viewApplicationModal").modal('show');

                }

            })

        });

    });



    </script>

@endsection

