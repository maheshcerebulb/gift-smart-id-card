<div class="modal fade" id="buidlingcompaniesDataFilterModal" tabindex="-1" role="dialog" aria-labelledby="buidlingcompaniesDataFilterModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Report</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetExcelFilterForm()">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>


        {!! Form::open(['route' => 'user.buidling-companies-applications-data-filter-export', 'class' => 'form', 'id' => 'building_companies_applications_data_filter_form', 'action-for' => 'add']) !!}
            @csrf
            <div class="card-body row">
                <div class="col-lg-12">

                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Building List: *</label>

                            <select onchange="getBaseCompanyList(this.value)" class="form-control datatable-input" id="filter_building" name="filter_building">
                                    <option value="">Select Building</option>
                                    <option value="0">All</option>
                                @foreach ($buildingList as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-lg-10">

                            <label>Company List: *</label>

                            <select class="form-control datatable-input" id="filter_company" name="filter_company">
                                    <option value="">Select Company</option>
                                    <option value="0">All</option>
                                    @foreach ($filterCompanyData as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                    @endforeach
                                {{-- @foreach ($companyList as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach --}}
                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <div class="row">

                    <div class="col-lg-5"></div>

                    <div class="col-lg-7">

                        <button id="building_companies_applications_data_filter_submit_button" type="button" class="btn btn-primary mr-2">Generate report</button>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}
        </div>

    </div>

</div>