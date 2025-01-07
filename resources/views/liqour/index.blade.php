@extends('layouts.default')

@section('pageTitle', 'Roles')



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

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Liquor Applications</h2>

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

                <a href="{{ route('liqour.create-new-liqour-application')}}" class="btn btn-primary font-weight-boldest text-uppercase left-gap" id="add_new">

                   Add Liquor Application

                </a>

               
                @if ($liqourApplicationCount > 0)
                    <a href="javascript:;" class="btn btn-primary font-weight-boldest text-uppercase left-gap" id="liqour_data_filter_modal">
                            Report
                            </a>
                @endif

                <button id="liqourprintRecord" class="btn btn-warning left-gap" disabled="disabled" title="If status is Activated then you can print">PDF</button>

              
                

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

                        <div class="table-responsive">

                            <table class="table table-separate datatable table-head-custom table-checkable dataTable no-footer dtr-inline"  id="liqour-application-tabel">

                                <thead>

                                    <tr class="text-uppercase">
                                        <TH></TH>
                                    {{-- <th width="30px">Count</th> --}}

                                    {{-- <th>Application Number</th> --}}

                                    <th>Serial Number</th>

                                    <th>Name</th>

                                    <th>Company Name</th>

                                    <th>Designation</th>

                                    <th>Mobile Number</th>

                                    <th>Scan Count</th>

                                    <th>Issue Date</th>

                                    

                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th width="15%">Action</th>

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

<div class="modal fade bd-example-modal-lg" id="role_form_modal" tabindex="-1" role="dialog"

    aria-labelledby="myLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span

                        aria-hidden="true">×</span> </button>

            </div>

            <div class="modal-body">



            </div>

        </div>

    </div>

</div>


<div class="modal fade" id="liqourDataFilterModal" tabindex="-1" role="dialog" aria-labelledby="liqourDataFilterModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Liquor Application Report (xls)</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>


        {!! Form::open(['route' => 'liqour.fetch-liqour-application-data-filter-form', 'class' => 'form', 'id' => 'liqour_application_data_filter_form', 'action-for' => 'add']) !!}

            <div class="card-body row">
                <div class="col-lg-12">

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Date Range: *</label>

                            <input class="form-control" id="kt_daterangepicker_1_modal"  name="liqour_filter_datarange" placeholder="Select time" type="text">
                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Company List: *</label>

                            <select class="form-control datatable-input" id="liqour_filter_company" name="liqour_filter_company">
                                    <option value="">Select Company</option>
                                    <option value="0">All</option>
                                @foreach ($companyList as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <div class="row">

                    <div class="col-lg-5"></div>

                    <div class="col-lg-7">

                        <button id="liqour_application_data_filter_submit_button" type="button" class="btn btn-primary mr-2">Generate report</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}
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

    {{-- <script src="{{ URL::asset('js/liqour.js') }}"></script> --}}

    <script type="text/javascript">
   
    var statuses = <?php echo json_encode($isActiveStatuses); ?>;
        var table = $('#liqour-application-tabel').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('liqour.liqour-index') }}",

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', visible: true, orderable: true,
                render: function (data, type, full, meta) {
                // Calculate the row index in descending order
                    var pageInfo = table.page.info();
                    var rowIndex = pageInfo.recordsTotal - meta.row - pageInfo.start;
                    return rowIndex;
                } 
                //  render: function (data, type, full, meta) {
                //             if (type === 'display' && full.is_active === 'Inactive') {
                //                 return meta.settings._iRecordsTotal - meta.row;
                //             }
                //             if (type === 'display' && full.is_active === 'Active') {
                //                 return meta.settings._iRecordsTotal - meta.row;
                //             }else {
                //                 return data;
                //             }
                //         }  
                    },
                    // { data: 'count', name: 'count', searchable: true,
                    //     render: function (data, type, full, meta) {
                    //         if (type === 'display' && full.is_active === 'Inactive') {
                    //             return meta.settings._iRecordsTotal - meta.row;
                    //         }
                    //         if (type === 'display' && full.is_active === 'Active') {
                    //             return meta.settings._iRecordsTotal - meta.row;
                    //         }else {
                    //             return data;
                    //         }
                    //     } 
                    // },
                    { data: 'serial_number', name: 'serial_number', searchable: true },
                    { data: 'name', name: 'name', searchable: false },
                    { data: 'company_name', name: 'company_name', searchable: true },
                    { data: 'designation', name: 'designation', searchable: true },
                    { data: 'mobile_number', name: 'mobile_number', searchable: true },
                    { data: 'scan_count', name: 'scan_count', searchable: false },
                    { data: 'issue_date', name: 'issue_date', searchable: false },
                    { data: 'expiry_date', name: 'expiry_date', searchable: false },
                    {data: 'is_active', name: 'is_active', searchable: false }, // Define the hidden column
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],

                order: [[1, 'desc']], // Default ordering in descending order
                drawCallback: function () {
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var startIndex = pageInfo.start;

                    api.column(0, {order: 'applied'}).nodes().each(function(cell, i) {
                        cell.innerHTML = pageInfo.recordsTotal - startIndex - i;
                    });
                },
            createdRow: function(row, data, dataIndex) {
              
                // Set data-id attribute for each row

                    $(row).attr('data-id', data.id);

                },

                initComplete: function (d) {
                   
                    $('#liqour-application-tabel tbody').on('click', 'tr', function() {
                        var isActive = $(this).find('td:eq(9)').text();
                       
                        if (isActive == 'Active') {
                            $(this).toggleClass('selected');
                        }
                    });
                    
                    
                this.api().columns([9]).every(function () {

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

                            if(val=='Active'){
                                $("#liqourprintRecord").removeAttr('disabled');
                            }else{
                                $("#liqourprintRecord").attr('disabled','disabled');
                            }



                           

                        });



                        var columnIndex = column.index();
                        if(columnIndex == 9)
                        {
                            $.each(statuses, function(index, value) {
                                select.append('<option value="' + value + '" >' + value + '</option>');
                            });
                        }
                        

                });

            },

        });


       


      

        $(function () {

            checkInput();

        });



        function checkInput() {

            $('.permission .check-all').click(function () {

                var check = this.checked;

                $(this).parents('.nav-item').find('.check-one').prop("checked", check);

            });

            $('.permission .check-one').click(function () {

                var parentItem = $(this).parents('.nav-treeview').parents('.nav-item');

                var check = $(parentItem).find('.check-one:checked').length == $(parentItem).find(

                    '.check-one').length;

                $(parentItem).find('.check-all').prop("checked", check)

            });

            $('.permission .check-all').each(function () {

                var parentItem = $(this).parents('.nav-item');

                var check = $(parentItem).find('.check-one:checked').length == $(parentItem).find(

                    '.check-one').length;

                $(parentItem).find('.check-all').prop("checked", check)

            });

        }



        $(document).on('change', '.schedule_no', function () {

            console.log($(this), $(this).parent().find('.schedule_time'));

            if ($(this).val() == 0) {

                $(this).parent().find('.schedule_time').attr('disabled', 'disabled');

            } else {

                $(this).parent().find('.schedule_time').removeAttr('disabled');

            }

        });





        // $(document).on('click', '#add_new', function () {

        //     // window.addEventListener('load', function() {



        //     // }, false);

        //     $.ajax({

        //         url: "{{ route('liqour.create-new-liqour-application') }}",

        //         success: function (response) {

        //             // console.log(response);

        //             $(".modal-body").html(response);

        //             $(".modal-title").html("Add Role");

        //             checkValidation();

        //             checkInput();

        //             $("#role_form_modal").modal('show');

        //         }

        //     });

        // });



        // $(document).on('click', '.edit_form', function () {

        //     var id = $(this).data('id');



        //     $.ajax({

        //         url: $(this).data('path'),

        //         success: function (response) {

        //             // console.log(response);

        //             $(".modal-body").html(response);

        //             $(".modal-title").html("Update Role");

        //             checkValidation();

        //             checkInput();

        //             $("#role_form_modal").modal('show');

        //         }

        //     });

        // });



        $(document).on('click', '.delete-liqour-application', function () {

            if (confirm("Are you sure to delete this application?")) {

                let id = $(this).data("id");



                $.ajax({

                    type: 'post',

                    url: httpPath+'liqour/deleteLiqourApplication',

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



        function printCard(id){

            $.ajax({

                url: 'liqourApplicationGenerateCardToPrint/'+id, // Your server endpoint URL

                method: 'GET',

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                // data: { id: id }, // Data to be sent in the request

                success: function(response) {

                    // Print the HTML response directly to the document

                    console.log(response);

                    w = window.open(window.location.href,"_blank");

                    w.document.open();

                    w.document.write(response);

                    w.document.close();

                    setTimeout(function() {

                        w.window.print();

                    }, 10);                    

                },

                error: function(xhr, status, error) {

                    console.error(error); // Log any errors

                }

            });

        }
        $('#liqourprintRecord').on('click', function() {

                var selectedIds = getSelectedRowIds();

                $.ajax({

                url: "{{route('liqour.liqour-generate-pdf')}}",

                method: 'POST',

                data: { selectedIds: selectedIds },

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                success: function (data) {

                    if (data && data.pdfPath) {

                        data.pdfPath = baseUrl + 'pdfs/liqour/liqour-card-generated.pdf';
                        // Initiate download on the client side
                        var downloadLink = document.createElement('a');
                        
                        downloadLink.href = data.pdfPath;
                        downloadLink.download = 'liqour-card-generated.pdf';
                        downloadLink.click();

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
        function getSelectedRowIds() {

            var selectedIds = [];

            $('#liqour-application-tabel tbody tr.selected').each(function() {

                var id = $(this).data('id'); // Assuming you have a data-id attribute

                selectedIds.push(id);

            });

            return selectedIds;

            }
    </script>

@endsection

