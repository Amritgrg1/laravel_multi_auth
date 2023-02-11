@include('nav')

<h2>forget password</h2>

<form action="{{route('forget_password_submit')}}" method="post">
    @csrf


    <label>Email:</label>
    <input type="text" name="email" id=""><br>
    <input type="submit" value="submit">
    <a href="{{route('login')}}">back to login page</a>
</form>