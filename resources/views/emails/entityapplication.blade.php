<div>



    {{-- <p><img width="200px;" src="{{ asset('/img/logo.png') }}"/></p> --}}

    <p>Hello {{ ucfirst($authorized_signatory) }},</p>

    @if($application_type == 1)

        <p>We would like to inform you that the entity application {{ !empty($application_number) ? 'with Application Number '.$application_number : '' }} has been Renewed.</p>

    @elseif($application_type == 0)

    <p>We would like to inform you that the entity application {{ !empty($application_number) ? 'with Application Number '.$application_number : '' }} has been Created.</p>

    @else

    <p>We would like to inform you that the entity application {{ !empty($application_number) ? 'with Application Number '.$application_number : '' }} has been Surrendered.</p>

    @endif

    <p> Name - {{ $name }} </p>

    <p> Designation - {{ $designation }}</p>

    {{-- <p> Date of birth - {{ $date_of_birth }} </p>

    <p> Gender - {{ $gender }} </p> --}}

    <p> Mobile Number - {{ $mobile_number }} </p>

    <p> Type - {{ $type }} has been created.</p>

    <p>Authorized Signatory - {{ $authorized_signatory }} </p>

    <p>Issue Date - {{ $issue_date }} </p>

    @if ($type != 'Other')
        <p>Expire Date - {{ $expire_date }} </p> 
    @endif
    {{-- <img src="{{ $image }}" style="height:50px;width:50px;" alt="">

    <img src="{{ $qrcode }}"  style="height:50px;width:50px;" alt=""> --}}

    <p>{{ env('APP_NAME') }}</p>

    

</div>