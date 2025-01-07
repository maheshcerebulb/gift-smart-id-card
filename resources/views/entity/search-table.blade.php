<table class="table table-separate datatable table-head-custom table-checkable dataTable no-footer dtr-inline">

    <thead>

        <tr>

            <th>#</th>

            <th>Serial Number</th>

            <th>Application Type</th>

            <th>Date</th>

            <th>Expire Date</th>

            <th>Employee Name</th>

            <th>Status</th>

            <th>Action</th>

        </tr>

    </thead>

    <tbody>

        @if(count($entityApplicationData))

            @php

                $counter = 1;

            @endphp

            @foreach ($entityApplicationData as $entity)

                <tr>

                <td>{{ $counter++ }}</td>

                <td>
				@if ($entity->type == 'Other')
                        {{ $entity->final_special_serial_no }}
                    @else
                        {{ $entity->serial_no }}
                    @endif
				</td>

                <td>{{ $entity->type }}</td>

                <td>{{ date('d-m-Y',strtotime($entity->issue_date)) }}</td>

                <td>
					@if ($entity->type != 'Other')
						{{ date('d-m-Y',strtotime($entity->expire_date)) }}
                    @endif
				</td>

                <td>{{ $entity->getFullNameAttribute() }}</td>

                <td>{{ Helper::getApplicationType($entity->status) }}</td>

                <td>

				<a href="{{url('search/surrenderApplication/'.$entity->id)}}" class="btn btn-sm btn-common font-weight-bolder mr-1 px-10" title="Edit">Surrender</a>              
               
                    
					 @php
                        $currentDate = date('Y-m-d');
                        $expireDate = date('Y-m-d',strtotime($entity->expire_date));
                        $daysUntilExpiration = (strtotime($expireDate) - strtotime($currentDate)) / (60 * 60 * 24);
                        $isExpired = strtotime($currentDate) >= strtotime($expireDate);
                    @endphp
                    
					@if ($entity->status == '501' || ($daysUntilExpiration <= 10 || $isExpired))
							<!--<a href="{{url('search/renewApplication/'.$entity->id)}}" class="btn btn-sm btn-common font-weight-bolder px-10" data-id="{{$entity->id}}" title="Delete">Renew</a>-->                
					   
					@endif

                </td>



                </tr>



            @endforeach

        @else

            <tr>

                <td colspan="10">

                    <p>No records found</p>

                </td>

            </tr>

        @endif

    </tbody>

</table>