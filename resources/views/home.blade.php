<!DOCTYPE html>
<html lang="en">
<head>
  <title>Post Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  {{-- ajax link --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<header>
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

          <form class="form-inline my-2 my-lg-0"  id="searchForm">
            <input class="form-control mr-sm-2" type="text" name="searchTerm" id="searchTerm" placeholder="Enter your search term">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>

        </div>
          <a href="{{ route('signout') }}"  class="btn btn-outline-success m-2 my-2 my-sm-0">Logout</a>
    </nav>
</header>

<main role="main">
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        {{-- if post zero --}}
        @if ($post->count() > 0) 
          @foreach ($post as $item)
            <div class="col-md-2"></div>

            <div class="col-md-8">
              <div class="card mb-4 box-shadow">
                  <div class="card-body">
                    @php
                      
                    $data = App\Models\User::where('id',$item->user_id)->select('name')->get();
                    $jsonData =  $data;
                    // Convert JSON string to PHP array
                    $dataArray = json_decode($jsonData, true);
                    // Access the value of "name" field
                    $uname = $dataArray[0]['name'];

                    @endphp
                      <h6 class="mb-1" style="color:darkblue;">{{ $uname }}</h6>
                      <p style="text-decoration:underline; font-size:18px;" class="text-center mt-1"> <i> {{ $item->title }}</i></p>
                    <p class="card-text">{{ $item->content }}</p>

                    <div class="d-flex justify-content-between align-items-center">
                     
                      <small class="text-muted">

                        {{-- diffInMinutes() is a method provided by the
                           Carbon library, which is used for date and 
                           time manipulation in PHP.  --}}
                           
                           Posted {{ $item->created_at ? $item->created_at->diffInMinutes(now()) : 'N/A' }} minutes ago
                      </small>
                    </div>
                  </div>
                </div>
                
    


              </div>
             
            <div class="col-md-2"></div>

          @endforeach

        @else
          <p>No Post found.</p>
        @endif
      </div>
    </div>
  </div>

 
</main>
</body>
</html>
