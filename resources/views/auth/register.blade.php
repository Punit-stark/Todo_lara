<div>
<form action="{{route('register')}}" method="POST">
    @csrf
    Name: <input type="text" require name="name">
    email: <input type="text" require name="email">
    password: <input type="text" require name="password">
    <button>Submit</button>
</form>
</div>
