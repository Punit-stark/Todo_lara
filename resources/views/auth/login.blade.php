<div>
<form action="{{route('login')}}" method="post">
    @csrf
   email: <input type="text" require name="email">
   password: <input type="text" require name="password">
   <button>Submit</button>
</form>
</div>
