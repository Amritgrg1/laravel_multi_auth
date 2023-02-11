<a href="{{route('home')}}">home</a>

@if(Auth::guard('web')->user())

@if(Auth::guard('web')->user()->role == 0)
<a href="{{route('dashboard_admin')}}">Dashboard</a>
<a href="{{route('settings')}}">settings</a>
@endif


@if(Auth::guard('web')->user()->role == 2)
<a href="{{route('dashboard_user')}}">Dashboard</a>
@endif
<a href="{{route('logout')}}">Logout</a>

@endif

@if(!Auth::guard('web')->user())

<a href="{{route('login')}}">Login</a>
<a href="{{route('register')}}">Register</a>
@endif