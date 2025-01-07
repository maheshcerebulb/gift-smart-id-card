<div>
    <p style="font-size: 10px;">{{ $emailNote }}</p>
    <p><img width="200px;" src="{{ asset('/img/logo.png') }}"/></p>
    <p>Hello,</p>
    <p>Your account has been created.</p>
    <p>To access your account please login with below credentials at URL: <a href="{{route('login')}}">{{route('login')}}</a></p>
    <p><b>Email: </b>{{ $email }}</p>
    <p><b>Password: </b>{{ $password }}</p>
    <p>{!! $signature !!}</p>
</div>