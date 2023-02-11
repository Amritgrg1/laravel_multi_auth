@include('nav')

<h2>Reset password</h2>

<form action="{{route('reset_password_submit')}}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{$token}}">
    <input type="hidden" name="email" value="{{$email}}">
    <label>New Password:</label>
    <input type="password" name="new_password" id=""><br>
    <label>Retype Password:</label>
    <input type="password" name="retype_password" id=""><br>
    <input type="submit" value="update">
</form>