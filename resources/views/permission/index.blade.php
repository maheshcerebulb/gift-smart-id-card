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
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 class="text-dark font-weight-bold my-1 mr-5">Permissions</h2>
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
                <a href="javascript:;" class="btn btn-primary font-weight-boldest text-uppercase" id="add_new">
                    <i class="flaticon2-left-arrow-1"></i>Add Permissions
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
                <div class="card card-custom card-border gutter-b border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-separate datatable table-head-custom table-checkable dataTable no-footer dtr-inline"  id="permission-tabel">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th style="width:15%">No.</th>
                                        <th>Permission</th>
                                        <th>Module</th>
                                        <th>Guard</th>
                                        <th width="300px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="permission_form_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
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
        var table = $('#permission-tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('permission.index') }}",
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
                    data: 'module',
                    name: 'module'
                },
                {
                    data: 'guard_name',
                    name: 'guard_name'
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

        $(document).on('click', '#add_new', function() {
            $.ajax({
                url: "{{ route('permission.create') }}",
                success: function(response) {
                    $(".modal-body").html(response);
                    $(".modal-title").html("Add Permission");
                    createFunctions();
                    checkValidation();
                    $("#permission_form_modal").modal('show');
                }
            });
        });

        $(document).on('click', '.edit_form', function() {
            var id = $(this).data('id');
            $.ajax({
                url: $(this).data('path'),
                success: function(response) {
                    $(".modal-body").html(response);
                    $(".modal-title").html("Update Permission");
                    checkValidation();
                    // checkInput();
                    $("#permission_form_modal").modal('show');
                }
            });
        });

        $(document).on('click', '.delete-permission', function() {
            if (confirm("Are you sure to delete this permission?")) {
                let id = $(this).data("id");
                $.ajax({
                    type: 'DELETE',
                    url: 'permission/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id,
                         _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        table.draw();
                    }
                });
            }
        });

        function createFunctions(){
            let Testcount = $(".permission input:last").attr("name");
            let count = parseInt(Testcount.slice(5,6)) + 1;

            $(document).on('click', '#add', function(){

                let rules = '';
                let appendHtml = '<div class="each-input"> <input class="permissionInput form-control" name="name['+count+']" type="text" placeholder="Enter permission name"> <button type="button" class="btn btn-danger btn-remove">Remove</button> </div>';
                $('.append-list').append(appendHtml);
                rules = {
                    required: true,
                    maxlength: 250,
                    messages: {
                        required: 'The Permission field is required'
                    }
                };

                $('.append-list').find("[name='name["+count+"]']").rules('add', rules);
                count++;
            });

            $(document).on('click','.btn-remove', function(){
                $(this).parent('.each-input').remove();
            });

            $(document).on('click', '.remove-permission', function(){
                let id = $(this).data("id");
                $.ajax({
                    type:'POST',
                    url:"{{ route('permission.delete') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {'id': id},
                    success: function(data) {
                        toastr.success(data.msg);
                    },
                    error: function(data){
                        console.log('error while deleting')
                    }
                });
            });

            $(document).on('click', '#submitform', function(){
                if ($("#submitform").hasClass("update-permission")) {
                    event.preventDefault();
                }
            });

            $(document).on('click','.update-permission', function(){
                let permissionData = [];
                $('.each-input').each(function(i, obj) {
                    let permissionName = $(obj).find('input').val();
                    let permissionId  = $(obj).find('input').data("id");
                    permissionData.push([permissionId, permissionName]);
                });
            });
        }

        function checkValidation() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
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
