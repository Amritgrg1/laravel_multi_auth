@include('nav')

<h1>Dashboard_admin</h1>

<p>Hi, Welcome {{Auth::guard('web')->user()->name}}</p>