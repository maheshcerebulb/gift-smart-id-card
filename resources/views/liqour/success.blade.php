@extends('layouts.default')

@section('pageTitle', 'Application - Success')

@section('content')

<div class="main d-flex flex-column flex-row-fluid">

    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">

        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        </div>

    </div>

    <!--end::Subheader-->

    <!--begin::Content-->

    <div class="content flex-column-fluid" id="kt_content">

        <div class="card card-custom">

            <div class="card-body p-0">

                <div class="bg-light-success text-success">

                    <div class="rounded border p-10">

                        <div class="d-flex flex-wrap align-items-center">

                            <div class="w-350px h-350px d-flex flex-column flex-center me-5 mb-5 fw-semibold">

                                <img src="{{ asset('/img/form-report.jpg') }}" class="max-h-250px" />

                            </div>

                            <div class="d-flex flex-column flex-center me-5 mb-5 fw-semibold">

                                <p class="font-size-h2">Your Serail no: {{ $liqour_application_details->serial_number}} has been successfully submitted</p>

                                <div class="d-flex">

                                    <a href="{{ url('liqour/createNewLiqourApplication') }}" class="btn btn-warning btn-shadow font-weight-bold mr-2">Add new application</a>

                                    <a onclick="getLiqourApplicationGeneratedCard({{ $liqour_application_details->id }})" class="btn btn-success  mr-2 white font-weight-bold" href="javascript:;" title="Edit">PDF</a>

                                    <a onclick="printCard({{ $liqour_application_details->id}})" class="btn btn-success mr-2 white font-weight-bold" href="javascript:;" title="Edit">Print</a>

                                </div>

                                

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection



@section('scripts')

<script type="text/javascript">

function printCard(id){

    $.ajax({

        url: '{{url("liqour/liqourApplicationGenerateCardToPrint/")}}'+"/"+id, // Your server endpoint URL

        method: 'GET',

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },

        // data: { id: id }, // Data to be sent in the request

        success: function(response) {

            // Print the HTML response directly to the document

            console.log(response.message);

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

</script>

@endsection