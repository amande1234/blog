<html>
<head>
    <title>User Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"/>

</head>
<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <a class="navbar-brand" href="#">Custom Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
           
            
          </ul>
          <form class="form-inline my-2 my-lg-0">
          <a href="/logout">Logout</a>
          </form>
        </div>
      </nav>
<div id="main-content" class="blog-page">
   
        <div class="container">

        
            <div class="row clearfix">

            <!-- Single Post Div -->
            @foreach ($posts_list as $key=> $value)
            <!-- dd($value); -->
            <div class="col-lg-4 mx-auto col-md-4">
                

                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src=<?php echo url ('images/'. $value['post_image'])?> alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ( $value['post_title'])?></h5>
                        <p class="card-text"><?php echo ( $value['post_description'])?></p>
                        <a href="/post/{{$value['post_id']}}" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>

                


            </div>
@endforeach
             <!-- Single Post Div -->
           
            <!-- Single Post Div End -->
                
            </div>

        </div>
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
        <div class="container text-center">
          <small>Copyright &copy; Panckaj Sood</small>
        </div>
      </footer>
</body>

</html>

