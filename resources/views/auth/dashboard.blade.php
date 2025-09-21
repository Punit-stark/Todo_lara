<div>
   <h1>welcome to dashboard</h1>
</div>
<!-- <a href="{{route('logout')}}">Logout</a> -->
   <!-- a tag bydefault takes get req -->

<div>
  <form action="{{route('logout')}}" method="post">
    @csrf
    <button>Logout</button>
  </form>
</div>



