@include('nav')

<h2>Login page</h2>

<form action="{{route('login_submit')}}" method="post">
    @csrf
    <label>Email:</label>
    <input type="text" name="email" id=""><br>
    <label>Password:</label>
    <input type="password" name="password" id="">
    <input type="submit" value="submit">
    <a href="{{route('forget_password')}}">forget password?</a>
</form>