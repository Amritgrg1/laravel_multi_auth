@include('nav')

<h1>Dashboard - user</h1>

<p>Hi, Welcome {{Auth::guard('web')->user()->name}}</p>