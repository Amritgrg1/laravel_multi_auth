@include('nav')

<h2>register page</h2>

<form action="{{route('register_submit')}}" method="post">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" id=""><br>
    <label>Email:</label>
    <input type="text" name="email" id=""><br>
    <label>Password:</label>
    <input type="password" name="password" id=""><br>
    <label>Re-type Password:</label>
    <input type="password" name="retype_password" id=""><br>
    <input type="submit" value="make registration">
</form>