<div>
    <h1>this is dashboard</h1>
    <form action="{{route('create.store')}}" method="post">
        @csrf
        <label for="">Category</label>
        <select name="category_id" id="" require>
            <option value="">--choose--</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>

        <input type="text" name="title" require placeholder="enter your title">
        <textarea name="content" id=""></textarea>
        <button>Add</button>
    </form>
    <div>
        <table>
            <tr>
                <th>title</th>
                <th>content</th>
            </tr>
            @foreach($todos as $todo)
            <tr>
                <td>{{$todo->category->name}}</td>
                <td>{{$todo->title}}</td>
                <td>{{$todo->content}}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div>
  <form action="{{route('logout')}}" method="post">
    @csrf
    <button>Logout</button>
  </form>
</div>
</div>