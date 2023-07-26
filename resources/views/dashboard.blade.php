<!DOCTYPE html>
<html lang="en">
<head>
  <title>Post</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  {{-- ajax link --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
        </li>
      </ul>
          <a href="{{ route('signout') }}"  class="btn btn-outline-success m-2 my-2 my-sm-0">Logout</a>
    </div>
</nav>
<main role="main">
    <section class="jumbotron text-center">
      <div class="container">
        <form action="{{ route('savepost') }}" method="post"> 
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Title:</label>
              <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Content:</label>
              <textarea class="form-control" name="content"></textarea>
            </div>

          <button class="btn btn-primary">New Post</button>
          </form>
      </div>
    </section>
    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Title</th>
                <th>Conntent</th>
                <th></th>
                <th></th>

              </tr>
            </thead>

            <tbody>
            </tbody>

          </table>
        </div>
      </div>
    </div>
</main>
<script> 
$(document).ready(function () {

fetchpost();

        function fetchpost() {
            $.ajax({
                type: "GET",
                url: "/fetch-post",
                dataType: "json",
                success: function (response) {
                  console.log(response);
                  $('tbody').html("");
                    $.each(response.post, function (key, item) {
                      var editUrl = "/posts/" + item.id + "/edit"; // Build the edit URL using the item's id

                        $('tbody').append('<tr>\
                            <td>' + item.title + '</td>\
                            <td>' + item.content + '</td>\
                            <td class="">\
                              <a href="' + editUrl + '" type="button" class="btn btn-secondary  btn-edit btn-sm">Edit</a>\
                            </td>\
                            <td>\
                              <button type="button"  data-id="' + item.id + '"  class="btn btn-danger deletebtn btn-sm">Delete</button>\
                            </td>\
                        \</tr>');
                    });
                    $('.deletebtn').click(deletePost);
            } 
            });
        }
      
        function deletePost(){
          var id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '/post/remove/'+id,
                dataType:'json',
                success:function(data){
                  fetchpost();
                }
            });

        }
});
</script>
</body>
</html>
