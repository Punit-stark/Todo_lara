<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-6">

        <h1 class="mb-4 text-center"> Welcome, {{ auth()->user()->name }}! </h1>

        <!-- Add Todo Form -->
        <div class="card mb-6">
            <div class="card-header bg-primary text-white">
                Add New Todo
            </div>
            <div class="card-body">
                <form action="{{route('create.store')}}" method="post" id="addform">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">--Choose--</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (isset($todo) && $todo->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter your title" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="3" placeholder="Enter content"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Add Todo</button>
                </form>
            </div>
        </div>

        <!-- Todo List Table -->
        <div class="card mb-5">
            <div class="card-header bg-secondary text-white">
                Todo List
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                        <tr data-id="{{ $todo->id }}">
                            <td>{{ $todo->category->name }}</td>
                            <td>{{ $todo->title }}</td>
                            <td>{{ $todo->content }}</td>
                            <td>
                                <a href="{{route('post.edit',$todo->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                            <td>
                                <button id="deleteTodo" class="btn btn-danger btn-sm">Delete</button>
                                <!-- <form action="{{route('post.delete',$todo->id)}}" id="deletetodo" method="post" onsubmit="return confirm('Delete the Todo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Logout Button -->
        <div class="text-center">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-warning">Logout</button>
            </form>
        </div>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // fetch and display
            function fetch() {
                $.ajax({
                    url: "{{route('dashboard')}}",
                    type: "GET",
                    success: function(data) {
                        console.log(data);
                        // update table with data and loop
                    },
                    error: function(xhr) {
                        console.log("fetch error", xhr.responseText);
                    }
                });
            }

            // add
            $('#addform').submit(function(e) {
                e.preventDefault(); //browser default event
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{route('create.store')}}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        $('#addform')[0].reset(); //reset form
                    },
                    error: function(xhr) {
                        console.log("Add error:", xhr.responseText);
                    }
                });
            });


            //delete
            $(document).on('click', '#deleteTodo', function() {
                if (!confirm("Delete this todo")) return;

                let tr = $(this).closest('tr'); //click on delete btn dom tree search closest ele(row)
                let id = tr.data('id'); //value of data id

                $.ajax({
                    url: `/dashboard/${id}`, //dynamic tables with multiple rows or AJAX
                    type: "DELETE",
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data) {
                        console.log("deleted success", data);
                        tr.remove();
                    },
                    error: function(xhr) {
                        console.log("Delete error:", xhr.responseText);
                    }
                });
            });

            //jquery event
            $('#fetchbtn').click(function() {
                fetch();
            })

        });
    </script>

    <button id="fetchbtn">fetch</button>

</body>

</html>