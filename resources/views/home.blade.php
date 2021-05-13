<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">
        <br>
        <h1 class="text-center text-primary">CRUD in Laravel with Ajax</h1>
        <br><br>
        <form>
            <div class="form-group">
              <input type="hidden" class="form-control" placeholder="Enter Title" id="id" name="id">
              <label>Todo Title:</label>
              <input type="text" class="form-control" placeholder="Enter Title" id="title" name="title">
            </div>
            <button type="submit" class="btn btn-info" id="addbtn">Submit</button>
        </form>
        <br>
        <table class="table text-center">
            <thead>
              <tr>
                <th>Title</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
          </table>
          <p id="demo"></p>
    </div>
</body>
<script>
    $(document).ready(function(){
        getdata();

        function getdata(){
            output = "";
            $.ajax({
                url: '/getdata',
                method: 'GET',
                success: function(data){
                    x = data;
                    var i;
                    for (i = 0; i < data.length; i++) {
                        output += '<tr><td>'+ data[i].todo_title + '</td>'
                        +'<td><button class="btn btn-success editbtn" data-id='+ data[i].todo_id +'>Edit</button></td>'
                        +'<td><button class="btn btn-danger deletebtn" data-id='+ data[i].todo_id +'>Delete</button></td>'
                        +'</tr>';
                    }
                    $("#tbody").html(output);
                },
            })
        }

        $("tbody").on("click",".editbtn",function(){
            var id = $(this).attr("data-id");
            $.ajax({
                url: '/editdata',
                method: 'GET',
                data: {id:id},
                success: function(data){
                    $('#id').val(data.todo_id);
                    $('#title').val(data.todo_title);
                },
            })
            getdata();
        });

        $("tbody").on("click",".deletebtn",function(){
            var id = $(this).attr("data-id");
            $.ajax({
                url: '/deletedata',
                method: 'GET',
                data: {id:id},
                success: function(data){

                },
            })
            getdata();
        });

        $('#addbtn').click(function(event){
            event.preventDefault();
            var id = $('#id').val();
            var title = $('#title').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/savedata',
                method: 'POST',
                data: {
                    id:id,
                    title:title,
                    _token:_token
                },
                success: function(data){

                },
            })
            $('#id').val('');
            $('#title').val('');
            getdata();
        });

    })
</script>
</html>
